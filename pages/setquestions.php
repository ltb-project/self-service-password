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
        if($this->isFormSubmitted($request)) {
            return $this->processFormData($request);
        }

        return $this->renderFormEmpty($request);
    }

    private function isFormSubmitted(Request $request) {
        return $request->get('login')
            && $request->request->get("password")
            && $request->request->get("question")
            && $request->request->get("answer");
    }

    private function processFormData(Request $request) {
        $login = $request->get("login");
        $password = $request->request->get("password");;
        $question = $request->request->get("question");
        $answer = $request->request->get("answer");

        $result = '';
        if (empty($login)) { $result = "loginrequired"; }
        if (empty($password)) { $result = "passwordrequired"; }
        if (empty($question)) { $result = "questionrequired"; }
        if (empty($answer)) { $result = "answerrequired"; }
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

        $context = array();

        // Check password
        $result = $ldapClient->checkOldPassword3($login, $password, $context);
        if($result != '') {
            return $this->renderFormWithError($result, $request);
        }

        // Register answer
        $result = $ldapClient->changeQuestion($context['user_dn'], $question, $answer);
        if($result != 'answerchanged') {
            return $this->renderFormWithError($result, $request);
        }

        return $this->renderPageSuccess($request);
    }

    private function renderFormEmpty(Request $request) {
        // Render associated template
        return $this->render('setquestions.twig', array(
            'result' => 'emptysetquestionsform',
            'show_help' => $this->config['show_help'],
            'login' => $request->get('login'),
            'questions' => $this->config['messages']["questions"],
            'recaptcha_publickey' => $this->config['recaptcha_publickey'],
            'recaptcha_theme' => $this->config['recaptcha_theme'],
            'recaptcha_type' => $this->config['recaptcha_type'],
            'recaptcha_size' => $this->config['recaptcha_size'],
        ));
    }

    private function renderFormWithError($result, Request $request) {
        return $this->render('setquestions.twig', array(
            'result' => $result,
            'show_help' => $this->config['show_help'],
            'login' => $request->get('login'),
            'questions' => $this->config['messages']["questions"],
            'recaptcha_publickey' => $this->config['recaptcha_publickey'],
            'recaptcha_theme' => $this->config['recaptcha_theme'],
            'recaptcha_type' => $this->config['recaptcha_type'],
            'recaptcha_size' => $this->config['recaptcha_size'],
        ));
    }

    private function renderPageSuccess(Request $request) {
        return $this->render('setquestions.twig', array(
            'result' => 'answerchanged',
            'show_help' => $this->config['show_help'],
            'login' => $request->get('login'),
            'questions' => $this->config['messages']["questions"],
            'recaptcha_publickey' => $this->config['recaptcha_publickey'],
            'recaptcha_theme' => $this->config['recaptcha_theme'],
            'recaptcha_type' => $this->config['recaptcha_type'],
            'recaptcha_size' => $this->config['recaptcha_size'],
        ));
    }
}
