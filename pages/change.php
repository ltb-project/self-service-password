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
            /** @var UsernameValidityChecker $usernameValidityChecker */
            $usernameValidityChecker = $this->get('username_validity_checker');
            $result = $usernameValidityChecker->evaluate($login);
        }

        // Match new and confirm password
        if ( $newpassword != $confirmpassword ) { $result="nomatch"; }

        // Check reCAPTCHA
        if ( $result === "" && $use_recaptcha ) {
            /** @var RecaptchaService $recaptchaService */
            $recaptchaService = $this->get('recaptcha_service');
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
        }

        // Ldap connect
        // Check old password
        if ( $result === "" ) {
            /** @var LdapClient $ldapClient */
            $ldapClient = $this->get('ldap_client');

            $result = $ldapClient->connect();
        }

        // Check old password
        if ( $result === "" ) {
            $context = array ();
            $result = $ldapClient->checkOldPassword($login, $oldpassword, $context);
        }

        // Check password strength
        if ( $result === "" ) {
            /** @var PasswordStrengthChecker $passwordStrengthChecker */
            $passwordStrengthChecker = $this->get('password_strength_checker');
            $result = $passwordStrengthChecker->evaluate( $newpassword, $oldpassword, $login );
        }

        // Change password
        if ( $result === "" ) {
            $result = $ldapClient->changePassword($context['user_dn'], $newpassword, $oldpassword, $context);
        }

        if ( $result === "passwordchanged" ) {
            // Notify password change
            if ($notify_on_change and $context['user_mail']) {
                /** @var MailNotificationService $mailNotificationService */
                $mailNotificationService = $this->get('mail_notification_service');
                $data = array( "login" => $login, "mail" => $context['user_mail'], "password" => $newpassword);
                $mailNotificationService->send($context['user_mail'], $messages["changesubject"], $messages["changemessage"].$mail_signature, $data);
            }

            // Posthook
            if ( isset($posthook) ) {
                /** @var PosthookExecutor $posthookExecutor */
                $posthookExecutor = $this->get('posthook_executor');
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

$controller = new ChangeController($config, $container);
return $controller->indexAction($request);
