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
        $token = $request->get('token');

        if (!$token) {
            return $this->renderErrorPage('tokenrequired', $request);
        }

        $login = '';

        // Get token
        $result = $this->handleToken($token, $login);
        if($result != '') {
            return $this->renderErrorPage('tokennotvalid', $request);
        }

        // Get passwords
        $newpassword = $request->request->get("newpassword");
        $confirmpassword = $request->request->get('confirmpassword');
        if (!$newpassword) {
            return $this->renderErrorPage('newpasswordrequired', $request);
        }
        if (!$confirmpassword) {
            return $this->renderErrorPage('confirmpasswordrequired', $request);
        }

        // Check reCAPTCHA
        if ( $this->config['use_recaptcha'] ) {
            /** @var RecaptchaService $recaptchaService */
            $recaptchaService = $this->get('recaptcha_service');
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
            if($result != '') {
                return $this->renderErrorPage($result, $request);
            }
        }

        /** @var LdapClient $ldapClient */
        $ldapClient = $this->get('ldap_client');

        $result = $ldapClient->connect();
        if($result != '') {
            return $this->renderErrorPage($result, $request);
        }

        // Find user
        $context = array();
        $result = $ldapClient->findUser($login, $context);
        if($result != '') {
            return $this->renderErrorPage($result, $request);
        }

        // Check and register new passord
        // Match new and confirm password
        if ( $newpassword != $confirmpassword ) {
            return $this->renderErrorPage("nomatch", $request);
        }

        /** @var PasswordStrengthChecker $passwordStrengthChecker */
        $passwordStrengthChecker = $this->get('password_strength_checker');

        // Check password strength
        $result = $passwordStrengthChecker->evaluate( $newpassword, '', $login );
        if($result != '') {
            return $this->renderErrorPage($result, $request);
        }

        // Change password
        $result = $ldapClient->changePassword($context['user_dn'], $newpassword, '', $context);
        if($result != 'passwordchanged') {
            return $this->renderErrorPage($result, $request);
        }

        // Delete token if all is ok
        $_SESSION = array();
        session_destroy();

        // Notify password change
        if ($this->config['notify_on_change'] and $context['user_mail']) {
            /** @var MailNotificationService $mailNotificationService */
            $mailNotificationService = $this->get('mail_notification_service');

            $data = array( "login" => $login, "mail" => $context['user_mail'], "password" => $newpassword);
            $mailNotificationService->send($context['user_mail'], $this->config['messages']["changesubject"], $this->config['messages']["changemessage"].$this->config['mail_signature'], $data);
        }

        // Posthook
        if ( isset($this->config['posthook']) ) {
            /** @var PosthookExecutor $posthookExecutor */
            $posthookExecutor = $this->get('posthook_executor');

            $posthookExecutor->execute($login, $newpassword);
        }

        return $this->renderSuccessPage();
    }

    private function handleToken($token, &$login) {
        $crypt_tokens = $this->config['crypt_tokens'];
        $keyphrase = $this->config['keyphrase'];

        // Open session with the token
        if ( $crypt_tokens ) {
            $tokenid = decrypt($token, $keyphrase);
        } else {
            $tokenid = $token;
        }

        ini_set("session.use_cookies",0);
        ini_set("session.use_only_cookies",1);

        // Manage lifetime with sessions properties
        if (isset($this->config['token_lifetime'])) {
            ini_set("session.gc_maxlifetime", $this->config['token_lifetime']);
            ini_set("session.gc_probability",1);
            ini_set("session.gc_divisor",1);
        }

        session_id($tokenid);
        session_name("token");
        session_start();
        $login = $_SESSION['login'];

        if ( !$login ) {
            error_log("Unable to open session $tokenid");
            return "tokennotvalid";
        }

        if (isset($this->config['token_lifetime'])) {
            // Manage lifetime with session content
            $tokentime = $_SESSION['time'];
            if ( time() - $tokentime > $this->config['token_lifetime'] ) {
                error_log("Token lifetime expired");
                return "tokennotvalid";
            }
        }

        return '';
    }

    private function renderErrorPage($result, Request $request) {
        return $this->render('resetbytoken.twig', array(
            'result' => $result,
            'source' => $request->get('source'),
            'token' => $request->get('token'),
            'login' => $request->get('login'),
        ));
    }

    private function renderSuccessPage() {
        return $this->render('resetbytoken.twig', array(
            'result' => 'passwordchanged',
        ));
    }
}
