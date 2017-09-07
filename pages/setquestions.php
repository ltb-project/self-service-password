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

# This page is called to set answers for a user

class SetQuestionsController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get("login");
        $password = $request->request->get("password");;
        $question = $request->request->get("question");
        $answer = $request->request->get("answer");

        if (empty($login)) { $result = "loginrequired"; }
        if (empty($password)) { $result = "passwordrequired"; }
        if (empty($question)) { $result = "questionrequired"; }
        if (empty($answer)) { $result = "answerrequired"; }

        if (empty($login) and empty($password) and empty($question) and empty($answer)) {
            $result = "emptysetquestionsform";
        }

        // Check the entered username for characters that our installation doesn't support
        if ( $result === "" ) {
            /** @var UsernameValidityChecker $usernameValidityChecker */
            $usernameValidityChecker = $this->get('username_validity_checker');
            $result = $usernameValidityChecker->evaluate($login);
        }

        // Check reCAPTCHA
        if ( $result === "" && $use_recaptcha ) {
            /** @var RecaptchaService $recaptchaService */
            $recaptchaService = $this->get('recaptcha_service');
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
        }

        // Check password
        if ( $result === "" ) {
            /** @var LdapClient $ldapClient */
            $ldapClient = $this->get('ldap_client');

            $result = $ldapClient->connect();
        }

        if ( $result === "" ) {
            $context = array();
            $result = $ldapClient->checkOldPassword3($login, $password, $context);
        }

        // Register answer
        if ( $result === "" ) {
            $result = $ldapClient->changeQuestion($context['user_dn'], $question, $answer);
        }

        // Render associated template
        return $this->render('setquestions.twig', array(
            'result' => $result,
            'show_help' => $show_help,
            'login' => $login,
            'questions' => $messages["questions"],
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
        ));
    }
}

$controller = new SetQuestionsController($config, $container);
return $controller->indexAction($request);
