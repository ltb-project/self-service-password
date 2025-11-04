<?php

#==============================================================================
# Version
#==============================================================================
$version = "1.7.3";

#==============================================================================
# Configuration
#==============================================================================
require_once("../conf/config.inc.php");

#==============================================================================
# Includes
#==============================================================================
require_once("../vendor/autoload.php");
require_once("../lib/functions.inc.php");

#==============================================================================
# VARIABLES
#==============================================================================
# Get source for menu
if (isset($_REQUEST["source"]) and $_REQUEST["source"]) { $source = $_REQUEST["source"]; }
else { $source="unknown"; }

#==============================================================================
# Language
#==============================================================================
# Available languages
$files = glob("../lang/*.php");
$languages = str_replace(".inc.php", "", $files);
$languages = str_replace("../lang/", "", $languages);
$lang = \Ltb\Language::detect_language($lang, $allowed_lang ? array_intersect($languages,$allowed_lang) : $languages);
require_once("../lang/$lang.inc.php");

# Remove default questions
if (!$questions_use_default) {
    unset($messages['questions']['birthday']);
    unset($messages['questions']['color']);
}

if (file_exists("../conf/$lang.inc.php")) {
    require_once("../conf/$lang.inc.php");
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
    # Check ldap_exop_passwd if LDAP exop password modify enabled
    if ( $ldap_use_exop_passwd and ! function_exists('ldap_exop_passwd') ) { $dependency_check_results[] = "phpupgraderequired"; }
    # Check LDAP_CONTROL_PASSWORDPOLICYREQUEST if LDAP ppolicy control enabled
    if ( $ldap_use_ppolicy_control and ! defined('LDAP_CONTROL_PASSWORDPOLICYREQUEST') ) { $dependency_check_results[] = "phpupgraderequired"; }
    # Check PHP Version is at least 7.2.5, when pwnedpasswords is enabled
    if ($use_pwnedpasswords and version_compare(PHP_VERSION, '7.2.5') < 0) { $dependency_check_results[] = "phpupgraderequired"; }
}

# Check PHP mhash presence if Samba mode active
if ( $samba_mode and ! function_exists('hash') and ! function_exists('mhash') ) { $dependency_check_results[] = "nophpmhash"; }

# Check PHP mbstring presence
if ( ! function_exists('mb_internal_encoding') ) { $dependency_check_results[] = "nophpmbstring"; }

# Check PHP xml presence
if ( ! function_exists('utf8_decode') ) { $dependency_check_results[] = "nophpxml"; }

# Check crypt_tokens option
if ( $use_sms and !$crypt_tokens ) { $dependency_check_results[] = "nocrypttokens"; }

# Check keyphrase setting
if ( ( ( $use_tokens and $crypt_tokens ) or $use_sms or $crypt_answers ) and ( empty($keyphrase) or $keyphrase == "secret") ) { $dependency_check_results[] = "nokeyphrase"; }

# Check reset_url setting
if ( $use_tokens and empty($reset_url) ) { $dependency_check_results[] = "noreseturl"; }

#==============================================================================
# Email Config
#==============================================================================
$mailer = new \Ltb\Mail(
                           $mail_priority,
                           $mail_charset,
                           $mail_contenttype,
                           $mail_wordwrap,
                           $mail_sendmailpath,
                           $mail_protocol,
                           $mail_smtp_debug,
                           $mail_debug_format,
                           $mail_smtp_host,
                           $mail_smtp_port,
                           $mail_smtp_secure,
                           $mail_smtp_autotls,
                           $mail_smtp_auth,
                           $mail_smtp_user,
                           $mail_smtp_pass,
                           $mail_smtp_keepalive,
                           $mail_smtp_options,
                           $mail_smtp_timeout
                       );

#==============================================================================
# LDAP Config
#==============================================================================
$ldapInstance = new \Ltb\Ldap(
                                 $ldap_url,
                                 $ldap_starttls,
                                 isset($ldap_binddn) ? $ldap_binddn : null,
                                 isset($ldap_bindpw) ? $ldap_bindpw : null,
                                 isset($ldap_network_timeout) ? $ldap_network_timeout : null,
                                 $ldap_base,
                                 null,
                                 isset($ldap_krb5ccname) ? $ldap_krb5ccname : null,
                                 isset($ldap_page_size) ? $ldap_page_size : 0
                             );

#==============================================================================
# Cache Config
#==============================================================================
$cache_class = '\\Ltb\\Cache\\'.$cache_type.'Cache';
switch($cache_type)
{
    case "File":
        $sspCache = new $cache_class( $cache_namespace,
                                      $cache_default_lifetime,
                                      $cache_directory
                                    );
        break;

    case "Redis":
        $sspCache = new $cache_class( $cache_redis_url,
                                      $cache_namespace,
                                      $cache_default_lifetime
                                    );
        break;

    default:
        error_log("Error: unknown cache type: $cache_type");
        exit(1);
}

#==============================================================================
# Captcha Config
#==============================================================================
require_once(__DIR__ . "/../lib/captcha.inc.php");

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
    "pwd_show_policy"           => $pwd_show_policy,
    "pwd_min_length"            => $pwd_min_length,
    "pwd_max_length"            => $pwd_max_length,
    "pwd_min_lower"             => $pwd_min_lower,
    "pwd_min_upper"             => $pwd_min_upper,
    "pwd_min_digit"             => $pwd_min_digit,
    "pwd_min_special"           => $pwd_min_special,
    "pwd_special_chars"         => $pwd_special_chars,
    "pwd_forbidden_chars"       => $pwd_forbidden_chars,
    "pwd_no_reuse"              => $pwd_no_reuse,
    "pwd_diff_last_min_chars"   => $pwd_diff_last_min_chars,
    "pwd_diff_login"            => $pwd_diff_login,
    "pwd_complexity"            => $pwd_complexity,
    "use_pwnedpasswords"        => $use_pwnedpasswords,
    "pwd_no_special_at_ends"    => $pwd_no_special_at_ends,
    "pwd_forbidden_words"       => $pwd_forbidden_words,
    "pwd_forbidden_ldap_fields" => $pwd_forbidden_ldap_fields,
    "pwd_display_entropy"       => $pwd_display_entropy,
    "pwd_check_entropy"         => $pwd_check_entropy,
    "pwd_min_entropy"           => $pwd_min_entropy
);

if (!isset($pwd_show_policy_pos)) { $pwd_show_policy_pos = "above"; }

# rate-limiting config array
$rrl_config = array(
    "max_per_user" => $max_attempts_per_user,
    "max_per_ip"   => $max_attempts_per_ip,
    "per_time"     => $max_attempts_block_seconds,
    "dbdir"        => isset($ratelimit_dbdir) ? $ratelimit_dbdir : sys_get_temp_dir(),
    "filter_by_ip" => isset($ratelimit_filter_by_ip_jsonfile) ? $ratelimit_filter_by_ip_jsonfile : ""
);

# Preset login with login_hint
if (isset($_REQUEST["login_hint"]) and $_REQUEST["login_hint"]) { $presetLogin = strval($_REQUEST["login_hint"]); }

#==============================================================================
# Route to action
#==============================================================================
$result = "";
$action = "change";
if (isset($default_action)) { $action = $default_action; }
if (isset($_GET["action"]) and $_GET['action']) { $action = $_GET["action"]; }

# Available actions
$available_actions = array();
if ( $use_change ) { array_push( $available_actions, "change"); }
if ( $change_sshkey ) { array_push( $available_actions, "changesshkey"); }
if ( $use_questions ) { array_push( $available_actions, "resetbyquestions", "setquestions"); }
if ( $use_tokens ) { array_push( $available_actions, "resetbytoken", "sendtoken"); }
if ( $use_sms ) { array_push( $available_actions, "resetbytoken", "sendsms"); }
if ( !empty($change_custompwdfield) ) { array_push( $available_actions, "changecustompwdfield"); }
if ( $use_attributes ) { array_push( $available_actions, "setattributes" ); }
array_push( $available_actions, "checkentropy" );

# Ensure requested action is available, or fall back to default
if ( ! in_array($action, $available_actions) ) { $action = $default_action; }

error_reporting(0);
if ($debug) {
    error_reporting(E_ALL);
    # Set debug for LDAP
    ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
}

if (file_exists($action.".php")) { require_once($action.".php"); }

#==============================================================================
# Audit
#==============================================================================
if ($audit_log_file and !preg_match("/empty.*form/", $result)) {
    require_once("../lib/audit.inc.php");
    auditlog($audit_log_file, $userdn, $login, $action, $result);
}

#==============================================================================
# Generate captcha
#==============================================================================
$captcha_html = '';
$captcha_js   = '';
$captcha_css  = '';
if(isset($use_captcha) && $use_captcha == true)
{
    $captcha_html = $captchaInstance->generate_html_captcha($messages, $lang);
    $captcha_js = $captchaInstance->generate_js_captcha();
    $captcha_css = $captchaInstance->generate_css_captcha();
}

#==============================================================================
# Smarty
#==============================================================================
require_once(SMARTY);

$compile_dir = isset($smarty_compile_dir) ? $smarty_compile_dir : "../templates_c/";
$cache_dir = isset($smarty_cache_dir) ? $smarty_cache_dir : "../cache/";
$tpl_dir = isset($custom_tpl_dir) ? array('../'.$custom_tpl_dir, '../templates/') : '../templates/';

$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->setTemplateDir($tpl_dir);
$smarty->setCompileDir($compile_dir);
$smarty->setCacheDir($cache_dir);
$smarty->debugging = $smarty_debug;
if(isset($smarty_debug) && $smarty_debug == true )
{
    $smarty->error_reporting = E_ALL;
}
else
{
    # Do not report smarty stuff unless $smarty_debug == true
    $smarty->error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING;
}

# Assign configuration variables
$smarty->assign('ldap_params',array('ldap_url' => $ldap_url, 'ldap_starttls' => $ldap_starttls, 'ldap_binddn' => $ldap_binddn, 'ldap_bindpw' => $ldap_bindpw));
$smarty->assign('logo',$logo);
$smarty->assign('background_image',$background_image);
$smarty->assign('custom_css',$custom_css);
$smarty->assign('version',$version);
$smarty->assign('display_footer',$display_footer);
$smarty->assign('show_menu', $show_menu);
$smarty->assign('show_help', $show_help);
$smarty->assign('use_questions', $use_questions);
$smarty->assign('use_tokens', $use_tokens);
$smarty->assign('use_sms', $use_sms);
$smarty->assign('change_sshkey', $change_sshkey);
if(empty($change_custompwdfield)) {
    $smarty->assign('change_custompwdfield', false);
} else {
    $change_custompwdfield_labels = array();
    for ($i = 0; $i < count($change_custompwdfield); $i++) {
        $change_custompwdfield_labels[$i] = array();
        if (!isset($change_custompwdfield[$i]['label'])) {
            $change_custompwdfield[$i]['label'] = "Custom Password ".$i;
        } # default generic label
        if (!isset($change_custompwdfield[$i]['msg_changehelpextramessage'])) {
            $change_custompwdfield[$i]['msg_changehelpextramessage'] = "";
        } # default empty help message
        $change_custompwdfield_labels[$i]['label'] = $change_custompwdfield[$i]['label'];
        $change_custompwdfield_labels[$i]['msg_changehelpextramessage'] = $change_custompwdfield[$i]['msg_changehelpextramessage'];
    }
    $smarty->assign('change_custompwdfield', $change_custompwdfield_labels);
}
$smarty->assign('mail_address_use_ldap', $mail_address_use_ldap);
$smarty->assign('sms_use_ldap', $sms_use_ldap);
$smarty->assign('default_action', $default_action);
$smarty->assign('captcha_html', $captcha_html);
$smarty->assign('captcha_js', $captcha_js);
$smarty->assign('captcha_css', $captcha_css);
//$smarty->assign('',);

if (isset($source)) { $smarty->assign('source', $source); }
if (isset($login)) { $smarty->assign('login', $login); }
if (isset($token)) { $smarty->assign('token', $token); }
if (isset($use_captcha)) { $smarty->assign('use_captcha', $use_captcha); }

\Ltb\Ppolicy::smarty_assign_ppolicy($smarty, $pwd_show_policy_pos, $pwd_show_policy, $result, $pwd_policy_config);

if (isset($custompwdindex)) {
    $smarty->assign('custompwdindex', $custompwdindex);
    if (isset($change_custompwdfield[$custompwdindex]['msg_passwordchangedextramessage'])) { $smarty->assign('msg_passwordchangedextramessage', $change_custompwdfield[$custompwdindex]['msg_passwordchangedextramessage']); }
}
if (isset($smsdisplay)) { $smarty->assign('smsdisplay', $smsdisplay); }
// TODO : Make it clean $prehook_return/$posthook_return - START
if (isset($prehook_return)) {
    $smarty->assign('prehook_return', $prehook_return);
} else {
    $smarty->assign('prehook_return', false);
}
if (isset($posthook_return)) {
    $smarty->assign('posthook_return', $posthook_return);
} else {
    $smarty->assign('posthook_return', false);
}
// TODO : Make it clean $prehook_return/$posthook_return - END
if (isset($prehook_output)) { $smarty->assign('prehook_output', $prehook_output); }
if (isset($posthook_output)) { $smarty->assign('posthook_output', $posthook_output); }
if (isset($display_prehook_error)) { $smarty->assign('display_prehook_error', $display_prehook_error); }
if (isset($display_posthook_error)) { $smarty->assign('display_posthook_error', $display_posthook_error); }
if (isset($show_extended_error)) { $smarty->assign('show_extended_error', $show_extended_error); }
if (isset($extended_error_msg)) { $smarty->assign('extended_error_msg', $extended_error_msg); }
//if (isset($var)) { $smarty->assign('var', $var); }

if (isset($use_attributes) && $use_attributes && isset($attribute_mail)) { $smarty->assign('attribute_mail_update', true); }
if (isset($use_attributes) && $use_attributes && isset($attribute_phone)) { $smarty->assign('attribute_phone_update', true); }

# Assign custom template variables
foreach (get_defined_vars() as $key => $value) {
    if (preg_match('/^tpl_(.+)/', $key, $matches)) {
        $smarty->assign($matches[1], $value);
    }
}

# Assign messages
$smarty->assign('lang',$lang);
foreach ($messages as $key => $message) {
    $smarty->assign('msg_'.$key,$message);
}


$smarty->assign('action', $action);

if (isset($question_populate_enable)) { $smarty->assign('question_populate_enable', $question_populate_enable); }
if (isset($questions_count)) { $smarty->assign('questions_count', $questions_count); }
if (isset($question)) { $smarty->assign('question', $question); }

if (isset($login)) { $smarty->assign('login', $login); }
if (isset($formtoken)) { $smarty->assign('formtoken', $formtoken); }
if (isset($usermail)) { $smarty->assign('usermail', $usermail); }
if (isset($displayname[0])) { $smarty->assign('displayname', $displayname[0]); }
if (isset($encrypted_sms_login)) { $smarty->assign('encrypted_sms_login', $encrypted_sms_login); }
if (isset($formtoken)) { $smarty->assign('formtoken', $formtoken); }

# Set error message, criticity and fa_class

if ($result) {
    $smarty->assign('error', $messages[$result]);
    // TODO : Make it clean $error_sms - START
    if ($action == 'sendsms') {
        if (isset($result) && ($result == 'smscrypttokensrequired' || $result == 'smsuserfound' || $result == 'smssent' || $result == 'smssent_ifexists' || $result == 'tokenattempts')) {
            $smarty->assign('error_sms', $result);
        } else {
            $smarty->assign('error_sms', false);
        }
    }
    // TODO : Make it clean $error_sms - END
    $smarty->assign('result_criticity', get_criticity($result));
    $smarty->assign('result_fa_class', get_fa_class($result));
} else {
    $smarty->assign('error', "");
}
$smarty->assign('result', $result);

# Set dependency check message, criticity and fa_class

$dependency_errors = array();
foreach ($dependency_check_results as $result) {
    $dependency_errors[$result] = array( 'error' => $messages[$result], 'criticity' => get_criticity($result), 'fa_class' => get_fa_class($result) );
}
$smarty->assign('dependency_errors', $dependency_errors);

$smarty->display('index.tpl');
