<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# GPL License: http://www.gnu.org/licenses/gpl.txt
#
#==============================================================================

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
if (! isset($_REQUEST["login"]) and ! isset($post["confirmapppassword"]) and ! isset($post["newapppassword"]) and ! isset($post["password"])) {
    $result = "emptychangeform";
}


$appindex = 0;
if (isset($default_appindex)) { $appindex = $default_appindex; }
if (isset($_GET["appindex"])) {
    if (isset($change_apppwd[$_GET["appindex"]])) {
        $appindex = $_GET["appindex"];
    } else {
        $result = "unknownapp";
    }
}

if ($result === "") {
    $appconf = $change_apppwd[$appindex];
}

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

# Match new and confirm password
if ( $newapppassword != $confirmapppassword ) { $result="nomatch"; }

#==============================================================================
# Check captcha
#==============================================================================
if ( ( $result === "" ) and $use_captcha ) { $result = global_captcha_check();}

#==============================================================================
# Default configuration
#==============================================================================
if (!isset($appconf['ldap_use_ppolicy_control'])) { 
    $appconf['ldap_use_ppolicy_control'] = false; 
} //it is possible to define different password policies for multiple attributes, as far as I know only in OpenLDAP
if (!isset($appconf['pwd_policy_config'])) { 
    $appconf['pwd_policy_config'] = array(); 
}
if (!isset($appconf['pwd_policy_config']['pwd_show_policy'])) { 
    $appconf['pwd_policy_config']['pwd_show_policy'] = $pwd_show_policy; 
}
if (!isset($appconf['pwd_policy_config']['pwd_min_length'])) { 
    $appconf['pwd_policy_config']['pwd_min_length'] = $pwd_min_length; 
}
if (!isset($appconf['pwd_policy_config']['pwd_max_length'])) { 
    $appconf['pwd_policy_config']['pwd_max_length'] = $pwd_max_length; 
}
if (!isset($appconf['pwd_policy_config']['pwd_min_lower'])) { 
    $appconf['pwd_policy_config']['pwd_min_lower'] = $pwd_min_lower; 
}
if (!isset($appconf['pwd_policy_config']['pwd_min_upper'])) { 
    $appconf['pwd_policy_config']['pwd_min_upper'] = $pwd_min_upper; 
}
if (!isset($appconf['pwd_policy_config']['pwd_min_digit'])) { 
    $appconf['pwd_policy_config']['pwd_min_digit'] = $pwd_min_digit; 
}
if (!isset($appconf['pwd_policy_config']['pwd_min_special'])) { 
    $appconf['pwd_policy_config']['pwd_min_special'] = $pwd_min_special; 
}
if (!isset($appconf['pwd_policy_config']['pwd_special_chars'])) { 
    $appconf['pwd_policy_config']['pwd_special_chars'] = $pwd_special_chars; 
}
if (!isset($appconf['pwd_policy_config']['pwd_forbidden_chars'])) { 
    $appconf['pwd_policy_config']['pwd_forbidden_chars'] = ""; 
}
if (!isset($appconf['pwd_policy_config']['pwd_no_reuse'])) { 
    $appconf['pwd_policy_config']['pwd_no_reuse'] = $pwd_no_reuse; 
}
if (!isset($appconf['pwd_policy_config']['pwd_diff_last_min_chars'])) { 
    $appconf['pwd_policy_config']['pwd_diff_last_min_chars'] = $pwd_diff_last_min_chars; 
}
if (!isset($appconf['pwd_policy_config']['pwd_diff_login'])) { 
    $appconf['pwd_policy_config']['pwd_diff_login'] = $pwd_diff_login; 
}
if (!isset($appconf['pwd_policy_config']['pwd_complexity'])) { 
    $appconf['pwd_policy_config']['pwd_complexity'] = $pwd_complexity; 
}
if (!isset($appconf['pwd_policy_config']['use_pwnedpasswords'])) { 
    $appconf['pwd_policy_config']['use_pwnedpasswords'] = $use_pwnedpasswords; 
}
if (!isset($appconf['pwd_policy_config']['pwd_no_special_at_ends'])) { 
    $appconf['pwd_policy_config']['pwd_no_special_at_ends'] = $pwd_no_special_at_ends; 
}
if (!isset($appconf['pwd_policy_config']['pwd_forbidden_words'])) { 
    $appconf['pwd_policy_config']['pwd_forbidden_words'] = $pwd_forbidden_words; 
}
if (!isset($appconf['pwd_policy_config']['pwd_forbidden_ldap_fields'])) { 
    $appconf['pwd_policy_config']['pwd_forbidden_ldap_fields'] = $pwd_forbidden_ldap_fields; 
}
if (!isset($appconf['pwd_policy_config']['pwd_show_policy_pos'])) { 
    $appconf['pwd_policy_config']['pwd_show_policy_pos'] = $pwd_show_policy_pos; 
}
if (!isset($appconf['who_change_password'])) { 
    $appconf['who_change_password'] = $who_change_password; 
}
if (!isset($appconf['msg_changehelpextramessage'])) { 
    $appconf['msg_changehelpextramessage'] = ""; 
}
if (!isset($appconf['notify_on_change'])) { 
    $appconf['notify_on_change'] = $notify_on_change; 
}
if (!isset($appconf['hash_options'])) { 
    $appconf['hash_options'] = $hash_options; 
}
if (!isset($appconf['msg_passwordchangedextramessage'])) { 
    $appconf['msg_passwordchangedextramessage'] = ""; 
}
if (!isset($appconf['samba_mode'])) { 
    $appconf['samba_mode'] = false; 
}
if (!isset($appconf['samba_options'])) { 
    $appconf['samba_options'] = array(); 
}
if (!isset($appconf['shadow_options'])) { 
    $appconf['shadow_options'] = array(); 
}
if (!isset($appconf['shadow_options']['update_shadowLastChange'])) { 
    $appconf['sha$dow_options']['update_shadowLastChange'] = false; 
}
if (!isset($appconf['shadow_options']['update_shadowExpire'])) { 
    $appconf['shadow_options']['update_shadowExpire'] = false; 
}
if (!isset($appconf['shadow_options']['shadow_expire_days'])) { 
    $appconf['shadow_options']['shadow_expire_days'] = -1; 
}

#==============================================================================
# Check password
#==============================================================================
if ( $result === "" ) {

    # Connect to LDAP
    $ldap_connection = \Ltb\Ldap::connect($ldap_url, $ldap_starttls, $ldap_binddn, $ldap_bindpw, $ldap_network_timeout, $ldap_krb5ccname);

    $ldap = $ldap_connection[0];
    $result = $ldap_connection[1];

    if ($ldap) {

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
                if ($appconf['notify_on_change']) {
                    $mail = \Ltb\AttributeValue::ldap_get_mail_for_notification($ldap, $entry);
                }

                $userdn = ldap_get_dn($ldap, $entry);
                $entry_array = ldap_get_attributes($ldap, $entry);
                $entry_array['dn'] = $userdn;

                # Bind with current password
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
                                $result = "accountexpired";
                            }
                            if ( ( strpos($extended_error[2], '532') or strpos($extended_error[0], 'NT_STATUS_ACCOUNT_EXPIRED') ) and $ad_options['change_expired_password'] ) {
                                error_log("LDAP - Bind user password is expired");
                                $result = "accountexpired";
                            }
                            unset($extended_error);
                        }
                    }
                }
                if ( $result === "" )  {
                    # Rebind as Manager if needed
                    if ( $appconf['who_change_password'] == "manager" ) {
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

#==============================================================================
# Check password strength
#==============================================================================
if ( $result === "" ) {
    $result = check_password_strength( $newapppassword, $password, $appconf['pwd_policy_config'], $login, $entry_array, $change_apppwd );
}

#==============================================================================
# Change password
#==============================================================================
if ( $result === "" ) {
    if ( isset($appconf['prehook']) ) {
        $command = hook_command($appconf['prehook'], $login, $newapppassword, $password, $appconf['prehook_password_encodebase64']);
        exec($command, $prehook_output, $prehook_return);
    }
    if ( ! isset($prehook_return) || $prehook_return === 0 || $appconf['ignore_prehook_error'] ) {
        $result = change_password($ldap, $userdn, $newapppassword, false, array(), $appconf['samba_mode'], $appconf['samba_options'], $appconf['shadow_options'], $appconf['hash'], $appconf['hash_options'], $appconf['who_change_password'], $password, false, $appconf['ldap_use_ppolicy_control'], true, $appconf['attribute']);
        //$result = change_apppassword($appconf['attribute'], $ldap, $userdn, $newapppassword, $appconf['hash'], $appconf['hash_options'], $password, $appconf['ldap_use_ppolicy_control']);
        if ( $result === "passwordchanged" && isset($appconf['posthook']) ) {
            $command = hook_command($appconf['posthook'], $login, $newapppassword, $password, $appconf['posthook_password_encodebase64']);
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

#==============================================================================
# Notify password change
#==============================================================================

if ($result === "passwordchanged") {
    if ($mail and $notify_on_change) {
        $data = array( "login" => $login, "mail" => $mail, "password" => $newapppassword);
        if ( !send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data) ) {
            error_log("Error while sending change email to $mail (user $login)");
        }
    }
}
