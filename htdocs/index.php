<?php

#==============================================================================
# Version
#==============================================================================
$version = "1.4";

#==============================================================================
# Configuration
#==============================================================================
require_once("../conf/config.inc.php");

#==============================================================================
# Includes
#==============================================================================
require_once("../lib/vendor/defuse-crypto.phar");
require_once("../lib/functions.inc.php");
if ($use_recaptcha) {
    require_once("../lib/vendor/autoload.php");
}
if ($use_pwnedpasswords) {
    require_once("lib/vendor/ron-maxweb/pwned-passwords/src/PwnedPasswords/PwnedPasswords.php");
}

#==============================================================================
# VARIABLES
#==============================================================================
# Get source for menu
if (isset($_REQUEST["source"]) and $_REQUEST["source"]) { $source = $_REQUEST["source"]; }
else { $source="unknown"; }

#==============================================================================
# Language
#==============================================================================
require_once("../lib/detectbrowserlanguage.php");
# Available languages
$languages = array();
if ($handle = opendir('../lang')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
             array_push($languages, str_replace(".inc.php", "", $entry));
        }
    }
    closedir($handle);
}
$lang = detectLanguage($lang, $languages);
require_once("../lang/$lang.inc.php");
if (file_exists("../conf/$lang.inc.php")) {
    require_once("../conf/$lang.inc.php");
}

#==============================================================================
# Email Config
#==============================================================================
require_once("../lib/vendor/PHPMailer/PHPMailerAutoload.php");
$mailer = new PHPMailer;
$mailer->Priority      = $mail_priority;
$mailer->CharSet       = $mail_charset;
$mailer->ContentType   = $mail_contenttype;
$mailer->WordWrap      = $mail_wordwrap;
$mailer->Sendmail      = $mail_sendmailpath;
$mailer->Mailer        = $mail_protocol;
$mailer->SMTPDebug     = $mail_smtp_debug;
$mailer->Debugoutput   = $mail_debug_format;
$mailer->Host          = $mail_smtp_host;
$mailer->Port          = $mail_smtp_port;
$mailer->SMTPSecure    = $mail_smtp_secure;
$mailer->SMTPAutoTLS   = $mail_smtp_autotls;
$mailer->SMTPAuth      = $mail_smtp_auth;
$mailer->Username      = $mail_smtp_user;
$mailer->Password      = $mail_smtp_pass;
$mailer->SMTPKeepAlive = $mail_smtp_keepalive;
$mailer->SMTPOptions   = $mail_smtp_options;
$mailer->Timeout       = $mail_smtp_timeout;
$mailer->LE            = $mail_newline;

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
    "pwd_complexity"          => $pwd_complexity,
    "use_pwnedpasswords"      => $use_pwnedpasswords,
    "pwd_no_special_at_ends"  => $pwd_no_special_at_ends
);

if (!isset($pwd_show_policy_pos)) { $pwd_show_policy_pos = "above"; }

#==============================================================================
# Route to action
#==============================================================================
$result = "";
$action = "change";
if (isset($default_action)) { $action = $default_action; }
if (isset($_GET["action"]) and $_GET['action']) { $action = $_GET["action"]; }
#if ($action === "change" and !$use_change) { $action = ""}
#if ($action === "sendtoken" and !$use_tokens) {}
if (file_exists($action.".php")) { require_once($action.".php"); }

#==============================================================================
# Smarty
#==============================================================================
require_once(SMARTY);

$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->setTemplateDir('../templates/');
$smarty->setCompileDir('../templates_c/');
$smarty->setCacheDir('../cache/');
$smarty->debugging = $debug;

# Set debug for LDAP
if ($debug) {
    ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
}

# Assign configuration variables
$smarty->assign('ldap_params',array('ldap_url' => $ldap_url, 'ldap_starttls' => $ldap_starttls, 'ldap_binddn' => $ldap_binddn, 'ldap_bindpw' => $ldap_bindpw));
$smarty->assign('logo',$logo);
$smarty->assign('background_image',$background_image);
$smarty->assign('custom_css',$custom_css);
$smarty->assign('version',$version);
$smarty->assign('display_footer',$display_footer);
$smarty->assign('logo', $logo);
$smarty->assign('show_menu', $show_menu);
$smarty->assign('show_help', $show_help);
$smarty->assign('use_questions', $use_questions);
$smarty->assign('use_tokens', $use_tokens);
$smarty->assign('use_sms', $use_sms);
$smarty->assign('change_sshkey', $change_sshkey);
$smarty->assign('mail_address_use_ldap', $mail_address_use_ldap);
$smarty->assign('default_action', $default_action);
$smarty->assign('sms_partially_hide_number', $sms_partially_hide_number);
//$smarty->assign('',);

if (isset($source)) { $smarty->assign('source', $source); }
if (isset($login)) { $smarty->assign('login', $login); }
if (isset($recatpcha_publickey)) { $smarty->assign('recaptcha_publickey', $recaptcha_publickey); }
if (isset($recaptcha_theme)) { $smarty->assign('recaptcha_theme', $recaptcha_theme);  }
if (isset($recaptcha_type)) { $smarty->assign('recaptcha_type', $recaptcha_type); }
if (isset($recaptcha_size)) { $smarty->assign('recaptcha_size', $recaptcha_size); }
if (isset($token)) { $smarty->assign('token', $token); }
if (isset($use_recaptcha)) { $smarty->assign('use_recaptcha', $use_recaptcha); }
// TODO : Make it clean function show_policy - START
if (isset($pwd_show_policy_pos)) { 
    $smarty->assign('pwd_show_policy_pos', $pwd_show_policy_pos); 
    $smarty->assign('pwd_show_policy', $pwd_show_policy); 
    $smarty->assign('pwd_show_policy_onerror', true); 
    if ( $pwd_show_policy === "onerror" ) {
        if ( !preg_match( "/tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|notcomplex|sameaslogin|pwned|specialatends/" , $result) ) {
            $smarty->assign('pwd_show_policy_onerror', false); 
        } else  {
            $smarty->assign('pwd_show_policy_onerror', true); 
        }
    }
    if (isset($pwd_min_length)) { $smarty->assign('pwd_min_length', $pwd_min_length); }
    if (isset($pwd_max_length)) { $smarty->assign('pwd_max_length', $pwd_max_length); }
    if (isset($pwd_min_lower)) { $smarty->assign('pwd_min_lower', $pwd_min_lower); }
    if (isset($pwd_min_upper)) { $smarty->assign('pwd_min_upper', $pwd_min_upper); }
    if (isset($pwd_min_digit)) { $smarty->assign('pwd_min_digit', $pwd_min_digit); }
    if (isset($pwd_min_special)) { $smarty->assign('pwd_min_special', $pwd_min_special); }
    if (isset($pwd_complexity)) { $smarty->assign('pwd_complexity', $pwd_complexity); }
    if (isset($pwd_forbidden_chars)) { $smarty->assign('pwd_forbidden_chars', $pwd_forbidden_chars); }
    if (isset($pwd_no_reuse)) { $smarty->assign('pwd_no_reuse', $pwd_no_reuse); }
    if (isset($pwd_diff_login)) { $smarty->assign('pwd_diff_login', $pwd_diff_login); }
    if (isset($use_pwnedpasswords)) { $smarty->assign('use_pwnedpasswords', $use_pwnedpasswords); }
    if (isset($pwd_no_special_at_ends)) { $smarty->assign('pwd_no_special_at_ends', $pwd_no_special_at_ends); }
}
// TODO : Make it clean function show_policy - END
if (isset($sms)) { $smarty->assign('sms', $sms); }
// TODO : Make it clean $posthook_return - START
if (isset($posthook_return)) {
    $smarty->assign('posthook_return', $posthook_return);
} else {
    $smarty->assign('posthook_return', false);
}
// TODO : Make it clean $posthook_return - END
if (isset($posthook_output)) { $smarty->assign('posthook_output', $posthook_output); }
if (isset($display_posthook_error)) { $smarty->assign('display_posthook_error', $display_posthook_error); }
if (isset($show_extended_error)) { $smarty->assign('show_extended_error', $show_extended_error); }
if (isset($extended_error_msg)) { $smarty->assign('extended_error_msg', $extended_error_msg); }
//if (isset($var)) { $smarty->assign('var', $var); }

# Assign messages
$smarty->assign('lang',$lang);
foreach ($messages as $key => $message) {
    $smarty->assign('msg_'.$key,$message);
}

$smarty->assign('action', $action);

if (isset($login)) { $smarty->assign('login', $login); }
if (isset($displayname[0])) { $smarty->assign('displayname', $displayname[0]); }
if (isset($encrypted_sms_login)) { $smarty->assign('encrypted_sms_login', $encrypted_sms_login); }

if ($result) {
    $smarty->assign('error', $messages[$result]);
    // TODO : Make it clean $error_sms - START
    if ($action == 'sendsms') {
        if (isset($result) && ($result == 'smscrypttokensrequired' || $result == 'smsuserfound' || $result == 'smssent' || $result == 'tokenattempts')) {
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

if ( isset($obscure_failure_messages) && in_array($result, $obscure_failure_messages) ) { $result = "badcredentials"; }

$smarty->assign('result', $result);
$smarty->display('index.tpl');
