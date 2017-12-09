<?php
/*
 * LTB Self Service Password
 *
 * Copyright (C) 2009 Clement OUDOT
 * Copyright (C) 2009 LTB-project.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * GPL License: http://www.gnu.org/licenses/gpl.txt
 */

namespace App\Controller;

use App\Exception\LdapErrorException;
use App\Exception\LdapInvalidUserCredentialsException;
use App\Exception\LdapUpdateFailedException;
use App\Framework\Controller;

use App\Service\LdapClient;
use App\Service\RecaptchaService;
use App\Service\UsernameValidityChecker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * This page is called to set answers for a user
 */
class ChangeSecurityQuestionsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        if ($this->isFormSubmitted($request)) {
            return $this->processFormData($request);
        }

        // render form empty
        return $this->render('change_security_question_form.twig', [
            'result' => 'emptysetquestionsform',
            'login' => $request->get('login'),
            'questions' => $this->config['messages']["questions"],
        ]);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function isFormSubmitted(Request $request)
    {
        return $request->get('login')
            && $request->request->get("password")
            && $request->request->get("question")
            && $request->request->get("answer");
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    private function processFormData(Request $request)
    {
        $login = $request->get("login");
        $password = $request->request->get("password");
        $question = $request->request->get("question");
        $answer = $request->request->get("answer");

        $missings = [];
        if (empty($login)) {
            $missings[] = "loginrequired";
        }
        if (empty($password)) {
            $missings[] = "passwordrequired";
        }
        if (empty($question)) {
            $missings[] = "questionrequired";
        }
        if (empty($answer)) {
            $missings[] = "answerrequired";
        }
        if (count($missings)) {
            return $this->renderFormWithError($missings[0], $request);
        }

        $errors = [];

        /** @var UsernameValidityChecker $usernameChecker */
        $usernameChecker = $this->get('username_validity_checker');

        // Check the entered username for characters that our installation doesn't support
        $result = $usernameChecker->evaluate($login);
        if ('' !== $result) {
            $errors[] = $result;
        }

        if (count($errors)) {
            return $this->renderFormWithError($errors[0], $request);
        }

        // Check reCAPTCHA
        if ($this->config['use_recaptcha']) {
            /** @var RecaptchaService $recaptchaService */
            $recaptchaService = $this->get('recaptcha_service');

            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
            if ('' !== $result) {
                return $this->renderFormWithError($result, $request);
            }
        }

        /** @var LdapClient $ldapClient */
        $ldapClient = $this->get('ldap_client');

        try {
            $ldapClient->connect();
            $ldapClient->fetchUserEntryContext($login, ['dn'], $context);
            $context = [];
            $ldapClient->checkOldPassword($password, $context);
            // Register answer
            $ldapClient->changeQuestion($context['user_dn'], $question, $answer);
        } catch (LdapErrorException $e) {
            return $this->renderFormWithError('ldaperror', $request);
        } catch (LdapInvalidUserCredentialsException $e) {
            return $this->renderFormWithError('badcredentials', $request);
        } catch (LdapUpdateFailedException $e) {
            return $this->renderFormWithError('answermoderror', $request);
        }

        // render page success
        return $this->render('change_security_question_success.twig');
    }

    /**
     * @param string  $result
     * @param Request $request
     *
     * @return Response
     */
    private function renderFormWithError($result, Request $request)
    {
        return $this->render('change_security_question_form.twig', [
            'result' => $result,
            'login' => $request->get('login'),
            'questions' => $this->config['messages']["questions"],
        ]);
    }
}
