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

# This page is called to reset a password when a valid token is found in URL

namespace App\Controller;

use App\Exception\LdapError;
use App\Exception\LdapInvalidUserCredentials;
use App\Exception\LdapUpdateFailed;
use App\Exception\TokenException;
use App\Framework\Controller;

use App\Service\LdapClient;
use App\Service\MailNotificationService;
use App\Service\PasswordStrengthChecker;
use App\Service\PosthookExecutor;
use App\Service\RecaptchaService;
use App\Service\TokenManagerService;
use Symfony\Component\HttpFoundation\Request;

class ResetByTokenController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction(Request $request) {
        $problems = [];
        $login = '';

        /** @var TokenManagerService $tokenManagerService */
        $tokenManagerService = $this->get('token_manager_service');

        // First, de we have a valid token ?
        $token = $request->get('token');
        if (!$token) {
            $problems[] = 'tokenrequired';
        } else {
            // Get token
            try {
                $login = $tokenManagerService->openToken($token);
            } catch (TokenException $e) {
                $problems[] = 'tokennotvalid';
            }
        }
        if(count($problems)) {
            return $this->renderErrorPage($problems[0], $request);
        }

        // Next is the form submitted ?
        $newpassword = $request->request->get("newpassword");
        $confirmpassword = $request->request->get('confirmpassword');
        if (!$newpassword) {
            $problems[] = 'newpasswordrequired';
        }
        if (!$confirmpassword) {
            $problems[] = 'confirmpasswordrequired';
        }

        // Match new and confirm password
        if ( $newpassword != $confirmpassword ) {
            $problems[] = 'nomatch';
        }

        /** @var PasswordStrengthChecker $passwordChecker */
        $passwordChecker = $this->get('password_strength_checker');

        // Check password strength
        $problems += $passwordChecker->evaluate( $newpassword, '', $login );

        if(count($problems)) {
            return $this->renderErrorPage($problems[0], $request);
        }

        // Okay the form is submitted but is the CAPTCHA valid ?
        if ( $this->config['use_recaptcha'] ) {
            /** @var RecaptchaService $recaptchaService */
            $recaptchaService = $this->get('recaptcha_service');
            $result = $recaptchaService->verify($request->request->get('g-recaptcha-response'), $login);
            if($result != '') {
                $this->renderErrorPage($result, $request);
            }
        }

        // All good, we try

        $notify = $this->config['notify_on_change'];

        /** @var LdapClient $ldapClient */
        $ldapClient = $this->get('ldap_client');

        try {
            $ldapClient->connect();
            $wantedContext = ['dn', 'samba', 'shadow'];
            // Get user email for notification
            if ($notify) {
                $wantedContext[] = 'mail';
            }
            $context = [];
            $ldapClient->fetchUserEntryContext($login, $wantedContext, $context);
            // Change password
            $ldapClient->changePassword($context['user_dn'], $newpassword, '', $context);
        } catch (LdapError $e) {
            return $this->renderErrorPage('ldaperror', $request);
        } catch (LdapInvalidUserCredentials $e) {
            return $this->renderErrorPage('badcredentials', $request);
        } catch (LdapUpdateFailed $e) {
            return $this->renderErrorPage('passwordnotchanged', $request);
        }

        // Delete token if all is ok
        $tokenManagerService->destroyToken();

        // Notify password change
        if ($notify and $context['user_mail']) {
            /** @var MailNotificationService $mailService */
            $mailService = $this->get('mail_notification_service');

            $data = ["login" => $login, "mail" => $context['user_mail'], "password" => $newpassword];
            $mailService->send($context['user_mail'], $this->config['messages']["changesubject"], $this->config['messages']["changemessage"].$this->config['mail_signature'], $data);
        }

        // Posthook
        if ( isset($this->config['posthook']) ) {
            /** @var PosthookExecutor $posthookExecutor */
            $posthookExecutor = $this->get('posthook_executor');

            $posthookExecutor->execute($login, $newpassword);
        }

        // render success page
        return $this->render('resetbytoken.twig', ['result' => 'passwordchanged']);
    }

    private function renderErrorPage($result, Request $request) {
        return $this->render('resetbytoken.twig', [
            'result' => $result,
            'source' => $request->get('source'),
            'token' => $request->get('token'),
            'login' => $request->get('login'),
        ]);
    }
}
