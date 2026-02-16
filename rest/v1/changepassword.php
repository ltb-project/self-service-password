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
$ldap_connection = $ldapInstance->connect();

$ldap = $ldap_connection[0];
$result = $ldap_connection[1];

if ( $ldap ) {
    # Search for user
    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
    $search = $ldapInstance->search_with_scope($ldap_scope, $ldap_base, $ldap_filter);

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

            # Get user email for notification
            if ( $notify_on_change ) {
                $mail = \Ltb\AttributeValue::ldap_get_mail_for_notification($ldap, $entry);
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

            $entry_array = ldap_get_attributes($ldap, $entry);
            $entry_array['dn'] = $userdn;

            # Bind with old password
            $bind = ldap_bind($ldap, $userdn, $oldpassword);
            if ( !$bind ) {
                $result = "badcredentials";
                $errno = ldap_errno($ldap);
                if ( $errno ) {
                    error_log("LDAP - Bind user error $errno  (".ldap_error($ldap).")");
                }

                $accountStatus = $directory->getAccountStatus($ldap, $errno);

                if( !empty($accountStatus['EXTENDED_ERROR']) and
                    !empty($accountStatus['LDAP_ERROR']) )
                {
                    error_log("LDAP - Bind user extended_error ".
                              $accountStatus['EXTENDED_ERROR'] . "  (" .
                              $accountStatus['LDAP_ERROR'] . ")");
                }

                if( !empty($accountStatus['PASSWORD_MUST_CHANGE']) )
                {
                    error_log("LDAP - Bind user password needs to be changed");
                    $who_change_password = "manager";
                    $result = false;
                }

                if( !empty($accountStatus['PASSWORD_EXPIRED']) and
                    $ldap_options['change_expired_password'] )
                {
                    error_log("LDAP - Bind user password is expired");
                    $who_change_password = "manager";
                    $result = false;
                }
            }
            if ( !$result )  {

                # Rebind as Manager if needed
                if ( $who_change_password == "manager" ) {
                    $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
                }

                if ( !$result ) {
                    $result = check_password_strength($newpassword, $oldpassword, $pwd_policy_config, $login, $entry_array, $change_custompwdfield);

                    #==============================================================================
                    # Change password
                    #==============================================================================
                    if ( !$result ) {
                        if ( isset($prehook) ) {
                            $command = hook_command($prehook, $login, $newpassword, $oldpassword, $prehook_password_encodebase64);
                            exec($command, $prehook_output, $prehook_return);
                        }
                        if ( ! isset($prehook_return) || $prehook_return === 0 || $ignore_prehook_error ) {
                            $result = change_password( $directory,  $ldapInstance, $userdn, $newpassword, $ldap_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword, $ldap_use_exop_passwd, $ldap_use_ppolicy_control, false, "" );
                            if ( $result === "passwordchanged" && isset($posthook) ) {
                                $error_code = 0;
                                $command = hook_command($posthook, $login, $newpassword, $oldpassword, $posthook_password_encodebase64);
                                exec($command, $posthook_output, $posthook_return);
                            }
                            if ( $result !== "passwordchanged" ) {
                                if ( $show_extended_error ) {
                                    ldap_get_option($ldap, 0x0032, $extended_error_msg);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

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
