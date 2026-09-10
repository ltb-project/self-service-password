<?php

#==============================================================================
# Configuration
#==============================================================================
require_once("../../conf/config.inc.php");

#==============================================================================
# Includes
#==============================================================================
require_once(__DIR__."/../../lib/functions.inc.php");
require_once(__DIR__."/../../vendor/autoload.php");

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
$files = glob("../../lang/*.php");
$languages = str_replace(".inc.php", "", $files);
$languages = str_replace("../lang/", "", $languages);
$lang = \Ltb\Language::detect_language($lang, $allowed_lang ? array_intersect($languages,$allowed_lang) : $languages);
require_once("../../lang/$lang.inc.php");

if (file_exists("../../conf/$lang.inc.php")) {
    require_once("../../conf/$lang.inc.php");
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
    if ( $ldap_type === "activedirectory" and $who_change_password === "user" and ! function_exists('ldap_modify_batch') ) { $dependency_check_results[] = "phpupgraderequired"; }
    # Check ldap_exop_passwd if LDAP exop password modify enabled
    if ( $ldap_use_exop_passwd and ! function_exists('ldap_exop_passwd') ) { $dependency_check_results[] = "phpupgraderequired"; }
}

# Check PHP mhash presence if Samba mode active
if ( $samba_mode and ! function_exists('hash') and ! function_exists('mhash') ) { $dependency_check_results[] = "nophpmhash"; }

# Check PHP mbstring presence
if ( ! function_exists('mb_internal_encoding') ) { $dependency_check_results[] = "nophpmbstring"; }

# Check PHP xml presence
if ( ! function_exists('utf8_decode') ) { $dependency_check_results[] = "nophpxml"; }

# Check keyphrase setting
if ( ( ( $use_tokens and $crypt_tokens ) or $use_sms or $crypt_answers ) and ( empty($keyphrase) or $keyphrase == "secret") ) { $dependency_check_results[] = "nokeyphrase"; }


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

# Embedded images
foreach ($mail_embedded_images as $img_key => $img_path) {
    $mailer->AddEmbeddedImage("../../htdocs/".$img_path, $img_key);
}

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
                                 isset($ldap_krb5ccname) ? $ldap_krb5ccname : null
                             );

#==============================================================================
# Directory instance
#==============================================================================
$directory;

# Load specific directory settings
switch($ldap_type) {
  case "openldap":
    $directory = new \Ltb\Directory\OpenLDAP();
  break;
  case "activedirectory":
    $directory = new \Ltb\Directory\ActiveDirectory();
  break;
}

$dnAttribute = $directory->getDnAttribute();

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

if (!$use_restapi) {
    die("Rest API disabled");
}

#==============================================================================
# Smarty
#==============================================================================
require_once(SMARTY);

$compile_dir = isset($smarty_compile_dir) ? $smarty_compile_dir : "../../templates_c/";
$cache_dir = isset($smarty_cache_dir) ? $smarty_cache_dir : "../../cache/";
$tpl_dir = isset($custom_tpl_dir) ? array('../../'.$custom_tpl_dir, '../../templates/') : '../../templates/';

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

