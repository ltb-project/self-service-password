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
require_once("config.inc.php");
require_once("lang.inc.php");
require_once("functions.inc.php");

#==============================================================================
# Error reporting
#==============================================================================
error_reporting(0);
if($debug) error_reporting(E_ALL);

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = "";
$confirmpassword = "";
$newpassword = "";
$oldpassword = "";

if (isset($_POST["confirmpassword"]) and $_POST["confirmpassword"]) { $confirmpassword = $_POST["confirmpassword"]; }
 else { $result = "confirmpasswordrequired"; }
if (isset($_POST["newpassword"]) and $_POST["newpassword"]) { $newpassword = $_POST["newpassword"]; }
 else { $result = "newpasswordrequired"; }
if (isset($_POST["oldpassword"]) and $_POST["oldpassword"]) { $oldpassword = $_POST["oldpassword"]; }
 else { $result = "oldpasswordrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = $_REQUEST["login"]; }
 else { $result = "loginrequired"; }

# Strip slashes added by PHP
$login = stripslashes_if_gpc_magic_quotes($login);
$oldpassword = stripslashes_if_gpc_magic_quotes($oldpassword);
$newpassword = stripslashes_if_gpc_magic_quotes($newpassword);
$confirmpassword = stripslashes_if_gpc_magic_quotes($confirmpassword);

# Match new and confirm password
if ( $newpassword != $confirmpassword ) { $result="nomatch"; }

# Check PHP-LDAP presence
if ( ! function_exists('ldap_connect') ) { $result="nophpldap"; }

# Check PHP mhash presence if Samba mode active
if ( $samba_mode and ! function_exists('mhash') ) { $result="nophpmhash"; }

#==============================================================================
# Check password strenght
#==============================================================================
if ( $result === "" ) {

    $length = strlen($newpassword);
    preg_match_all("/[a-z]/", $newpassword, $lower_res);
    $lower = count( $lower_res[0] );
    preg_match_all("/[A-Z]/", $newpassword, $upper_res);
    $upper = count( $upper_res[0] );
    preg_match_all("/[0-9]/", $newpassword, $digit_res);
    $digit = count( $digit_res[0] );

    # Minimal lenght
    if ( $pwd_min_length and $length < $pwd_min_length ) { $result="tooshort"; }

    # Maximal lenght
    if ( $pwd_max_length and $length > $pwd_max_length ) { $result="toobig"; }

    # Minimal lower chars
    if ( $pwd_min_lower and $lower < $pwd_min_lower ) { $result="minlower"; }

    # Minimal upper chars
    if ( $pwd_min_upper and $upper < $pwd_min_upper ) { $result="minupper"; }

    # Minimal digit chars
    if ( $pwd_min_digit and $digit < $pwd_min_digit ) { $result="mindigit"; }

}

#==============================================================================
# Change password
#==============================================================================
if ( $result === "" ) {

    # Connect to LDAP
    $ldap = ldap_connect($ldap_url);
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    # Bind
    if ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
        $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    } else {
        $bind = ldap_bind($ldap);
    }

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        error_log("LDAP - Bind error $errno  (".ldap_error($ldap).")");
    } else {
    
    # Search for user
    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        error_log("LDAP - Search error $errno  (".ldap_error($ldap).")");
    } else {

    # Get user DN
    $entry = ldap_first_entry($ldap, $search);
    $userdn = ldap_get_dn($ldap, $entry);

    if( !$userdn ) {
        $result = "badcredentials";
        error_log("LDAP - User $login not found");
    } else {
    
    # Bind with old password
    $bind = ldap_bind($ldap, $userdn, $oldpassword);
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "badcredentials";
        error_log("LDAP - Bind user error $errno  (".ldap_error($ldap).")");
    } else {

    # Set Samba password value
    if ( $samba_mode ) {
        $userdata["sambaNTPassword"] = make_md4_password($newpassword);
        $userdata["sambaPwdLastSet"] = time();
    }

    # Transform password value
    if ( $ad_mode ) {
        $newpassword = "\"" . $newpassword . "\"";
        $len = strlen($newpassword);
        for ($i = 0; $i < $len; $i++){
            $password .= "{$newpassword{$i}}\000";
        }
        $newpassword = $password;
    } else {
        # Hash password if needed
        if ( $hash == "SSHA" ) {
            $newpassword = make_ssha_password($newpassword);
        }
        if ( $hash == "SHA" ) {
            $newpassword = make_sha_password($newpassword);
        }
        if ( $hash == "SMD5" ) {
            $newpassword = make_smd5_password($newpassword);
        }
        if ( $hash == "MD5" ) {
            $newpassword = make_md5_password($newpassword);
        }
        if ( $hash == "CRYPT" ) {
            $newpassword = make_crypt_password($newpassword);
        }
    }

    # Rebind as Manager if needed
    if ( $who_change_password == "manager" ) {
        $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    }

    # Set password value
    if ( $ad_mode ) {
        $userdata["unicodePwd"] = $newpassword;
    } else {
        $userdata["userPassword"] = $newpassword;
    }

    # Commit modification on directory
    $replace = ldap_mod_replace($ldap, $userdn , $userdata);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "passworderror";
        error_log("LDAP - Modify password error $errno (".ldap_error($ldap).")");
    } else {
        $result = "passwordchanged";
    }
    
    }}}}

    @ldap_close($ldap);
}

#==============================================================================
# HTML
#==============================================================================
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php echo $messages[$lang]["title"]; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="cache-control" content="no-cache" />
    <link rel="stylesheet" type="text/css" href="style/styles.css" />
    <link href="style/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="style/favicon.ico" rel="shortcut icon" />
</head>
<body>

<div id="content">
<h1><?php echo $messages[$lang]["title"]; ?></h1>
<img src="<?php echo $logo; ?>" alt="Logo" />
<h2 class="<?php echo get_criticity($result) ?>"><?php echo $messages[$lang][$result]; ?></h2>
<?php if ( $result !== "passwordchanged" ) { ?>
<?php
if ( $pwd_show_policy ) {
    echo "<div class=\"policy\">\n";
    echo "<p>".$messages[$lang]["policy"]."</p>\n";
    echo "<ul>\n";
    if ( $pwd_min_length ) { echo "<li>".$messages[$lang]["policyminlength"]." $pwd_min_length</li>\n"; }
    if ( $pwd_max_length ) { echo "<li>".$messages[$lang]["policymaxlength"]." $pwd_max_length</li>\n"; }
    if ( $pwd_min_lower  ) { echo "<li>".$messages[$lang]["policyminlower"] ." $pwd_min_lower </li>\n"; }
    if ( $pwd_min_upper  ) { echo "<li>".$messages[$lang]["policyminupper"] ." $pwd_min_upper </li>\n"; }
    if ( $pwd_min_digit  ) { echo "<li>".$messages[$lang]["policymindigit"] ." $pwd_min_digit </li>\n"; }
    echo "</ul>\n";
    echo "</div>\n";
}
?>
<form action="#" method="post">
    <table>
    <tr><th><?php echo $messages[$lang]["login"]; ?></th>
    <td><input type="text" name="login" value="<?php echo htmlentities($login) ?>" /></td></tr>
    <tr><th><?php echo $messages[$lang]["oldpassword"]; ?></th>
    <td><input type="password" name="oldpassword" /></td></tr>
    <tr><th><?php echo $messages[$lang]["newpassword"]; ?></th>
    <td><input type="password" name="newpassword" /></td></tr>
    <tr><th><?php echo $messages[$lang]["confirmpassword"]; ?></th>
    <td><input type="password" name="confirmpassword" /></td></tr>
    <tr><td colspan="2">
    <input type="submit" value="<?php echo $messages[$lang]['submit']; ?>" /></td></tr>
    </table>
</form>
<?php } ?>
</div>

</body>
</html>
