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

# This page is called to reset a password when a valid token is found in URL

class ResetByTokenController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = "";
        $token = $request->get('token');
        $tokenid = "";
        $newpassword = "";
        $confirmpassword = "";
        $userdn = "";
        if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }
        $mail = "";

        if (!$token) { $result = "tokenrequired"; }

        // Get token
        if ( $result === "" ) {

            // Open session with the token
            if ( $crypt_tokens ) {
                $tokenid = decrypt($token, $keyphrase);
            } else {
                $tokenid = $token;
            }

            ini_set("session.use_cookies",0);
            ini_set("session.use_only_cookies",1);

            // Manage lifetime with sessions properties
            if (isset($token_lifetime)) {
                ini_set("session.gc_maxlifetime", $token_lifetime);
                ini_set("session.gc_probability",1);
                ini_set("session.gc_divisor",1);
            }

            session_id($tokenid);
            session_name("token");
            session_start();
            $login = $_SESSION['login'];

            if ( !$login ) {
                $result = "tokennotvalid";
                error_log("Unable to open session $tokenid");
            } else {
                if (isset($token_lifetime)) {
                    // Manage lifetime with session content
                    $tokentime = $_SESSION['time'];
                    if ( time() - $tokentime > $token_lifetime ) {
                        $result = "tokennotvalid";
                        error_log("Token lifetime expired");
                    }
                }
            }

        }

        // Get passwords
        if ( $result === "" ) {

            $confirmpassword = $request->request->get('confirmpassword');
            if (!$confirmpassword) { $result = "confirmpasswordrequired"; }
            $newpassword = $request->request->get("newpassword");
            if (!$newpassword) { $result = "newpasswordrequired"; }
        }

        // Check reCAPTCHA
        if ( $result === "" && $use_recaptcha ) {
            $recaptchaService = new RecaptchaService($recaptcha_privatekey, $recaptcha_request_method);
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
        }

        // Find user
        if ( $result === "" ) {

            // Connect to LDAP
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
                    error_log("LDAP - Bind error $errno (".ldap_error($ldap).")");
                } else {

                    // Search for user
                    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
                    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

                    $errno = ldap_errno($ldap);
                    if ( $errno ) {
                        $result = "ldaperror";
                        error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
                    } else {

                        // Get user DN
                        $entry = ldap_first_entry($ldap, $search);
                        $userdn = ldap_get_dn($ldap, $entry);

                        if( !$userdn ) {
                            $result = "badcredentials";
                            error_log("LDAP - User $login not found");
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

                        // Get user email for notification
                        if ( $notify_on_change ) {
                            $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
                            if ( $mailValues["count"] > 0 ) {
                                $mail = $mailValues[0];
                            }
                        }

                    }}}}

        // Check and register new passord
        // Match new and confirm password
        if ( $result === "" ) {
            if ( $newpassword != $confirmpassword ) { $result="nomatch"; }
        }

        // Check password strength
        if ( $result === "" ) {
            $result = check_password_strength( $newpassword, "", $pwd_policy_config, $login );
        }

        // Change password
        if ($result === "") {
            $result = change_password($ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, "", "");
        }

        if ( $result === "passwordchanged" ) {
            // Delete token if all is ok
            $_SESSION = array();
            session_destroy();

            // Notify password change
            if ($mail and $notify_on_change) {
                $mailNotificationService = new MailNotificationService($mailer);
                $data = array( "login" => $login, "mail" => $mail, "password" => $newpassword);
                $mailNotificationService->send($mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data);
            }

            // Posthook
            if ( isset($posthook) ) {
                $posthookExecutor = new PosthookExecutor($posthook);
                $posthookExecutor->execute($login, $newpassword);
            }
        }

        // Render associated template
        return $this->render('resetbytoken.twig', array(
            'result' => $result,
            'show_help' => $show_help,
            'source' => $source,
            'show_policy' => $pwd_show_policy and ( $pwd_show_policy === "always" or ( $pwd_show_policy === "onerror" and is_error($result)) ),
            'pwd_policy_config' => $pwd_policy_config,
            'token' => $token,
            'login' => $login,
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
        ));
    }
}

$controller = new ResetByTokenController($config);
return $controller->indexAction($request);
