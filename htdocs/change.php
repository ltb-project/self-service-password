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

# This page is called to change password

require_once("../lib/LtbAttributeValue_class.php");

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = $presetLogin;
$confirmpassword = "";
$newpassword = "";
$oldpassword = "";
$captchaphrase = "";
$ldap = "";
$userdn = "";
if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }
$mail = "";
$extended_error_msg = "";

if ($use_captcha) {
    if (isset($_POST["captchaphrase"]) and $_POST["captchaphrase"]) { $captchaphrase = strval($_POST["captchaphrase"]); }
    else { $result = "captcharequired"; }
}
if (isset($_POST["confirmpassword"]) and $_POST["confirmpassword"]) { $confirmpassword = strval($_POST["confirmpassword"]); }
else { $result = "confirmpasswordrequired"; }
if (isset($_POST["newpassword"]) and $_POST["newpassword"]) { $newpassword = strval($_POST["newpassword"]); }
else { $result = "newpasswordrequired"; }
if (isset($_POST["oldpassword"]) and $_POST["oldpassword"]) { $oldpassword = strval($_POST["oldpassword"]); }
else { $result = "oldpasswordrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = strval($_REQUEST["login"]); }
else { $result = "loginrequired"; }
if (! isset($_REQUEST["login"]) and ! isset($_POST["confirmpassword"]) and ! isset($_POST["newpassword"]) and ! isset($_POST["oldpassword"])) {
    $result = "emptychangeform";
}

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

# Match new and confirm password
if ( $newpassword != $confirmpassword ) { $result="nomatch"; }

#==============================================================================
# Check captcha
#==============================================================================
if ( $result === "" && $use_captcha ) {
    session_start();
    if ( !check_captcha($_SESSION['phrase'], $captchaphrase) ) {
        $result = "badcaptcha";
    }
    unset($_SESSION['phrase']);
}

#==============================================================================
# Check old password
#==============================================================================
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

                    # Check objectClass to allow samba and shadow updates
                    $ocValues = ldap_get_values($ldap, $entry, 'objectClass');
                    if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
                        $samba_mode = false;
                    }
                    if ( !in_array( 'shadowAccount', $ocValues ) ) {
                        $shadow_options['update_shadowLastChange'] = false;
                        $shadow_options['update_shadowExpire'] = false;
                    }

                    $userdn = ldap_get_dn($ldap, $entry);
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
    $result = check_password_strength( $newpassword, $oldpassword, $pwd_policy_config, $login, $entry_array );
}

#==============================================================================
# Change password
#==============================================================================
if ( $result === "" ) {
    if ( isset($prehook) ) {
        $command = hook_command($prehook, $login, $newpassword, $oldpassword, $prehook_password_encodebase64);
        exec($command, $prehook_output, $prehook_return);
    }
    if ( ! isset($prehook_return) || $prehook_return === 0 || $ignore_prehook_error ) {
        $result = change_password($ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword, $ldap_use_exop_passwd, $ldap_use_ppolicy_control);
        if ( $result === "passwordchanged" && isset($posthook) ) {
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
