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

ob_start();

#==============================================================================
# Includes
#==============================================================================
require_once("conf/config.inc.php");
require_once("lib/vendor/defuse-crypto.phar");
require_once("lib/vendor/Psr/Container/ContainerInterface.php");
require_once("lib/vendor/Psr/Container/ContainerExceptionInterface.php");
require_once("lib/vendor/Psr/Container/NotFoundExceptionInterface.php");
require_once("lib/vendor/pimple.phar");
require_once("lib/functions.inc.php");
if ($use_recaptcha) {
    require_once("lib/vendor/autoload.php");
}

require_once('phar://'. __DIR__ . '/lib/vendor/twig.phar/Twig/Autoloader.php');
Twig_Autoloader::register();

require_once("lib/detectbrowserlanguage.php");
require_once("lib/vendor/PHPMailer/PHPMailerAutoload.php");

$container = require_once ("lib/container.inc.php");

#==============================================================================
# Error reporting
#==============================================================================
error_reporting(0);
if($debug) error_reporting(E_ALL);

#==============================================================================
# Language
#==============================================================================
# Available languages
$languages = array();
if ($handle = opendir('lang')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." ) {
            $entry_lang = str_replace(".inc.php", "", $entry);
            # Only add language to possibilities if it is the default language or part of the allowed languages
            # empty $allowed_lang <=> all languages are allowed
            if ($entry_lang == $lang || empty($allowed_lang) || in_array($entry_lang, $allowed_lang) ) {
                array_push($languages, $entry_lang);
            }
        }
    }
    closedir($handle);
}
$lang = detectLanguage($lang, $languages);
require_once("lang/$lang.inc.php");
if (file_exists("conf/$lang.inc.php")) {
    require_once("conf/$lang.inc.php");
}

#==============================================================================
# PHP modules
#==============================================================================
# Init dependency check results variable
$dependency_check_results = array();

# Check PHP-LDAP presence
if ( ! function_exists('ldap_connect') ) { $dependency_check_results[] = "nophpldap"; }
else {
    # Check ldap_modify_batch presence if AD mode and password change as user
    if ( $ad_mode and $who_change_password === "user" and ! function_exists('ldap_modify_batch') ) { $dependency_check_results[] = "phpupgraderequired"; }
}

# Check PHP mhash presence if Samba mode active
if ( $samba_mode and ! function_exists('hash') and ! function_exists('mhash') ) { $dependency_check_results[] = "nophpmhash"; }

# Check PHP mbstring presence
if ( ! function_exists('mb_internal_encoding') ) { $dependency_check_results[] = "nophpmbstring"; }

# Check PHP xml presence
if ( ! function_exists('utf8_decode') ) { $dependency_check_results[] = "nophpxml"; }

# Check keyphrase setting
if ( ( ( $use_tokens and $crypt_tokens ) or $use_sms ) and ( empty($keyphrase) or $keyphrase == "secret") ) { $dependency_check_results[] = "nokeyphrase"; }
#==============================================================================
# Request
#==============================================================================
class ParameterBag {
    private $parameters;

    public function __construct(array $parameters = array())
    {
        $this->parameters = $parameters;
    }

    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->parameters);
    }
}
class Request {
    public $query;
    public $request;

    public function __construct($query, $request) {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
    }

    public function get($key, $default = null)
    {
        if ($this !== $result = $this->query->get($key, $this)) {
            return $result;
        }
        if ($this !== $result = $this->request->get($key, $this)) {
            return $result;
        }
        return $default;
    }
}

$request = new Request($_GET, $_POST);

class Controller {
    /** @var Twig_Environment */
    private $twig;

    /** @var array */
    protected $config;

    protected $container;

    public function __construct($config, $container) {
        $this->twig = $container['twig'];
        $this->config = $config;
        $this->container = $container;
    }

    protected function render($template, $vars) {
        $vars1 = array (
            'lang' => $this->config['lang'],
            'background_image' => $this->config['background_image'],
            'show_menu' => $this->config['show_menu'],
            'logo' => $this->config['logo'],
            'dependency_check_results' => $this->config['dependency_check_results'],
            'use_questions' => $this->config['use_questions'],
            'use_tokens' => $this->config['use_tokens'],
            'use_sms' => $this->config['use_sms'],
            'change_sshkey' => $this->config['change_sshkey'],
            'action' => $this->config['action'],
            'source' => $this->config['source'],
        );

        return $this->twig->render($template, $vars1 + $vars);
    }

    protected function get($id) {
        return $this->container[$id];
    }
}

#==============================================================================
# Action
#==============================================================================
if (!isset($default_action)) { $default_action = "change"; }

$action = $request->query->get("action", $default_action);

# Available actions
$available_actions = array();
if ( $use_change ) { array_push( $available_actions, "change"); }
if ( $change_sshkey ) { array_push( $available_actions, "changesshkey"); }
if ( $use_questions ) { array_push( $available_actions, "resetbyquestions", "setquestions"); }
if ( $use_tokens ) { array_push( $available_actions, "resetbytoken", "sendtoken"); }
if ( $use_sms ) { array_push( $available_actions, "resetbytoken", "sendsms"); }

# Ensure requested action is available, or fall back to default
if ( ! in_array($action, $available_actions) ) { $action = $default_action; }

# Get source for menu
$source = $request->get("source", false);

#==============================================================================
# Other default values
#==============================================================================
if (!isset($ldap_login_attribute)) { $ldap_login_attribute = "uid"; }
if (!isset($ldap_fullname_attribute)) { $ldap_fullname_attribute = "cn"; }
if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars = ""; }
if (!isset($hash_options)) { $hash_options = array(); }
if (!isset($samba_options)) { $samba_options = array(); }
if (!isset($ldap_starttls)) { $ldap_starttls = false; }

# Password policy array
$pwd_policy_config = array(
    "pwd_show_policy"         => $pwd_show_policy,
    "pwd_min_length"          => $pwd_min_length,
    "pwd_max_length"          => $pwd_max_length,
    "pwd_min_lower"           => $pwd_min_lower,
    "pwd_min_upper"           => $pwd_min_upper,
    "pwd_min_digit"           => $pwd_min_digit,
    "pwd_min_special"         => $pwd_min_special,
    "pwd_special_chars"       => $pwd_special_chars,
    "pwd_forbidden_chars"     => $pwd_forbidden_chars,
    "pwd_no_reuse"            => $pwd_no_reuse,
    "pwd_diff_login"          => $pwd_diff_login,
    "pwd_complexity"          => $pwd_complexity
);

if (!isset($pwd_show_policy_pos)) { $pwd_show_policy_pos = "above"; }

$config = get_defined_vars();

$container['config'] = $config;

# Override container for fun and profit
@include "conf/container.inc.php";

require_once __DIR__ . "/pages/$action.php";

$controller = $container[$action . '.controller'];
echo $controller->indexAction($request);

ob_end_flush();
