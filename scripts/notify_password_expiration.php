<?php
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

if ($debug) {
    fwrite(STDOUT, "Launching notify password expiration job\n");
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
        if ($debug) {
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
                if ($debug) {
                    fwrite(STDOUT, $entry['dn']." -> WILL EXPIRE IN $days DAYS\n");
                }
                $stats['will_expire_entries'][$days]++;
                unset($entries[$entry_key]);

                $search = $ldapInstance->search_with_scope("base", $entry['dn'], "(objectClass=*)");
                $ldap_entry = ldap_first_entry($ldap, $search);
                $mail = \Ltb\AttributeValue::ldap_get_mail_for_notification($ldap, $ldap_entry, $mail_attributes);
                $data = array("name" =>  $entry['cn'][0], "days" => $days, "url" => $reset_url);
                if ($mailer->send_mail($mail, $mail_from, $mail_from_name, $messages["notifyexpirationsubject"], $messages["notifyexpirationmessage"], $data)) {
                    $stats['mail_sent']++;
                    if ($debug) {
                        fwrite(STDOUT, $entry['dn']." -> Mail sent to $mail\n");
                    }
                } else {
                    $stats['mail_in_error']++;
                    if ($debug) {
                        fwrite(STDOUT, $entry['dn']." -> Error, mail not sent to $mail\n");
                    }
                }

                continue 2;
            }
        }
    } else {
        if ($debug) {
            fwrite(STDOUT, $entry['dn']." -> WILL NEVER EXPIRE\n");
        }
        unset($entries[$entry_key]);
        $stats['never_expire_entries']++;
    }
}

foreach($entries as $entry_key => $entry) {
    if ($debug) {
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
