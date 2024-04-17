<?php
require_once("./include.php");

#==============================================================================
# Action
#==============================================================================

$result = Array();
$oldpassword = "";
$newpassword = "";
$login = "";
$entry_array=array();
$ret = "";

if (isset($_POST["login"]) and $_POST["login"]) {
    $login = $_POST["login"];

    # Connect to LDAP
    $ldap_connection = $ldapInstance->connect();

    $ldap = $ldap_connection[0];
    $result = $ldap_connection[1];

    if ( $ldap ) {

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

            if( !$entry ) {
                $result = "badcredentials";
                error_log("LDAP - User $login not found");
            } else {

                $userdn = ldap_get_dn($ldap, $entry);

                $entry_array = ldap_get_attributes($ldap, $entry);
                $entry_array['dn'] = $userdn;

            }
        }
    }
}

if (isset($_POST["oldpassword"]) and $_POST["oldpassword"]) {
    $oldpassword = $_POST["oldpassword"];
}

if (isset($_POST["newpassword"]) and $_POST["newpassword"]) {
    $newpassword = $_POST["newpassword"];
    $ret = check_password_strength($newpassword, $oldpassword, $pwd_policy_config, $login, $entry_array);
    $result['error'] = 0;
} else {
    $result['error'] = 1;
    $ret = "newpassword required";
}

$result['result'] = $ret;
$result['message'] = array_key_exists($ret,$messages) ? $messages[$ret] : $ret;

echo json_encode($result, JSON_UNESCAPED_UNICODE);
