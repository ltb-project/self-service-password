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

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = "";
$token = "";
$tokenid = "";
$newpassword = "";
$confirmpassword = "";
$ldap = "";
$userdn = "";
if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }

if (isset($_REQUEST["token"]) and $_REQUEST["token"]) { $token = $_REQUEST["token"]; }
 else { $result = "tokenrequired"; }

#==============================================================================
# Get token
#==============================================================================
if ( $result === "" ) {

    # Open session with the token
    # Warning, set session.use_only_cookies = 0 in php.ini 

    if ( $crypt_tokens ) {
        $tokenid = decrypt($token);
    } else {
        $tokenid = $token;
    }

    session_id($tokenid);
    session_name("token");
    session_start();
    $login = $_SESSION['login'];

    if ( !$login ) {
        $result = "tokennotvalid";
	error_log("Unable to open session $tokenid");
    }

}

#==============================================================================
# Get passwords
#==============================================================================
if ( $result === "" ) {

    if (isset($_POST["confirmpassword"]) and $_POST["confirmpassword"]) { $confirmpassword = $_POST["confirmpassword"]; }
     else { $result = "confirmpasswordrequired"; }
    if (isset($_POST["newpassword"]) and $_POST["newpassword"]) { $newpassword = $_POST["newpassword"]; }
     else { $result = "newpasswordrequired"; }

    # Strip slashes added by PHP
    $newpassword = stripslashes_if_gpc_magic_quotes($newpassword);
    $confirmpassword = stripslashes_if_gpc_magic_quotes($confirmpassword);
}

#==============================================================================
# Find user
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
        error_log("LDAP - Bind error $errno (".ldap_error($ldap).")");
    } else {

    # Search for user
    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
    } else {

    # Get user DN
    $entry = ldap_first_entry($ldap, $search);
    $userdn = ldap_get_dn($ldap, $entry);

    if( !$userdn ) {
        $result = "badcredentials";
        error_log("LDAP - User $login not found");
    }

}}}

#==============================================================================
# Check and register new passord
#==============================================================================
# Match new and confirm password
if ( $result === "" ) {
    if ( $newpassword != $confirmpassword ) { $result="nomatch"; }
}

# Check password strength
if ( $result === "" ) {
    $result = check_password_strength( $newpassword, '', $pwd_special_chars, $pwd_forbidden_chars, $pwd_min_length, $pwd_max_length, $pwd_min_lower, $pwd_min_upper, $pwd_min_digit, $pwd_min_special );
}

# Change password
if ($result === "") {
    $result = change_password($ldap, $userdn, $newpassword, $ad_mode, $samba_mode, $hash);
}

#==============================================================================
# HTML
#==============================================================================
?>

<div class="result <?php echo get_criticity($result) ?>">
<h2 class="<?php echo get_criticity($result) ?>"><?php echo $messages[$result]; ?></h2>
</div>

<?php if ( $result !== "passwordchanged" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help\"><p>";
    echo $messages["resetbytokenhelp"];
    echo "</p></div>\n";
}
?>

<?php if ( $result !== "tokenrequired" and $result !== "tokennotvalid"  ) { ?>

<?php
show_policy($messages,
    $pwd_min_length, $pwd_max_length,
    $pwd_min_lower, $pwd_min_upper,
    $pwd_min_digit, $pwd_min_special,
    $pwd_forbidden_chars,
    $pwd_no_reuse,
    $pwd_show_policy, $result
);
?>

<form action="#" method="post">
    <input type="hidden" name="token" value="<?php echo htmlentities($token) ?>" />
    <table>
    <tr><th><?php echo $messages["login"]; ?></th>
    <td><p><?php echo htmlentities($login) ?></p></td></tr>
    <tr><th><?php echo $messages["newpassword"]; ?></th>
    <td><input type="password" name="newpassword" /></td></tr>
    <tr><th><?php echo $messages["confirmpassword"]; ?></th>
    <td><input type="password" name="confirmpassword" /></td></tr>
    <tr><td colspan="2">
    <input type="submit" value="<?php echo $messages['submit']; ?>" /></td></tr>
    </table>
</form>

<?php } ?>

<?php } ?>
