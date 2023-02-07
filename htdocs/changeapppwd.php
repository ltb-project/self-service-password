<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once("../lib/LtbAttributeValue_class.php");

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = $presetLogin;
$confirmapppassword = "";
$newapppassword = "";
$password = "";
$ldap = "";
$userdn = "";
if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }
$mail = "";
$extended_error_msg = "";

$post = filter_input_array(INPUT_POST);
if(isset($INPUT_REQUEST)) { $request = filter_input_array(INPUT_REQUEST); }
if (isset($post["confirmapppassword"]) and $post["confirmapppassword"]) { $confirmapppassword = strval($post["confirmapppassword"]); }
else { $result = "confirmpasswordrequired"; }
if (isset($post["newapppassword"]) and $post["newapppassword"]) { $newapppassword = strval($post["newapppassword"]); }
else { $result = "newpasswordrequired"; }
if (isset($post["password"]) and $post["password"]) { $password = strval($post["password"]); }
else { $result = "passwordrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = strval($_REQUEST["login"]); }
else { $result = "loginrequired"; }
if (! isset($request["login"]) and ! isset($post["confirmapppassword"]) and ! isset($post["newapppassword"]) and ! isset($post["password"])) {
    $result = "emptychangeform";
}

# Get the app configuration
$appconf;
if (is_numeric(explode("%", $_GET["action"])[1])) {
    $appindex = explode("%", $_GET["action"])[1];
    $appconf = $change_apppwd[$appindex];
} else { 
    $result = "unknownapp"; 
    error_log($result);
}

error_log("ich mache was.");
error_log($appconf['label']);

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

# Match new and confirm password
if ( $newapppassword != $confirmapppassword ) { $result="nomatch"; }

#==============================================================================
# Check captcha
#==============================================================================
if ( ( $result === "" ) and $appconf['use_captcha']) { $result = global_captcha_check();}

# Check password
if ( $result === "" ) {

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
        } elseif ( isset($ldap_krb5ccname) ) {
            putenv("KRB5CCNAME=".$ldap_krb5ccname);
            $bind = ldap_sasl_bind($ldap, NULL, NULL, 'GSSAPI') or error_log('Failed to GSSAPI bind.');
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

                if( !$entry ) {
                    $result = "badcredentials";
                    error_log("LDAP - User $login not found");
                } else {
                    # Get user email for notification
                    if ($notify_on_change) {
                        $mail = LtbAttributeValue::ldap_get_mail_for_notification($ldap, $entry);
                    }

                    $userdn = ldap_get_dn($ldap, $entry);
                    $entry_array = ldap_get_attributes($ldap, $entry);
                    $entry_array['dn'] = $userdn;

                    # Bind with old password
                    $bind = ldap_bind($ldap, $userdn, $password);
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
                                    $who_change_password = "manager";
                                    $result = "";
                                }
                                if ( ( strpos($extended_error[2], '532') or strpos($extended_error[0], 'NT_STATUS_ACCOUNT_EXPIRED') ) and $ad_options['change_expired_password'] ) {
                                    error_log("LDAP - Bind user password is expired");
                                    $who_change_password = "manager";
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
                    }
                }

                if ( $use_ratelimit ) {
                    if ( ! allowed_rate($login,$_SERVER[$client_ip_header],$rrl_config) ) {
                        $result = "throttle";
                        error_log("LDAP - User $login too fast");
                    }
                }

            }
        }
    }
}

#==============================================================================
# Check password strength
#==============================================================================
if ( $result === "" ) {
    $result = check_password_strength( $newapppassword, $password, $appconf['pwd_policy_config'], $login, $entry_array );
}

#==============================================================================
# Change password
#==============================================================================
if ( $result === "" ) {
    if ( isset($appconf['prehook']) ) {
        $command = hook_command($appconf['prehook'], $login, $newapppassword, $password, $prehook_password_encodebase64);
        exec($command, $prehook_output, $prehook_return);
    }
    if ( ! isset($prehook_return) || $prehook_return === 0 || $ignore_prehook_error ) {
        $result = change_apppassword($appconf['attribute'], $ldap, $userdn, $newapppassword, $appconf['hash'], $appconf['hash_options'], $appconf['who_change_password'], $password, $use_exop_passwd, $use_ppolicy_control);
        if ( $result === "passwordchanged" && isset($posthook) ) {
            $command = hook_command($appconf['posthook'], $login, $newapppassword, $password, $posthook_password_encodebase64);
            exec($command, $posthook_output, $posthook_return);
        }
        if ( $result !== "passwordchanged" ) {
            if ( $show_extended_error ) {
                ldap_get_option($ldap, 0x0032, $extended_error_msg);
            }
        }
    }
} else {
    error_log($result);
}
