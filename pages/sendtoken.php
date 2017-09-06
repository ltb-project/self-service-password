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

# This page is called to send a reset token by mail

class SendTokenController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get('login');
        $mail = $request->request->get("mail");
        $token = "";

        if (empty($login)) { $result = "loginrequired"; }
        if (!$mail_address_use_ldap and empty($mail)) { $result = "mailrequired"; }

        if (empty($mail) and empty($login)) {
            $result = "emptysendtokenform";
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

        // Check mail
        if ( $result === "" ) {
            $ldapClient = new LdapClient($this->config);

            $result = $ldapClient->connect();
        }

        if ( $result === "" ) {
            $result = $ldapClient->checkMail($login, $mail);
        }

        // Build and store token
        if ( $result === "" ) {

            // Use PHP session to register token
            // We do not generate cookie
            ini_set("session.use_cookies",0);
            ini_set("session.use_only_cookies",1);

            session_name("token");
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['time']  = time();

            if ( $crypt_tokens ) {
                $token = encrypt(session_id(), $keyphrase);
            } else {
                $token = session_id();
            }

        }

        // Send token by mail
        if ( $result === "" ) {
            $reset_url = generate_reset_url($reset_url, array('token' => $token));

            if ( !empty($reset_request_log) ) {
                error_log("Send reset URL $reset_url \n\n", 3, $reset_request_log);
            } else {
                error_log("Send reset URL $reset_url");
            }

            $mailNotificationService = new MailNotificationService($mailer);
            $data = array( "login" => $login, "mail" => $mail, "url" => $reset_url ) ;
            $success = $mailNotificationService->send($mail, $mail_from, $mail_from_name, $messages["resetsubject"], $messages["resetmessage"].$mail_signature, $data);

            $result = $success ? "tokensent" : "tokennotsent";
        }

        // Render associated template
        return $this->render('sendtoken.twig', array(
            'result' => $result,
            'show_help' => $show_help,
            'login' => $login,
            'mail_address_use_ldap' => $mail_address_use_ldap,
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
        ));
    }
}

$controller = new SendTokenController($config);
return $controller->indexAction($request);
