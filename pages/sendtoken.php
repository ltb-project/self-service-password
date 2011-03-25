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

# This page is called to send a reset token by mail

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = "";
$mail = "";
$ldap = "";
$userdn = "";
$token = "";

if (isset($_POST["mail"]) and $_POST["mail"]) { $mail = $_POST["mail"]; }
 else { $result = "mailrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = $_REQUEST["login"]; }
 else { $result = "loginrequired"; }

# Strip slashes added by PHP
$login = stripslashes_if_gpc_magic_quotes($login);
$mail = stripslashes_if_gpc_magic_quotes($mail);

#==============================================================================
# Check mail
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
    } else {
    
    # Compare mail values
    $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
    unset($mailValues["count"]);
    $match = 0;

    # Match with user submitted values
    foreach ($mailValues as $mailValue) {
        if (preg_match("/^$mail$/i", $mailValue)) {
            $match = 1;
        }
    }

    if (!$match) {
        $result = "mailnomatch";
        error_log("Mail $mail does not match for user $login");
    }

}}}}

#==============================================================================
# Build and store token
#==============================================================================
if ( $result === "" ) {

    # Use PHP session to register token
    # We do not generate cookie
    ini_set("session.use_cookies",0);
    ini_set("session.use_only_cookies",1);

    session_name("token");
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['time']  = time();

    if ( $crypt_tokens ) {
        $token = encrypt(session_id());
    } else {
        $token = session_id();
    }

}

#==============================================================================
# Send token by mail
#==============================================================================
if ( $result === "" ) {

    # Build reset by token URL
    $method = "http";
    if ( $_SERVER['HTTPS'] ) { $method .= "s"; }
    $server_name = $_SERVER['SERVER_NAME'];
    $script_name = $_SERVER['SCRIPT_NAME'];

    $reset_url = $method."://".$server_name.$script_name."?action=resetbytoken&token=$token";
    
    error_log("Send reset URL $reset_url");

    # Replace some values in reset message
    $reset_message = $messages["resetmessage"];
    $reset_message = str_replace("{login}", $login, $reset_message);
    $reset_message = str_replace("{mail}", $mail, $reset_message);
    $reset_message = str_replace("{url}", $reset_url, $reset_message);

    # Send message
    if ( mail($mail, $messages["resetsubject"], $reset_message) ) {
        $result = "tokensent";
    } else {
        $result = "tokennotsent";
        error_log("Error while sending token to $mail (user $login)");
    }
}

#==============================================================================
# HTML
#==============================================================================
?>

<div class="result <?php echo get_criticity($result) ?>">
<h2 class="<?php echo get_criticity($result) ?>"><?php echo $messages[$result]; ?></h2>
</div>

<?php if ( $result !== "tokensent" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help\"><p>";
    echo $messages["sendtokenhelp"];
    echo "</p></div>\n";
}
?>

<form action="#" method="post">
    <table>
    <tr><th><?php echo $messages["login"]; ?></th>
    <td><input type="text" name="login" value="<?php echo htmlentities($login) ?>" /></td></tr>
    <tr><th><?php echo $messages["mail"]; ?></th>
    <td><input type="text" name="mail" /></td></tr>
    <tr><td colspan="2">
    <input type="submit" value="<?php echo $messages['submit']; ?>" /></td></tr>
    </table>
</form>

<?php } ?>
