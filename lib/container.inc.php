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

use Pimple\Container;

$container = new Container();

$container['username_validity_checker'] = function ($c) {
    return new UsernameValidityChecker($c['config']['login_forbidden_chars']);
};

$container['recaptcha_service'] = function ($c) {
    return new RecaptchaService($c['config']['recaptcha_privatekey'], $c['config']['recaptcha_request_method']);
};

$container['password_strength_checker'] = function ($c) {
    return new PasswordStrengthChecker($c['config']['pwd_policy_config']);
};

$container['mailer'] = function ($c) {
    $mailer = new PHPMailer;
    $mailer->Priority      = $c['config']['mail_priority'];
    $mailer->CharSet       = $c['config']['mail_charset'];
    $mailer->ContentType   = $c['config']['mail_contenttype'];
    $mailer->WordWrap      = $c['config']['mail_wordwrap'];
    $mailer->Sendmail      = $c['config']['mail_sendmailpath'];
    $mailer->Mailer        = $c['config']['mail_protocol'];
    $mailer->SMTPDebug     = $c['config']['mail_smtp_debug'];
    $mailer->Debugoutput   = $c['config']['mail_debug_format'];
    $mailer->Host          = $c['config']['mail_smtp_host'];
    $mailer->Port          = $c['config']['mail_smtp_port'];
    $mailer->SMTPSecure    = $c['config']['mail_smtp_secure'];
    $mailer->SMTPAuth      = $c['config']['mail_smtp_auth'];
    $mailer->Username      = $c['config']['mail_smtp_user'];
    $mailer->Password      = $c['config']['mail_smtp_pass'];
    $mailer->SMTPKeepAlive = $c['config']['mail_smtp_keepalive'];
    $mailer->Timeout       = $c['config']['$mail_smtp_timeout'];
    $mailer->LE            = $c['config']['$mail_newline'];
    return $mailer;
};


$container['mail_notification_service'] = function ($c) {
    return new MailNotificationService($c['mailer'], $c['config']['mail_from'], $c['config']['mail_from_name']);
};

$container['sms_notification_service'] = function ($c) {
    return new SmsNotificationService($c['config']['sms_method'], $c['mailer'], $c['config']['smsmailto'], $c['config']['mail_from'], $c['config']['mail_from_name'], $c['config']['sms_api_lib'], $c['config']['messages']);
};


$container['ldap_client'] = function ($c) {
    return new LdapClient($c['config']);
};

$container['posthook_executor'] = function ($c) {
    return new PosthookExecutor($c['config']['posthook']);
};

$container['twig'] = function ($c) {
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
    $twig = new Twig_Environment($loader, array(
        //'cache' => __DIR__ .'/templates_c',
    ));

    function trans($id) {
        global $messages;

        return $messages[$id];
    }

    $twig->addFilter('fa_class', new Twig_SimpleFilter('fa_class', 'get_fa_class'));
    $twig->addFilter('criticality', new Twig_SimpleFilter('criticality', 'get_criticity'));
    $twig->addFilter('trans', new Twig_SimpleFilter('trans', 'trans'));
    $twig->addFunction('show_policy', new Twig_SimpleFunction('show_policy', 'show_policy'));

    return $twig;
};

$container['change.controller']  = function ($c) {
    return new ChangeController($c['config'], $c);
};

$container['changesshkey.controller']  = function ($c) {
    return new ChangeSshKeyController($c['config'], $c);
};

$container['resetbyquestions.controller']  = function ($c) {
    return new ResetByQuestionsController($c['config'], $c);
};

$container['resetbytoken.controller']  = function ($c) {
    return new ResetByTokenController($c['config'], $c);
};

$container['sendsms.controller']  = function ($c) {
    return new SendSmsController($c['config'], $c);
};

$container['sendtoken.controller']  = function ($c) {
    return new SendTokenController($c['config'], $c);
};

$container['setquestions.controller']  = function ($c) {
    return new SetQuestionsController($c['config'], $c);
};

return $container;