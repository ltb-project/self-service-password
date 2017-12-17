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

use Symfony\Component\DependencyInjection\Reference;

$container->register('locale.subscriber', '\App\EventSubscriber\LocaleSubscriber')
    ->addArgument('%locale%')
    ->addArgument(new Reference('translator'))
    ->addArgument('%app_locales%')
    ->addTag('kernel.event_subscriber')
;

$container->register('posthook.subscriber', '\App\EventSubscriber\PosthookSubscriber')
    ->addArgument('%enable_posthook%')
    ->addArgument(new Reference('posthook_executor'))
    ->addTag('kernel.event_subscriber')
;

$container->register('notifier.subscriber', '\App\EventSubscriber\NotificationSubscriber')
    ->addArgument(new Reference('mail_notification_service'))
    ->addArgument(new Reference('translator'))
    ->addArgument('%mail_signature%')
    ->addArgument('%notify_user_on_password_change%')
    ->addArgument('%notify_user_on_sshkey_change%')
    ->addTag('kernel.event_subscriber')
;

$container->register('encryption_service', '\App\Service\EncryptionService')
    ->addArgument('%secret%')
    ->addMethodCall('setLogger', [new Reference('logger')])
;

$container->register('sms_token_generator', '\App\Utils\SmsTokenGenerator')
    ->addArgument('%sms_token_length%')
;

$container->register('username_validity_checker', '\App\Service\UsernameValidityChecker')
    ->addArgument('%login_forbidden_chars%')
    ->addMethodCall('setLogger', [new Reference('logger')])
;

$container->register('recaptcha_service', '\App\Service\RecaptchaService')
    ->addArgument('%recaptcha_privatekey%')
    ->addArgument('%recaptcha_request_method%')
    ->addMethodCall('setLogger', [new Reference('logger')])
;


$container->register('password_strength_checker', '\App\Service\PasswordStrengthChecker')
    ->addArgument('%pwd_policy_config%')
;

$container->register('mail_sender', '\App\Utils\MailSender')
    ->addArgument(new Reference('mailer'))
    ->addMethodCall('setLogger', [new Reference('logger')])
;

$container->register('mail_notification_service', '\App\Service\MailNotificationService')
    ->addArgument(new Reference('mail_sender'))
    ->addArgument('%mail_from%')
    ->addArgument('%mail_from_name%')
    ->addMethodCall('setLogger', [new Reference('logger')])
;

$container->register('sms_notification_service', '\App\Service\SmsNotificationService')
    ->addArgument('%sms_method%')
    ->addArgument(new Reference('mail_sender'))
    ->addArgument('%smsmailto%')
    ->addArgument('%mail_from%')
    ->addArgument('%mail_from_name%')
    ->addArgument('%sms_api_lib%')
    ->addMethodCall('setLogger', [new Reference('logger')])
;

$container->register('ldap_client', '%ldap_client.class%')
    ->addArgument(new Reference('password_encoder'))
    ->addArgument('%ldap_url%')
    ->addArgument('%ldap_use_tls%')
    ->addArgument('%ldap_binddn%')
    ->addArgument('%ldap_bindpw%')
    ->addArgument('%who_change_password%')
    ->addArgument('%enable_ad_mode%')
    ->addArgument('%ldap_filter%')
    ->addArgument('%ldap_base%')
    ->addArgument('%hash%')
    ->addArgument('%ldap_attribute_sms%')
    ->addArgument('%answer_objectclass%')
    ->addArgument('%answer_attribute%')
    ->addArgument('%who_change_ssh_key%')
    ->addArgument('%ldap_attribute_sshkey%')
    ->addArgument('%ldap_attribute_mail%')
    ->addArgument('%ldap_attribute_fullname%')
    ->addArgument('%ad_options%')
    ->addArgument('%enable_samba_mode%')
    ->addArgument('%samba_options%')
    ->addArgument('%shadow_options%')
    ->addArgument('%mail_address_use_ldap%')
    ->addMethodCall('setLogger', [new Reference('logger')])
;

$container->register('password_encoder', '\App\Utils\PasswordEncoder')
    ->addArgument('%hash_options%')
;

$container->register('posthook_executor', '\App\Service\PosthookExecutor')
    ->addArgument('%posthook%')
;

$container->register('token_manager_service', '\App\Service\TokenManagerService')
    ->addArgument(new Reference('session'))
    ->addArgument(new Reference('encryption_service'))
    ->addArgument('%token_lifetime%')
    ->addMethodCall('setLogger', [new Reference('logger')])
;

$container->register('default.controller', '\App\Controller\DefaultController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;

$container->register('change_password.controller', '\App\Controller\ChangePasswordController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;

$container->register('change_ssh_key.controller', '\App\Controller\ChangeSshKeyController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;

$container->register('reset_password_by_question.controller', '\App\Controller\ResetPasswordByQuestionController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;

$container->register('reset_password_by_token.controller', '\App\Controller\ResetPasswordByTokenController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;

$container->register('get_token_by_sms_verification.controller', '\App\Controller\GetTokenBySmsVerificationController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;

$container->register('get_token_by_email_verification.controller', '\App\Controller\GetTokenByEmailVerificationController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;

$container->register('change_security_questions.controller', '\App\Controller\ChangeSecurityQuestionsController')
    ->addMethodCall('setContainer', [new Reference('service_container')])
;


$container->register('twig.controller.exception', '\App\Controller\ExceptionController')
    ->addArgument(new Reference('twig'))
    ->addArgument('%kernel.debug%')
;

$container
    ->register('app.twig_extension', '\App\Twig\AppExtension')
    ->addArgument('%pwd_show_policy%')
    ->addArgument(new Reference('translator'))
    ->setPublic(false)
    ->addTag('twig.extension');

