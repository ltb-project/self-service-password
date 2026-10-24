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

    if ($debug) {
        fwrite(STDOUT, "Check entry ".$entry['dn']."\n");
    }

}

exit(0);
