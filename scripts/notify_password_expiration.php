<?php

#==============================================================================
# Script options
#==============================================================================
$options = getopt("hnv");

$help = isset($options["h"]);
$dryrun = isset($options["n"]);
$verbose = isset($options["v"]);

#==============================================================================
# Help
#==============================================================================
if ($help) {
    fwrite(STDOUT, "Usage: ".basename(__FILE__)." -h -n -v\n");
    fwrite(STDOUT, "-h: this help message\n");
    fwrite(STDOUT, "-n: dry-run (do not send mails)\n");
    fwrite(STDOUT, "-v: verbose mode\n");
    exit(0);
}

#==============================================================================
# Includes
#==============================================================================
require_once(__DIR__."/../conf/config.inc.php");
require_once(__DIR__."/../lib/functions.inc.php");
require_once(__DIR__."/../vendor/autoload.php");

if (!$notify_password_expiration) {
    fwrite(STDERR, "Notify password expiration feature disabled, aborting job\n");
    exit(1);
}

if ($verbose) {
    fwrite(STDOUT, "Launching notify password expiration job\n");
}

#==============================================================================
# Language
#==============================================================================
# Available languages
$files = glob(__DIR__."/../lang/*.php");
$languages = str_replace(".inc.php", "", $files);
$languages = str_replace(__DIR__."/../lang/", "", $languages);
$lang = \Ltb\Language::detect_language($lang, $allowed_lang ? array_intersect($languages,$allowed_lang) : $languages);
require_once(__DIR__."/../lang/en.inc.php");
require_once(__DIR__."/../lang/$lang.inc.php");

if (file_exists(__DIR__."/../conf/$lang.inc.php")) {
    require_once(__DIR__."/../conf/$lang.inc.php");
}

#==============================================================================
# Email Config
#==============================================================================
$mailer = new \Ltb\Mail(
                           $mail_priority,
                           $mail_charset,
                           $mail_contenttype,
                           $mail_wordwrap,
                           $mail_sendmailpath,
                           $mail_protocol,
                           $mail_smtp_debug,
                           $mail_debug_format,
                           $mail_smtp_host,
                           $mail_smtp_port,
                           $mail_smtp_secure,
                           $mail_smtp_autotls,
                           $mail_smtp_auth,
                           $mail_smtp_user,
                           $mail_smtp_pass,
                           $mail_smtp_keepalive,
                           $mail_smtp_options,
                           $mail_smtp_timeout
                       );

# Embedded images
foreach ($mail_embedded_images as $img_key => $img_path) {
    $mailer->AddEmbeddedImage($img_path, $img_key);
}

#==============================================================================
# LDAP Config
#==============================================================================
$ldapInstance = new \Ltb\Ldap(
                                 $ldap_url,
                                 $ldap_starttls,
                                 isset($ldap_binddn) ? $ldap_binddn : null,
                                 isset($ldap_bindpw) ? $ldap_bindpw : null,
                                 isset($ldap_network_timeout) ? $ldap_network_timeout : null,
                                 $ldap_base,
                                 null,
                                 isset($ldap_krb5ccname) ? $ldap_krb5ccname : null,
                                 isset($ldap_page_size) ? $ldap_page_size : 0
                             );

#==============================================================================
# Directory instance
#==============================================================================
$directory;

# Load specific directory settings
switch($ldap_type) {
  case "openldap":
    $directory = new \Ltb\Directory\OpenLDAP();
  break;
  case "activedirectory":
    $directory = new \Ltb\Directory\ActiveDirectory();
  break;
}

#==============================================================================
# Smarty
#==============================================================================
require_once(SMARTY);

$compile_dir = isset($smarty_compile_dir) ? $smarty_compile_dir : __DIR__."/../templates_c/";
$cache_dir = isset($smarty_cache_dir) ? $smarty_cache_dir : __DIR__."/../cache/";
$tpl_dir = isset($custom_tpl_dir) ? array(__DIR__.'/../'.$custom_tpl_dir, __DIR__.'/../templates/') : __DIR__.'/../templates/';

$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->setTemplateDir($tpl_dir);
$smarty->setCompileDir($compile_dir);
$smarty->setCacheDir($cache_dir);
$smarty->debugging = $smarty_debug;
if(isset($smarty_debug) && $smarty_debug == true )
{
    $smarty->error_reporting = E_ALL;
}
else
{
    # Do not report smarty stuff unless $smarty_debug == true
    $smarty->error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING;
}

# Assign custom template variables
foreach (get_defined_vars() as $key => $value) {
    if (preg_match('/^tpl_(.+)/', $key, $matches)) {
        $smarty->assign($matches[1], $value);
    }
}

# Assign messages
$smarty->assign('lang',$lang);
foreach ($messages as $key => $message) {
    $smarty->assign('msg_'.$key,$message);
}

#==============================================================================
# Statistics
#==============================================================================
$stats = array(
    'total_entries' => 0,
    'expired_entries' => 0,
    'will_expire_later_entries' => 0,
    'never_expire_entries' => 0,
    'mail_sent' => 0,
    'mail_in_error' => 0
);

foreach ($notify_password_expiration_days as $days) {
    $stats['will_expire_entries'][$days] = 0;
}

#==============================================================================
# Search accounts
#==============================================================================
$ldap_connection = $ldapInstance->connect();

$ldap = $ldap_connection[0];
$result = $ldap_connection[1];

if ($result != "") {
    fwrite(STDERR, "LDAP - Unable to connect ($result)\n");
    exit(1);
}

[$ldap,$result,$nb_entries,$entries,$size_limit_reached] = $ldapInstance->search(
    $ldap_user_filter,
    $directory->getOperationalAttributes(),
    array("fullname" => array( "attribute" => $ldap_fullname_attribute), "login" => array("attribute" => $ldap_login_attribute)),
    "fullname",
    "login",
    array(),
    $ldap_scope
);

if ($result != "") {
    fwrite(STDERR, "LDAP - Search failed ($result)\n");
    exit(1);
}

list($passwordPolicies, $userPolicies) = $directory->getPwdPolicies(
    $ldap,
    $entries,
    $ldap_default_ppolicy
);

foreach($entries as $entry_key => $entry) {

    $stats['total_entries']++;

    # Get password policy configuration
    $pwdPolicyConfiguration = $userPolicies[$entry['dn']];
    if (isset($ldap_password_max_age) and $ldap_password_max_age) { $pwdPolicyConfiguration['password_max_age'] = $ldap_password_max_age; }

    $isExpired = $directory->isPasswordExpired($entry, $pwdPolicyConfiguration);
    $expirationDate = $directory->getPasswordExpirationDate($entry, $pwdPolicyConfiguration);

    if ( $isExpired === true ) {
        if ($verbose) {
            fwrite(STDOUT, $entry['dn']." -> EXPIRED\n");
        }
        $stats['expired_entries']++;
        unset($entries[$entry_key]);
        continue;
    }
    if ($expirationDate) {
        foreach ($notify_password_expiration_days as $days) {
            $expirationDateClone = clone $expirationDate;
            $willExpireDate = date_sub( $expirationDateClone, new DateInterval('P'.$days.'D'));
            $time = time();
            if ( $time >= $willExpireDate->getTimestamp() and ($time < $willExpireDate->getTimestamp() + 86400) ) {
                if ($verbose) {
                    fwrite(STDOUT, $entry['dn']." -> WILL EXPIRE IN $days DAYS\n");
                }
                $stats['will_expire_entries'][$days]++;
                unset($entries[$entry_key]);

                $search = $ldapInstance->search_with_scope("base", $entry['dn'], "(objectClass=*)");
                $ldap_entry = ldap_first_entry($ldap, $search);
                $mail = \Ltb\AttributeValue::ldap_get_mail_for_notification($ldap, $ldap_entry, $mail_attributes);
                $data = array("name" =>  $entry['cn'][0], "days" => $days, "url" => $reset_url);
                $smarty->assign("mail_data", $data);
                $smarty->assign("mail_signature", $mail_signature);
                $html_body = $smarty->fetch('mails/passwordexpiration.tpl');

                if ($dryrun) {
                    if ($verbose) {
                        fwrite(STDOUT, $entry['dn']." -> Dry-run mode; mail should have been sent to $mail\n");
                    }
                } else {
                    if ($mailer->send_mail($mail, $mail_from, $mail_from_name, $messages["notifyexpirationsubject"], $messages["notifyexpirationmessage"], $data, $html_body)) {
                        $stats['mail_sent']++;
                        if ($verbose) {
                            fwrite(STDOUT, $entry['dn']." -> Mail sent to $mail\n");
                        }
                    } else {
                        $stats['mail_in_error']++;
                        if ($verbose) {
                            fwrite(STDOUT, $entry['dn']." -> Error, mail not sent to $mail\n");
                        }
                    }
                }

                continue 2;
            }
        }
    } else {
        if ($verbose) {
            fwrite(STDOUT, $entry['dn']." -> WILL NEVER EXPIRE\n");
        }
        unset($entries[$entry_key]);
        $stats['never_expire_entries']++;
    }
}

foreach($entries as $entry_key => $entry) {
    if ($verbose) {
        fwrite(STDOUT, $entry['dn']." -> WILL EXPIRE LATER\n");
    }
    $stats['will_expire_later_entries']++;
}


# Display statistics
fwrite(STDOUT, "[LTB Self Service Password] Notify password expiration statistics\n");
fwrite(STDOUT, "- Total entries read: ".$stats['total_entries']."\n");
fwrite(STDOUT, "- Expired entries: ".$stats['expired_entries']."\n");
fwrite(STDOUT, "- Never expire entries: ".$stats['never_expire_entries']."\n");
foreach ($notify_password_expiration_days as $days) {
    fwrite(STDOUT, "- Entries expiring in $days days: ".$stats['will_expire_entries'][$days]."\n");
}
fwrite(STDOUT, "- Will expire later entries: ".$stats['will_expire_later_entries']."\n");
fwrite(STDOUT, "- Mails succesfully sent: ".$stats['mail_sent']."\n");
fwrite(STDOUT, "- Mails in error: ".$stats['mail_in_error']."\n");

exit(0);
