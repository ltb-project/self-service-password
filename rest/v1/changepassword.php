<?php
require_once("./include.php");

#==============================================================================
# Action
#==============================================================================

$result = "";
$return = Array();
$error_code = 1;
$oldpassword = "";
$newpassword = "";
$login = "";

if ((isset($_POST["login"]) and $_POST["login"]) 
    and (isset($_POST["oldpassword"]) and $_POST["oldpassword"]) 
    and (isset($_POST["newpassword"]) and $_POST["newpassword"])
   ) {
    $login = $_POST["login"];
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
} else {
    $return['message'] = "login, oldpassword and newpassword required";
    echo json_encode($return);
    return;
}

# Connect to LDAP
$ldap = ldap_connect($ldap_url);
ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
if ( $ldap_starttls && !ldap_start_tls($ldap) ) {
    $result = "ldaperror";
    error_log("LDAP - Unable to use StartTLS");
} else {

# Bind
if ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
    $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
} else {
    $bind = ldap_bind($ldap);
}

if ( !$bind ) {
    $result = "ldaperror";
    $errno = ldap_errno($ldap);
    if ( $errno ) {
    error_log("LDAP - Bind error $errno  (".ldap_error($ldap).")");
    }
} else {

# Search for user
$ldap_filter = str_replace("{login}", $login, $ldap_filter);
$search = ldap_search($ldap, $ldap_base, $ldap_filter);

$errno = ldap_errno($ldap);
if ( $errno ) {
    $result = "ldaperror";
    error_log("LDAP - Search error $errno  (".ldap_error($ldap).")");
} else {

# Get user DN
$entry = ldap_first_entry($ldap, $search);
$userdn = ldap_get_dn($ldap, $entry);

if( !$userdn ) {
    $result = "badcredentials";
    error_log("LDAP - User $login not found");
} else {

# Get user email for notification
if ( $notify_on_change ) {
    $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
    if ( $mailValues["count"] > 0 ) {
        $mail = $mailValues[0];
    }
}

# Check objectClass to allow samba and shadow updates
$ocValues = ldap_get_values($ldap, $entry, 'objectClass');
if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
    $samba_mode = false;
}
if ( !in_array( 'shadowAccount', $ocValues ) ) {
    $shadow_options['update_shadowLastChange'] = false;
    $shadow_options['update_shadowExpire'] = false;
}

$entry = ldap_get_attributes($ldap, $entry);
$entry['dn'] = $userdn;

# Bind with old password
$bind = ldap_bind($ldap, $userdn, $oldpassword);
if ( !$bind ) {
    $result = "badcredentials";
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        error_log("LDAP - Bind user error $errno  (".ldap_error($ldap).")");
    }
    if ( ($errno == 49) && $ad_mode ) {
        if ( ldap_get_option($ldap, 0x0032, $extended_error) ) {
            error_log("LDAP - Bind user extended_error $extended_error  (".ldap_error($ldap).")");
            $extended_error = explode(', ', $extended_error);
            if ( strpos($extended_error[2], '773') or strpos($extended_error[0], 'NT_STATUS_PASSWORD_MUST_CHANGE') ) {
                error_log("LDAP - Bind user password needs to be changed");
                $result = "";
            }
            if ( ( strpos($extended_error[2], '532') or strpos($extended_error[0], 'NT_STATUS_ACCOUNT_EXPIRED') ) and $ad_options['change_expired_password'] ) {
                error_log("LDAP - Bind user password is expired");
                $result = "";
            }
            unset($extended_error);
        }
    }
}
if ( $result === "" )  {

    # Rebind as Manager if needed
    if ( $who_change_password == "manager" ) {
        $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    }

    if ($result === "") {
        $result = check_password_strength($newpassword, $oldpassword, $pwd_policy_config, $login, $entry);
        if ($result === "") {
            $result = change_password( $ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword, $ldap_use_exop_passwd, $ldap_use_ppolicy_control );
            $error_code = 0;
        }
    }
    
}}}}}

#==============================================================================
# Notify password change
#==============================================================================
if ($result === "passwordchanged") {
    if ($mail and $notify_on_change) {
        $data = array( "login" => $login, "mail" => $mail, "password" => $newpassword);
        if ( !send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data) ) {
            error_log("Error while sending change email to $mail (user $login)");
        }
    }
}

$return['result'] = $result;
$return['error'] = $error_code;
$return['message'] = $messages[$result];

echo json_encode($return, JSON_UNESCAPED_UNICODE);
