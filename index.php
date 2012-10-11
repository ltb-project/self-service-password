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

#==============================================================================
# Includes
#==============================================================================
require_once("conf/config.inc.php");
require_once("lib/functions.inc.php");
if ($use_recaptcha) {
    require_once("lib/recaptchalib.php");
}
require_once("lib/detectbrowserlanguage.php");

#==============================================================================
# Language
#==============================================================================
# Available languages
$languages = array('en', 'de', 'es', 'fr', 'nl', 'pt-BR', 'ca', 'pl', 'ru', 'it');
$lang = detectLanguage($lang, $languages);
require_once("lang/$lang.inc.php");

#==============================================================================
# Error reporting
#==============================================================================
error_reporting(0);
if($debug) error_reporting(E_ALL);

#==============================================================================
# PHP configuration tuning
#==============================================================================
# Disable output_buffering, to not send cookie information after headers
ini_set('output_buffering', '0');

#==============================================================================
# PHP modules
#==============================================================================
# Init result variable
$result = "";

# Check PHP-LDAP presence
if ( ! function_exists('ldap_connect') ) { $result="nophpldap"; }

# Check PHP mhash presence if Samba mode active
if ( $samba_mode and ! function_exists('hash') and  ! function_exists('mhash') ) { $result="nophpmhash"; }

# Check PHP mycrypt presence if token are used
if ( $crypt_tokens and ! function_exists('mcrypt_module_open') ) { $result="nophpmcrypt"; }

#==============================================================================
# Action
#==============================================================================
if (!isset($default_action)) { $default_action = "change"; }
if (isset($_GET["action"]) and $_GET["action"]) { $action = $_GET["action"]; }
else { $action = $default_action; }

# Available actions
$available_actions = array( "change" );
if ( $use_questions ) { array_push( $available_actions, "resetbyquestions", "setquestions"); }
if ( $use_tokens ) { array_push( $available_actions, "resetbytoken", "sendtoken"); }
if ( $use_sms ) { array_push( $available_actions, "resetbytoken", "sendsms"); }

# Ensure requested action is available, or fall back to default
if ( ! in_array($action, $available_actions) ) { $action = "change"; }

#==============================================================================
# Other default values
#==============================================================================
if (!isset($ldap_login_attribute)) { $ldap_login_attribute = "uid"; }
if (!isset($ldap_fullname_attribute)) { $ldap_fullname_attribute = "cn"; }

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
    "pwd_complexity"          => $pwd_complexity
);

# Force reCaptcha SSL if HTTPS
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') { $recaptcha_ssl = true; }

if (!isset($pwd_show_policy_pos)) { $pwd_show_policy_pos = "above"; }

#==============================================================================
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php echo $messages["title"]; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="cache-control" content="no-cache" />
    <link rel="stylesheet" type="text/css" href="style/styles.css" />
    <link href="style/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="style/favicon.ico" rel="shortcut icon" />
</head>
<body>

<div id="content">
<h1><?php echo $messages["title"]; ?></h1>
<a href="index.php" alt="Home">
<img src="<?php echo $logo; ?>" alt="Logo" />
</a>

<?php if ( $result ) { ?>
<div class="result <?php echo get_criticity($result) ?>">
<h2 class="<?php echo get_criticity($result) ?>"><?php echo $messages[$result]; ?></h2>
</div>
<?php } else {
    include("pages/$action.php");
} ?>

</div>

</body>
</html>
