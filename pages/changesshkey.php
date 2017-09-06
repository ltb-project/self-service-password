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

# This page is called to change sshPublicKey

class SshKeyController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get("login", "");
        $password = $request->request->get("password", "");
        $sshkey = $request->request->get("sshkey", "");

        $missings = array();
        if (!$request->get("login")) { $missings[] = "loginrequired"; }
        if (!$request->request->has("password")) { $missings[] = "passwordrequired"; }
        if (!$request->request->has("sshkey")) { $missings[] = "sshkeyrequired"; }

        if(count($missings) > 0) {
            $result = count($missings) == 3 ? 'emptysshkeychangeform' : $missings[0];
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

        if ( $result === "" ) {
            $ldapClient = new LdapClient($this->config);

            $result = $ldapClient->connect();
        }

        // Check password
        if ( $result === "" ) {
            $context = array ();
            $result = $ldapClient->checkOldPassword2($login, $password, $context);
        }

        // Change sshPublicKey
        if ( $result === "" ) {
            $result = $ldapClient->changeSshKey($context['user_dn'], $sshkey);
        }

        if ( $result === "sshkeychanged") {
            // Notify password change
            if ($notify_on_sshkey_change and $context['user_mail']) {
                $mailNotificationService = new MailNotificationService($mailer);
                $data = array( "login" => $login, "mail" => $context['user_mail'], "sshkey" => $sshkey);
                $mailNotificationService->send($context['user_mail'], $mail_from, $mail_from_name, $messages["changesshkeysubject"], $messages["changesshkeymessage"].$mail_signature, $data);
            }
        }

        // Render associated template
        return $this->render('changesshkey.twig', array(
            'result' => $result,
            'show_help' => $show_help,
            'login' => $login,
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
        ));
    }
}

$controller = new SshKeyController($config);
return $controller->indexAction($request);
