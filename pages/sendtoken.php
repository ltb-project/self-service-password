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
        if($this->isFormSubmitted($request)) {
            return $this->processFormData($request);
        }

        return $this->renderFormEmpty($request);
    }

    private function isFormSubmitted(Request $request) {
        return $request->get('login')
            && ($this->config['mail_address_use_ldap'] || $request->request->get('mail'));
    }

    private function processFormData(Request $request) {
        $login = $request->get('login');
        $mail = $request->request->get("mail");

        $result = '';
        if (empty($login)) { $result = "loginrequired"; }
        if (!$this->config['mail_address_use_ldap'] and empty($mail)) { $result = "mailrequired"; }
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        /** @var UsernameValidityChecker $usernameValidityChecker */
        $usernameValidityChecker = $this->get('username_validity_checker');

        // Check the entered username for characters that our installation doesn't support
        $result = $usernameValidityChecker->evaluate($login);
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        // Check reCAPTCHA
        if ( $this->config['use_recaptcha'] ) {
            /** @var RecaptchaService $recaptchaService */
            $recaptchaService = $this->get('recaptcha_service');

            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
            if($result != '') {
                return $this->renderFormWithError($result, $request);
            }
        }

        /** @var LdapClient $ldapClient */
        $ldapClient = $this->get('ldap_client');

        $result = $ldapClient->connect();
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        // Check mail
        $result = $ldapClient->checkMail($login, $mail);
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        // Build and store token

        // Use PHP session to register token
        // We do not generate cookie
        ini_set("session.use_cookies",0);
        ini_set("session.use_only_cookies",1);

        session_name("token");
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['time']  = time();

        if ( $this->config['crypt_tokens'] ) {
            $token = encrypt(session_id(), $this->config['keyphrase']);
        } else {
            $token = session_id();
        }

        // Send token by mail
        $reset_url = generate_reset_url($this->config['reset_url'], array('token' => $token));

        if ( !empty($reset_request_log) ) {
            error_log("Send reset URL $reset_url \n\n", 3, $reset_request_log);
        } else {
            error_log("Send reset URL $reset_url");
        }

        /** @var MailNotificationService $mailNotificationService */
        $mailNotificationService = $this->get('mail_notification_service');
        $data = array( "login" => $login, "mail" => $mail, "url" => $reset_url ) ;
        $success = $mailNotificationService->send($mail, $this->config['messages']["resetsubject"], $this->config['messages']["resetmessage"].$this->config['mail_signature'], $data);

        if($success) {
            return $this->renderPageSuccess();
        } else {
            return $this->renderFormWithError("tokennotsent", $request);
        }
    }

    private function renderFormEmpty(Request $request) {
        return $this->render('sendtoken.twig', array(
            'result' => 'emptysendtokenform',
            'login' => $request->get('login'),
        ));
    }

    private function renderFormWithError($result, Request $request) {
        return $this->render('sendtoken.twig', array(
            'result' => $result,
            'login' => $request->get('login'),
        ));
    }

    private function renderPageSuccess() {
        return $this->render('sendtoken.twig', array(
            'result' => 'tokensent',
        ));
    }
}
