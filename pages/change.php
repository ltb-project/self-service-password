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
    public function indexAction(Request $request) {
        if($this->isFormSubmitted($request)) {
            return $this->processFormData($request);
        }

        return $this->renderFormEmpty($request);
    }

    private function isFormSubmitted(Request $request) {
        return $request->get("login")
            && $request->request->has("newpassword")
            && $request->request->has("oldpassword")
            && $request->request->has("confirmpassword");
    }

    private function processFormData(Request $request) {
        $login = $request->get("login", "");
        $oldpassword = $request->request->get("oldpassword", "");
        $newpassword = $request->request->get("newpassword", "");
        $confirmpassword = $request->request->get("confirmpassword", "");

        $missings = array();
        if (!$login) { $missings[] = "loginrequired"; }
        if (!$oldpassword) { $missings[] = "newpasswordrequired"; }
        if (!$newpassword) { $missings[] = "oldpasswordrequired"; }
        if (!$confirmpassword) { $missings[] = "confirmpasswordrequired"; }

        if(count($missings) > 0) {
            return $this->renderFormWithError($missings[0], $request);
        }

        /** @var UsernameValidityChecker $usernameValidityChecker */
        $usernameValidityChecker = $this->get('username_validity_checker');

        // Check the entered username for characters that our installation doesn't support
        $result = $usernameValidityChecker->evaluate($login);
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        // Match new and confirm password
        if ( $newpassword != $confirmpassword ) {
            return $this->renderFormWithError("nomatch", $request);
        }

        /** @var PasswordStrengthChecker $passwordStrengthChecker */
        $passwordStrengthChecker = $this->get('password_strength_checker');

        // Check password strength
        $result = $passwordStrengthChecker->evaluate( $newpassword, $oldpassword, $login );
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

        // Ldap connect
        $result = $ldapClient->connect();
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        $context = array ();

        // Check old password
        $result = $ldapClient->checkOldPassword($login, $oldpassword, $context);
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        // Change password
        $result = $ldapClient->changePassword($context['user_dn'], $newpassword, $oldpassword, $context);
        if($result != 'passwordchanged') {
            return $this->renderFormWithError($result, $request);
        }

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
            $posthookExecutor->execute($login, $newpassword, $oldpassword);
        }

        return $this->renderSuccessPage();
    }

    private function getTemplateVars($result, Request $request) {
        $vars = array(
            'result' => $result,
            'login' => $request->get('login'),
        );

        return $vars;
    }

    private function renderFormEmpty($request) {
        $templateVars = $this->getTemplateVars('emptychangeform', $request);
        return $this->render('change.twig', $templateVars);
    }

    private function renderFormWithError($result, $request) {
        $templateVars = $this->getTemplateVars($result, $request);
        return $this->render('change.twig', $templateVars);
    }

    private function renderSuccessPage() {
        return $this->render('change.twig', array(
            'result' => 'passwordchanged',
        ));
    }
}
