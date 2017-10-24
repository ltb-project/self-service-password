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

# This page is called to send random generated password to user by SMS

class SendSmsController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        if (!$this->config['crypt_tokens']) {
            return $this->renderErrorPage("crypttokensrequired");
        }

        $login = $request->get("login");
        $smstoken = $request->get("smstoken");
        $token = $request->get("token");
        $encrypted_sms_login = $request->get("encrypted_sms_login");

        if (!empty($token) and !empty($smstoken)) {
            return $this->processSmsTokenAttempt($request);
        } elseif (!empty($encrypted_sms_login)) {
            return $this->generateAndSendSmsToken($request);
        } elseif (!empty($login)) {
            return $this->processSearchUserFormData($request);
        }

        return $this->renderSearchUserFormEmpty($request);
    }

    private function processSmsTokenAttempt(Request $request) {
        $result = "";

        # Open session with the token
        $tokenid = decrypt($request->get("token"), $this->config['keyphrase']);
        $smstoken = $request->get("smstoken");

        ini_set("session.use_cookies",0);
        ini_set("session.use_only_cookies",1);

        # Manage lifetime with sessions properties
        if (isset($this->config['token_lifetime'])) {
            ini_set("session.gc_maxlifetime", $this->config['token_lifetime']);
            ini_set("session.gc_probability",1);
            ini_set("session.gc_divisor",1);
        }

        session_id($tokenid);
        session_name("smstoken");
        session_start();
        $login        = $_SESSION['login'];
        $sessiontoken = $_SESSION['smstoken'];
        $attempts     = $_SESSION['attempts'];

        if ( !$login or !$sessiontoken) {
            error_log("Unable to open session $tokenid");
            $result = "tokennotvalid";
        } elseif ($sessiontoken != $smstoken) {
            if ($attempts < $this->config['max_attempts']) {
                $_SESSION['attempts'] = $attempts + 1;
                error_log("SMS token $smstoken not valid, attempt $attempts");
                $result = "tokenattempts";
            }
            else {
                error_log("SMS token $smstoken not valid");
                $result = "tokennotvalid";
            }
        } elseif (isset($this->config['token_lifetime'])) {
            # Manage lifetime with session content
            $tokentime = $_SESSION['time'];
            if ( time() - $tokentime > $this->config['token_lifetime'] ) {
                error_log("Token lifetime expired");
                $result = "tokennotvalid";
            }
        }
        # Delete token if not valid or all is ok
        if ( $result === "tokennotvalid" ) {
            $_SESSION = array();
            session_destroy();
        }
        if ( $result === "" ) {
            $_SESSION = array();
            session_destroy();

            // Build and store token

            // Use PHP session to register token
            // We do not generate cookie
            ini_set("session.use_cookies",0);
            ini_set("session.use_only_cookies",1);

            session_name("token");
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['time']  = time();

            $token = encrypt(session_id(), $this->config['keyphrase']);

            // Redirect to resetbytoken page
            $reset_url = generate_reset_url($this->config['reset_url'], array('source' => 'sms', 'token' => $token));

            if ( !empty($reset_request_log) ) {
                error_log("Send reset URL $reset_url \n\n", 3, $reset_request_log);
            } else {
                error_log("Send reset URL $reset_url");
            }

            return $this->redirect($reset_url);
        }

        return $this->renderTokenForm($result, $request->get('token'));
    }

    private function generateAndSendSmsToken(Request $request) {
        $encrypted_sms_login = $request->get("encrypted_sms_login");

        $decrypted_sms_login = explode(':', decrypt($encrypted_sms_login, $this->config['keyphrase']));
        $sms = $decrypted_sms_login[0];
        $login = $decrypted_sms_login[1];

        // Generate sms token and send by sms

        // Generate sms token
        $smstoken = generate_sms_token($this->config['sms_token_length']);

        // Create temporary session to avoid token replay
        ini_set("session.use_cookies",0);
        ini_set("session.use_only_cookies",1);

        session_name("smstoken");
        session_start();
        $_SESSION['login']    = $login;
        $_SESSION['smstoken'] = $smstoken;
        $_SESSION['time']     = time();
        $_SESSION['attempts'] = 0;

        $data = array(
            "sms_attribute" => $sms,
            "smsresetmessage" => $this->config['messages']['smsresetmessage'],
            "smstoken" => $smstoken,
        ) ;

        /** @var SmsNotificationService $smsNotificationService */
        $smsNotificationService = $this->get('sms_notification_service');

        // Send message
        $result = $smsNotificationService->send($sms, $login, $this->config['smsmail_subject'], $this->config['sms_message'], $data, $smstoken);

        $token = '';
        if($result == 'smssent') {
            $token  = encrypt(session_id(), $this->config['keyphrase']);
        }

        return $this->renderTokenForm($result, $token);
    }

    private function processSearchUserFormData(Request $request) {
        $login = $request->get('login');

        // Check the entered username for characters that our installation doesn't support
        /** @var UsernameValidityChecker $usernameValidityChecker */
        $usernameValidityChecker = $this->get('username_validity_checker');

        $result = $usernameValidityChecker->evaluate($login);
        if($result != '') {
            return $this->renderSearchUserFormWithError($result, $request);
        }

        // Check reCAPTCHA
        if ( $this->config['use_recaptcha'] ) {
            /** @var RecaptchaService $recaptchaService */
            $recaptchaService = $this->get('recaptcha_service');

            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
            if($result != '') {
                return $this->renderSearchUserFormWithError($result, $request);
            }
        }

        // Check sms
        /** @var LdapClient $ldapClient */
        $ldapClient = $this->get('ldap_client');

        $result = $ldapClient->connect();
        if($result != '') {
            return $this->renderSearchUserFormWithError($result, $request);
        }

        $context = array();
        $result = $ldapClient->findUserSms($login, $context);
        if($result != 'smsuserfound') {
            return $this->renderSearchUserFormWithError($result, $request);
        }

        $sms = $context['user_sms'];
        $encrypted_sms_login = encrypt("$sms:$login", $this->config['keyphrase']);

        // Render associated template
        return $this->renderSearchUserFromEntry($result, $context, $login, $encrypted_sms_login, $sms);
    }

    private function renderSearchUserFromEntry($result, $context, $login, $encrypted_sms_login, $sms) {
        return $this->render('sendsms.twig', array(
            'result' => $result,
            'displayname' => $context['user_displayname'],
            'login' => $login,
            'encrypted_sms_login' => $encrypted_sms_login,
            'sms' => $this->config['sms_partially_hide_number'] ? (substr_replace($sms, '****', 4 , 4)) : $sms,
            'recaptcha_publickey' => $this->config['recaptcha_publickey'],
            'recaptcha_theme' => $this->config['recaptcha_theme'],
            'recaptcha_type' => $this->config['recaptcha_type'],
            'recaptcha_size' => $this->config['recaptcha_size'],
        ));
    }

    private function renderSearchUserFormEmpty(Request $request) {
        // Render associated template
        return $this->render('sendsms.twig', array(
            'result' => 'emptysendsmsform',
            'login' => $request->get('login'),
            'recaptcha_publickey' => $this->config['recaptcha_publickey'],
            'recaptcha_theme' => $this->config['recaptcha_theme'],
            'recaptcha_type' => $this->config['recaptcha_type'],
            'recaptcha_size' => $this->config['recaptcha_size'],
        ));
    }

    private function renderSearchUserFormWithError($result, Request $request) {
        // Render associated template
        return $this->render('sendsms.twig', array(
            'result' => $result,
            'login' => $request->get('login'),
            'recaptcha_publickey' => $this->config['recaptcha_publickey'],
            'recaptcha_theme' => $this->config['recaptcha_theme'],
            'recaptcha_type' => $this->config['recaptcha_type'],
            'recaptcha_size' => $this->config['recaptcha_size'],
        ));
    }

    private function renderErrorPage($result) {
        // Render associated template
        return $this->render('sendsms.twig', array(
            'result' => $result,
        ));
    }

    private function renderTokenForm($result, $token) {
        return $this->render('sendsms.twig', array(
            'result' => $result,
            'token' => $token,
        ));
    }
}
