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

# This page is called to reset a password trusting question/anwser

class ResetByQuestionsController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get("login", "");
        $question = $request->request->get("question", "");
        $answer = $request->request->get("answer", "");
        $newpassword = $request->request->get("newpassword", "");
        $confirmpassword = $request->request->get("confirmpassword", "");
        $userdn = "";
        if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }
        $mail = "";

        $missings = array();
        if (!$request->get("login")) { $missings[] = "loginrequired"; }
        if (!$request->request->has("question")) { $missings[] = "questionrequired"; }
        if (!$request->request->has("answer")) { $missings[] = "answerrequired"; }
        if (!$request->request->has("newpassword")) { $missings[] = "newpasswordrequired"; }
        if (!$request->request->has("confirmpassword")) { $missings[] = "confirmpasswordrequired"; }

        if(count($missings) > 0) {
            $result = count($missings) == 5 ? 'emptyresetbyquestionsform' : $missings[0];
        }

        // Check the entered username for characters that our installation doesn't support
        if ( $result === "" ) {
            $result = check_username_validity($login,$login_forbidden_chars);
        }

        // Check reCAPTCHA
        if ( $result === "" && $use_recaptcha ) {
            $recaptchaService = new RecaptchaService($recaptcha_privatekey, $recaptcha_request_method);
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
        }

        // Check question/answer
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
                        } else {

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

                            // Get question/answer values
                            $questionValues = ldap_get_values($ldap, $entry, $answer_attribute);
                            unset($questionValues["count"]);
                            $match = 0;

                            // Match with user submitted values
                            foreach ($questionValues as $questionValue) {
                                $answer = preg_quote("$answer","/");
                                if (preg_match("/^\{$question\}$answer$/i", $questionValue)) {
                                    $match = 1;
                                }
                            }

                            if (!$match) {
                                $result = "answernomatch";
                                error_log("Answer does not match question for user $login");
                            }

                        }}}}}

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
            // Notify password change
            if ($mail and $notify_on_change) {
                $data = array( "login" => $login, "mail" => $mail, "password" => $newpassword);
                if ( !send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data) ) {
                    error_log("Error while sending change email to $mail (user $login)");
                }
            }

            // Posthook
            if ( isset($posthook) ) {
                $posthookExecutor = new PosthookExecutor($posthook);
                $posthookExecutor->execute($login, $newpassword);
            }
        }

        // Render associated template
        return $this->render('resetbyquestions.twig', array(
            'result' => $result,
            'login' => $login,
            'show_help' => $show_help,
            'pwd_policy_config' => $pwd_policy_config,
            'questions' => $messages["questions"],
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
            'lang' => $lang,
        ));
    }
}

$controller = new ResetByQuestionsController($config);
return $controller->indexAction($request);
