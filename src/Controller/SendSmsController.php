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
namespace App\Controller;

use App\Exception\LdapEntryFoundInvalid;
use App\Exception\LdapError;
use App\Exception\LdapInvalidUserCredentials;
use App\Framework\Controller;
use App\Framework\Request;

use App\Service\EncryptionService;
use App\Service\LdapClient;
use App\Service\RecaptchaService;
use App\Service\SmsNotificationService;
use App\Service\UsernameValidityChecker;
use App\Utils\ResetUrlGenerator;
use App\Utils\SmsTokenGenerator;

class SendSmsController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction(Request $request) {
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

        /** @var EncryptionService $encryptionService */
        $encryptionService = $this->get('encryption_service');

        # Open session with the token
        $tokenid = $encryptionService->decrypt($request->get("token"));
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

            /** @var EncryptionService $encryptionService */
            $encryptionService = $this->get('encryption_service');

            $token = $encryptionService->encrypt(session_id());

            /** @var ResetUrlGenerator $resetUrlGenerator */
            $resetUrlGenerator = $this->get('reset_url_generator');

            // Redirect to resetbytoken page
            $reset_url = $resetUrlGenerator->generate_reset_url(array('source' => 'sms', 'token' => $token));

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
        /** @var EncryptionService $encryptionService */
        $encryptionService = $this->get('encryption_service');

        $encrypted_sms_login = $request->get("encrypted_sms_login");

        $decrypted_sms_login = explode(':', $encryptionService->decrypt($encrypted_sms_login));
        $sms = $decrypted_sms_login[0];
        $login = $decrypted_sms_login[1];

        // Generate sms token and send by sms

        /** @var SmsTokenGenerator $smsTokenGenerator */
        $smsTokenGenerator = $this->get('sms_token_generator');

        // Generate sms token
        $smstoken = $smsTokenGenerator->generate_sms_token();

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

        /** @var SmsNotificationService $smsService */
        $smsService = $this->get('sms_notification_service');

        // Send message
        $result = $smsService->send($sms, $login, $this->config['smsmail_subject'], $this->config['sms_message'], $data, $smstoken);

        $token = '';
        if($result == 'smssent') {
            /** @var EncryptionService $encryptionService */
            $encryptionService = $this->get('encryption_service');

            $token  = $encryptionService->encrypt(session_id());
        }

        return $this->renderTokenForm($result, $token);
    }

    private function processSearchUserFormData(Request $request) {
        $login = $request->get('login');

        // Check the entered username for characters that our installation doesn't support
        /** @var UsernameValidityChecker $usernameChecker */
        $usernameChecker = $this->get('username_validity_checker');

        $result = $usernameChecker->evaluate($login);
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

        $context = array();

        try {
            $ldapClient->connect();
            $ldapClient->findUserSms($login, $context);
        } catch (LdapError $e) {
            return $this->renderSearchUserFormWithError('ldaperror', $request);
        } catch (LdapInvalidUserCredentials $e) {
            return $this->renderSearchUserFormWithError('badcredentials', $request);
        } catch (LdapEntryFoundInvalid $e) {
            return $this->renderSearchUserFormWithError('smsnonumber', $request);

        }

        $sms = $context['user_sms'];

        /** @var EncryptionService $encryptionService */
        $encryptionService = $this->get('encryption_service');

        $encrypted_sms_login = $encryptionService->encrypt("$sms:$login");

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
        ));
    }

    private function renderSearchUserFormEmpty(Request $request) {
        return $this->render('sendsms.twig', array(
            'result' => 'emptysendsmsform',
            'login' => $request->get('login'),
        ));
    }

    private function renderSearchUserFormWithError($result, Request $request) {
        return $this->render('sendsms.twig', array(
            'result' => $result,
            'login' => $request->get('login'),
        ));
    }

    private function renderErrorPage($result) {
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
