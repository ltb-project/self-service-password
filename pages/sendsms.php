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
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get("login");
        $sms = "";
        $smstoken = $request->get("smstoken");
        $token = $request->get("token");
        $encrypted_sms_login = $request->get("encrypted_sms_login");

        if (!$crypt_tokens) {
            $result = "crypttokensrequired";
        } elseif (!empty($token) and !empty($smstoken)) {
            # Open session with the token
            $tokenid = decrypt($token, $keyphrase);

            ini_set("session.use_cookies",0);
            ini_set("session.use_only_cookies",1);

            # Manage lifetime with sessions properties
            if (isset($token_lifetime)) {
                ini_set("session.gc_maxlifetime", $token_lifetime);
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
                $result = "tokennotvalid";
                error_log("Unable to open session $smstokenid");
            } elseif ($sessiontoken != $smstoken) {
                if ($attempts < $max_attempts) {
                    $_SESSION['attempts'] = $attempts + 1;
                    $result = "tokenattempts";
                    error_log("SMS token $smstoken not valid, attempt $attempts");
                }
                else {
                    $result = "tokennotvalid";
                    error_log("SMS token $smstoken not valid");
                }
            } elseif (isset($token_lifetime)) {
                # Manage lifetime with session content
                $tokentime = $_SESSION['time'];
                if ( time() - $tokentime > $token_lifetime ) {
                    $result = "tokennotvalid";
                    error_log("Token lifetime expired");
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
                $result = "buildtoken";
            }
        } elseif (!empty($encrypted_sms_login)) {
            $decrypted_sms_login = explode(':', decrypt($encrypted_sms_login, $keyphrase));
            $sms = $decrypted_sms_login[0];
            $login = $decrypted_sms_login[1];
            $result = "sendsms";
        } elseif (empty($login)) {
            $result = "emptysendsmsform";
        }

        // Check the entered username for characters that our installation doesn't support
        if ( $result === "" ) {
            $usernameValidityChecker = new UsernameValidityChecker($login_forbidden_chars);
            $result = $usernameValidityChecker->evaluate($login);
        }

        // Check reCAPTCHA
        if ( $result === "" && $use_recaptcha ) {
            $recaptchaService = new RecaptchaService($recaptcha_privatekey, $recaptcha_request_method);
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
        }

        // Check sms
        if ( $result === "" ) {
            $ldapClient = new LdapClient($this->config);
            $result = $ldapClient->connect();
        }

        if ( $result === "" ) {
            $context = array();
            $result = $ldapClient->findUserSms($login, $context);

            if($result == 'smsuserfound') {
                $sms = $context['user_sms'];
                $encrypted_sms_login = encrypt("$sms:$login", $keyphrase);
            }
        }

        // Generate sms token and send by sms
        if ( $result === "sendsms" ) {

            // Generate sms token
            $smstoken = generate_sms_token($sms_token_length);

            // Create temporary session to avoid token replay
            ini_set("session.use_cookies",0);
            ini_set("session.use_only_cookies",1);

            session_name("smstoken");
            session_start();
            $_SESSION['login']    = $login;
            $_SESSION['smstoken'] = $smstoken;
            $_SESSION['time']     = time();
            $_SESSION['attempts'] = 0;

            $data = array( "sms_attribute" => $sms, "smsresetmessage" => $messages['smsresetmessage'], "smstoken" => $smstoken) ;

            // Send message

            if( !$sms_method ) { $sms_method = "mail"; }

            if ( $sms_method === "mail" ) {

                if ( send_mail($mailer, $smsmailto, $mail_from, $mail_from_name, $smsmail_subject, $sms_message, $data) ) {
                    $token  = encrypt(session_id(), $keyphrase);
                    $result = "smssent";
                    if ( !empty($reset_request_log) ) {
                        error_log("Send SMS code $smstoken by $sms_method to $sms\n\n", 3, $reset_request_log);
                    } else {
                        error_log("Send SMS code $smstoken by $sms_method to $sms");
                    }
                } else {
                    $result = "smsnotsent";
                    error_log("Error while sending sms by $sms_method to $sms (user $login)");
                }

            }

            if ( $sms_method === "api" ) {
                if (!$sms_api_lib) {
                    $result = "smsnotsent";
                    error_log('No API library found, set $sms_api_lib in configuration.');
                } else {
                    include_once($sms_api_lib);
                    $sms_message = str_replace('{smsresetmessage}', $messages['smsresetmessage'], $sms_message);
                    $sms_message = str_replace('{smstoken}', $smstoken, $sms_message);
                    if ( send_sms_by_api($sms, $sms_message) ) {
                        $token  = encrypt(session_id(), $keyphrase);
                        $result = "smssent";
                        if ( !empty($reset_request_log) ) {
                            error_log("Send SMS code $smstoken by $sms_method to $sms\n\n", 3, $reset_request_log);
                        } else {
                            error_log("Send SMS code $smstoken by $sms_method to $sms");
                        }
                    } else {
                        $result = "smsnotsent";
                        error_log("Error while sending sms by $sms_method to $sms (user $login)");
                    }
                }
            }

        }

        // Build and store token
        if ( $result === "buildtoken" ) {

            // Use PHP session to register token
            // We do not generate cookie
            ini_set("session.use_cookies",0);
            ini_set("session.use_only_cookies",1);

            session_name("token");
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['time']  = time();

            $token = encrypt(session_id(), $keyphrase);

            $result = "redirect";
        }

        // Redirect to resetbytoken page
        if ( $result === "redirect" ) {
            $reset_url = generate_reset_url($reset_url, array('source' => 'sms', 'token' => $token));

            if ( !empty($reset_request_log) ) {
                error_log("Send reset URL $reset_url \n\n", 3, $reset_request_log);
            } else {
                error_log("Send reset URL $reset_url");
            }

            // Redirect
            header("Location: " . $reset_url);
            exit;
        }

        // Render associated template
        return $this->render('sendsms.twig', array(
            'result' => $result,
            'displayname' => $displayname,
            'login' => $login,
            'encrypted_sms_login' => $encrypted_sms_login,
            'token' => $token,
            'sms' => $sms_partially_hide_number ? (substr_replace($sms, '****', 4 , 4)) : $sms,
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
        ));
    }
}

$controller = new SendSmsController($config);
return $controller->indexAction($request);
