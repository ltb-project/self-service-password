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

class ChangeController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get("login", "");
        $oldpassword = $request->request->get("oldpassword", "");
        $newpassword = $request->request->get("newpassword", "");
        $confirmpassword = $request->request->get("confirmpassword", "");
        if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }
        $mail = "";

        $missings = array();
        if (!$request->get("login")) { $missings[] = "loginrequired"; }
        if (!$request->request->has("newpassword")) { $missings[] = "newpasswordrequired"; }
        if (!$request->request->has("oldpassword")) { $missings[] = "oldpasswordrequired"; }
        if (!$request->request->has("confirmpassword")) { $missings[] = "confirmpasswordrequired"; }

        if(count($missings) > 0) {
            $result = count($missings) == 4 ? 'emptychangeform' : $missings[0];
        }

        // Check the entered username for characters that our installation doesn't support
        if ( $result === "" ) {
            $result = check_username_validity($login,$login_forbidden_chars);
        }

        // Match new and confirm password
        if ( $newpassword != $confirmpassword ) { $result="nomatch"; }

        // Check reCAPTCHA
        if ( $result === "" && $use_recaptcha ) {
            $recaptchaService = new RecaptchaService($recaptcha_privatekey, $recaptcha_request_method);
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
        }

        // Check old password
        if ( $result === "" ) {

            //Connect to LDAP
            $ldap = ldap_connect($ldap_url);
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
            if ( $ldap_starttls && !ldap_start_tls($ldap) ) {
                $result = "ldaperror";
                error_log("LDAP - Unable to use StartTLS");
            } else {

                // Bind
                if ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
                    $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
                } else {
                    $bind = ldap_bind($ldap);
                }

                $errno = ldap_errno($ldap);
                if ( $errno ) {
                    $result = "ldaperror";
                    error_log("LDAP - Bind error $errno  (".ldap_error($ldap).")");
                } else {

                    // Search for user
                    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
                    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

                    $errno = ldap_errno($ldap);
                    if ( $errno ) {
                        $result = "ldaperror";
                        error_log("LDAP - Search error $errno  (".ldap_error($ldap).")");
                    } else {

                        // Get user DN
                        $entry = ldap_first_entry($ldap, $search);
                        $userdn = ldap_get_dn($ldap, $entry);

                        if( !$userdn ) {
                            $result = "badcredentials";
                            error_log("LDAP - User $login not found");
                        } else {

                            // Get user email for notification
                            if ( $notify_on_change ) {
                                $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
                                if ( $mailValues["count"] > 0 ) {
                                    $mail = $mailValues[0];
                                }
                            }

                            // Check objectClass to allow samba and shadow updates
                            $ocValues = ldap_get_values($ldap, $entry, 'objectClass');
                            if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
                                $samba_mode = false;
                            }
                            if ( !in_array( 'shadowAccount', $ocValues ) ) {
                                $shadow_options['update_shadowLastChange'] = false;
                                $shadow_options['update_shadowExpire'] = false;
                            }

                            // Bind with old password
                            $bind = ldap_bind($ldap, $userdn, $oldpassword);
                            $errno = ldap_errno($ldap);
                            if ( ($errno == 49) && $ad_mode ) {
                                if ( ldap_get_option($ldap, 0x0032, $extended_error) ) {
                                    error_log("LDAP - Bind user extended_error $extended_error  (".ldap_error($ldap).")");
                                    $extended_error = explode(', ', $extended_error);
                                    if ( strpos($extended_error[2], '773') or strpos($extended_error[0], 'NT_STATUS_PASSWORD_MUST_CHANGE') ) {
                                        error_log("LDAP - Bind user password needs to be changed");
                                        $errno = 0;
                                    }
                                    if ( ( strpos($extended_error[2], '532') or strpos($extended_error[0], 'NT_STATUS_ACCOUNT_EXPIRED') ) and $ad_options['change_expired_password'] ) {
                                        error_log("LDAP - Bind user password is expired");
                                        $errno = 0;
                                    }
                                    unset($extended_error);
                                }
                            }
                            if ( $errno ) {
                                $result = "badcredentials";
                                error_log("LDAP - Bind user error $errno  (".ldap_error($ldap).")");
                            } else {

                                // Rebind as Manager if needed
                                if ( $who_change_password == "manager" ) {
                                    $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
                                }

                            }}}}}

        }

        // Check password strength
        if ( $result === "" ) {
            $result = check_password_strength( $newpassword, $oldpassword, $pwd_policy_config, $login );
        }

        // Change password
        if ( $result === "" ) {
            $result = change_password($ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword);
        }

        if ( $result === "passwordchanged" ) {
            // Notify password change
            if ($mail and $notify_on_change) {
                $mailNotificationService = new MailNotificationService($mailer);
                $data = array( "login" => $login, "mail" => $mail, "password" => $newpassword);
                $mailNotificationService->send($mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data);
            }

            // Posthook
            if ( isset($posthook) ) {
                $posthookExecutor = new PosthookExecutor($posthook);
                $posthookExecutor->execute($login, $newpassword, $oldpassword);
            }
        }

        // Render associated template
        return $this->render('change.twig', array(
            'result' => $result,
            'has_password_changed_extra_message' => isset($messages['passwordchangedextramessage']),
            'has_change_help_extra_message' => isset($messages['changehelpextramessage']),
            'show_help' => $show_help,
            'pwd_show_policy_pos' => $pwd_show_policy_pos,
            'login' => $login,
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
            'show_change_help_reset' => !$show_menu and ( $use_questions or $use_tokens or $use_sms or $change_sshkey ),
            'show_policy' => $pwd_show_policy and ( $pwd_show_policy === "always" or ( $pwd_show_policy === "onerror" and is_error($result)) ),
            'pwd_policy_config' => $pwd_policy_config,
        ));
    }
}

$controller = new ChangeController($config);
return $controller->indexAction($request);
