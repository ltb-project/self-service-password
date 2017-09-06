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

        if ( $result === "" ) {
            $ldapClient = new LdapClient($this->config);

            $result = $ldapClient->connect();
        }

        // Check question/answer
        if ( $result === "" ) {
            $context = array();
            $result = $ldapClient->checkQuestionAnswer($login, $question, $answer, $context);
        }

        // Check and register new password

        // Match new and confirm password
        if ( $result === "" ) {
            if ( $newpassword != $confirmpassword ) { $result="nomatch"; }
        }

        // Check password strength
        if ( $result === "" ) {
            $passwordStrengthChecker = new PasswordStrengthChecker($pwd_policy_config);
            $result = $passwordStrengthChecker->evaluate( $newpassword, $oldpassword, $login );
        }

        // Change password
        if ($result === "") {
            $result = $ldapClient->changePassword($context['user_dn'], $newpassword, '', $context);
        }

        if ( $result === "passwordchanged" ) {
            // Notify password change
            if ($notify_on_change and $context['user_mail']) {
                $mailNotificationService = new MailNotificationService($mailer);
                $data = array( "login" => $login, "mail" => $context['user_mail'], "password" => $newpassword);
                $mailNotificationService->send($context['user_mail'], $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data);
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
        ));
    }
}

$controller = new ResetByQuestionsController($config);
return $controller->indexAction($request);
