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

namespace App\Controller;

use App\Exception\LdapError;
use App\Exception\LdapInvalidUserCredentials;
use App\Exception\LdapUpdateFailed;
use App\Framework\Controller;

use App\Service\LdapClient;
use App\Service\PasswordStrengthChecker;
use App\Service\RecaptchaService;
use App\Service\UsernameValidityChecker;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;

class ChangeController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction(Request $request) {
        if($this->isFormSubmitted($request)) {
            return $this->processFormData($request);
        }

        // Render empty form
        return $this->render('change.twig', [
            'result' => 'emptychangeform',
            'login' => $request->get('login'),
        ]);
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

        $missings = [];
        if (!$login) { $missings[] = "loginrequired"; }
        if (!$oldpassword) { $missings[] = "newpasswordrequired"; }
        if (!$newpassword) { $missings[] = "oldpasswordrequired"; }
        if (!$confirmpassword) { $missings[] = "confirmpasswordrequired"; }

        if(count($missings) > 0) {
            return $this->renderFormWithError($missings[0], $request);
        }

        $errors = [];

        /** @var UsernameValidityChecker $usernameChecker */
        $usernameChecker = $this->get('username_validity_checker');

        // Check the entered username for characters that our installation doesn't support
        $result = $usernameChecker->evaluate($login);
        if($result != '') {
            $errors[] = $result;
        }

        // Match new and confirm password
        if ( $newpassword != $confirmpassword ) {
            $errors[] = 'nomatch';
        }

        /** @var PasswordStrengthChecker $passwordChecker */
        $passwordChecker = $this->get('password_strength_checker');

        // Check password strength
        $errors += $passwordChecker->evaluate( $newpassword, $oldpassword, $login );

        if(count($errors) > 0) {
            return $this->renderFormWithError($errors[0], $request);
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

        try {
            $ldapClient->connect();
            // we want user's email address if we have to notify
            $wanted = $this->config['notify_on_change'] ? ['dn', 'samba', 'shadow', 'mail'] : ['dn', 'samba', 'shadow'];
            $context = [];
            $ldapClient->fetchUserEntryContext($login, $wanted, $context);
            $ldapClient->checkOldPassword($oldpassword, $context);
            $ldapClient->changePassword($context['user_dn'], $newpassword, $oldpassword, $context);
        } catch (LdapError $e) {
            return $this->renderFormWithError('ldaperror', $request);
        } catch (LdapInvalidUserCredentials $e) {
            return $this->renderFormWithError('badcredentials', $request);
        } catch (LdapUpdateFailed $e) {
            return $this->renderFormWithError('passworderror', $request);
        }

        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $this->get('event_dispatcher');

        $event = new GenericEvent();
        $event['login'] = $login;
        $event['new_password'] = $newpassword;
        $event['old_password'] = $oldpassword;
        $event['context'] = $context;

        $eventDispatcher->dispatch('password.changed', $event);

        // render page success
        return $this->render('change.twig', ['result' => 'passwordchanged']);
    }

    private function renderFormWithError($result, Request $request) {
        return $this->render('change.twig', [
            'result' => $result,
            'login' => $request->get('login'),
        ]);
    }
}
