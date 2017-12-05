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

use App\Controller as Controller;
use App\Service as Service;
use App\Utils as Utils;

use Pimple\Container;

$container = new Container();

$container['logger'] = function () {
    return new \App\Framework\DefaultLogger();
};

$container['event_dispatcher'] = function () {
    $eventDispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
    return $eventDispatcher;
};

$container['reset_url_generator'] = function ($c) {
    return new Utils\ResetUrlGenerator($c['config']['reset_url']);
};

$container['encryption_service'] = function ($c) {
    return new Service\EncryptionService($c['config']['keyphrase']);
};

$container['sms_token_generator'] = function ($c) {
    return new Utils\SmsTokenGenerator($c['config']['sms_token_length']);
};

$container['username_validity_checker'] = function ($c) {
    return new Service\UsernameValidityChecker($c['config']['login_forbidden_chars']);
};

$container['recaptcha_service'] = function ($c) {
    return new Service\RecaptchaService($c['config']['recaptcha_privatekey'], $c['config']['recaptcha_request_method']);
};

$container['password_strength_checker'] = function ($c) {
    return new Service\PasswordStrengthChecker($c['config']['pwd_policy_config']);
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
    $mailer->Timeout       = $c['config']['mail_smtp_timeout'];
    $mailer->LE            = $c['config']['mail_newline'];
    return $mailer;
};

$container['mail_sender'] = function ($c) {
    return new Utils\MailSender($c['mailer']);
};

$container['mail_notification_service'] = function ($c) {
    return new Service\MailNotificationService($c['mailer_sender'], $c['config']['mail_from'], $c['config']['mail_from_name']);
};

$container['sms_notification_service'] = function ($c) {
    return new Service\SmsNotificationService($c['config']['sms_method'], $c['mailer_sender'], $c['config']['smsmailto'], $c['config']['mail_from'], $c['config']['mail_from_name'], $c['config']['sms_api_lib'], $c['config']['messages']);
};


$container['ldap_client'] = function ($c) {
    return new Service\LdapClient($c['config'], $c['password_encoder']);
};

$container['password_encoder'] = function ($c) {
    return new Utils\PasswordEncoder($c['config']['hash_options']);
};

$container['posthook_executor'] = function ($c) {
    return new Service\PosthookExecutor($c['config']['posthook']);
};

$container['token_manager_service'] = function ($c) {
    return new Service\TokenManagerService($c['config']['crypt_tokens'], $c['encryption_service'], isset($c['config']['token_lifetime']) ? $c['config']['token_lifetime'] : null);
};


$container['twig'] = function ($c) {
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
    $twig = new Twig_Environment($loader, [
        //'cache' => __DIR__ .'/../var/cache/templates_c',
    ]);

    # Get message criticity
    $get_criticity = function ( $msg ) {

        if ( preg_match( "/nophpldap|phpupgraderequired|nophpmhash|nokeyphrase|ldaperror|nomatch|badcredentials|passworderror|tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|answermoderror|answernomatch|mailnomatch|tokennotsent|tokennotvalid|notcomplex|smsnonumber|smscrypttokensrequired|nophpmbstring|nophpxml|smsnotsent|sameaslogin|sshkeyerror/" , $msg ) ) {
            return "danger";
        }

        if ( preg_match( "/(login|oldpassword|newpassword|confirmpassword|answer|question|password|mail|token)required|badcaptcha|tokenattempts/" , $msg ) ) {
            return "warning";
        }

        return "success";
    };

    # Get FontAwesome class icon
    $get_fa_class = function ($msg) use ($get_criticity) {
        $criticity = $get_criticity( $msg );

        if ( $criticity === "danger" ) { return "fa-exclamation-circle"; }
        if ( $criticity === "warning" ) { return "fa-exclamation-triangle"; }
        if ( $criticity === "success" ) { return "fa-check-square"; }
    };

    $is_error = function ( $msg ) {
        return preg_match( "/tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|notcomplex|sameaslogin/" , $msg);
    };

    $trans = function ($id) use ($c) {
        return $c['config']['messages'][$id];
    };

    $show_policy_for = function ($result) use ($is_error, $c) {
        $config = $c['config'];
        return isset($config['pwd_show_policy']) and ( $config['pwd_show_policy'] === "always" or ( $config['pwd_show_policy'] === "onerror" and $is_error($result)));
    };

    $twig->addFilter('fa_class', new Twig_SimpleFilter('fa_class', $get_fa_class));
    $twig->addFilter('criticality', new Twig_SimpleFilter('criticality', $get_criticity));
    $twig->addFilter('trans', new Twig_SimpleFilter('trans', $trans));
    $twig->addFunction('show_policy_for', new Twig_SimpleFunction('show_policy_for', $show_policy_for));

    $conf = $c['config'];

    $twig->addGlobal('recaptcha_publickey', $conf['recaptcha_publickey']);
    $twig->addGlobal('recaptcha_theme', $conf['recaptcha_theme']);
    $twig->addGlobal('recaptcha_type', $conf['recaptcha_type']);
    $twig->addGlobal('recaptcha_size', $conf['recaptcha_size']);
    $twig->addGlobal('show_help', $conf['show_help']);
    $twig->addGlobal('pwd_policy_config', $conf['pwd_policy_config']);
    $twig->addGlobal('pwd_show_policy_pos', $conf['pwd_show_policy_pos']);
    $twig->addGlobal('has_password_changed_extra_message', isset($conf['messages']['passwordchangedextramessage']));
    $twig->addGlobal('has_change_help_extra_message', isset($conf['messages']['changehelpextramessage']));
    $twig->addGlobal('show_change_help_reset', !$conf['show_menu'] and ( $conf['use_questions'] or $conf['use_tokens'] or $conf['use_sms'] or $conf['change_sshkey'] ));
    $twig->addGlobal('mail_address_use_ldap', $conf['mail_address_use_ldap']);

    return $twig;
};

$container['change.controller']  = function ($c) {
    return new Controller\ChangeController($c['config'], $c);
};

$container['changesshkey.controller']  = function ($c) {
    return new Controller\ChangeSshKeyController($c['config'], $c);
};

$container['resetbyquestions.controller']  = function ($c) {
    return new Controller\ResetByQuestionsController($c['config'], $c);
};

$container['resetbytoken.controller']  = function ($c) {
    return new Controller\ResetByTokenController($c['config'], $c);
};

$container['sendsms.controller']  = function ($c) {
    return new Controller\SendSmsController($c['config'], $c);
};

$container['sendtoken.controller']  = function ($c) {
    return new Controller\SendTokenController($c['config'], $c);
};

$container['setquestions.controller']  = function ($c) {
    return new Controller\SetQuestionsController($c['config'], $c);
};

return $container;