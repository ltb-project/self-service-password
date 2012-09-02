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
$mail = "";
$source = "";

if (isset($_REQUEST["token"]) and $_REQUEST["token"]) { $token = $_REQUEST["token"]; }
 else { $result = "tokenrequired"; }

if (isset($_REQUEST["source"]) and $_REQUEST["source"]) { $source = $_REQUEST["source"]; }

#==============================================================================
# Get token
#==============================================================================
if ( $result === "" ) {

    # Open session with the token
    if ( $crypt_tokens ) {
        $tokenid = decrypt($token, $keyphrase);
    } else {
        $tokenid = $token;
    }

    ini_set("session.use_cookies",0);
    ini_set("session.use_only_cookies",1);

    # Manage lifetime with sessions properties
    if (isset($token_lifetime)) {
        ini_set("session.gc_maxlifetime", $token_lifetime);
        ini_set("session.gc_probability",1);
        ini_set("session.gc_divisor",1);
    }
    
    session_id($tokenid);
    session_name("token");
    session_start();
    $login = $_SESSION['login'];

    if ( !$login ) {
        $result = "tokennotvalid";
	error_log("Unable to open session $tokenid");
    } else {
        if (isset($token_lifetime)) {
            # Manage lifetime with session content
            $tokentime = $_SESSION['time'];
            if ( time() - $tokentime > $token_lifetime ) {
                $result = "tokennotvalid";
                error_log("Token lifetime expired");
	    }
        }
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
# Check reCAPTCHA
#==============================================================================
if ( $result === "" ) {
    if ( $use_recaptcha ) {
        $resp = recaptcha_check_answer ($recaptcha_privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
        if (!$resp->is_valid) {
            $result = "badcaptcha";
            error_log("Bad reCAPTCHA attempt with user $login");
        }
    }
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

    # Check objectClass to allow samba and shadow updates
    $ocValues = ldap_get_values($ldap, $entry, 'objectClass');
    if ( !in_array( 'sambaSamAccount', $ocValues ) ) {
        $samba_mode = false;
    }
    if ( !in_array( 'shadowAccount', $ocValues ) ) {
        $shadow_options['update_shadowLastChange'] = false;
    }

    # Get user email for notification
    if ( $notify_on_change ) {
        $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
        if ( $mailValues["count"] > 0 ) {
            $mail = $mailValues[0];
        }
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
    $result = check_password_strength( $newpassword, $oldpassword, $pwd_policy_config );
}

# Change password
if ($result === "") {
    $result = change_password($ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $shadow_options, $hash, $who_change_password);
}

# Delete token if all is ok
if ( $result === "passwordchanged" ) {
    $_SESSION = array();
    session_destroy();
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
if ( $show_help and ($source !== "sms") ) {
    echo "<div class=\"help\"><p>";
    echo $messages["resetbytokenhelp"];
    echo "</p></div>\n";
} elseif ( $show_help and ($source === "sms") ) {
    echo "<div class=\"help\"><p>";
    echo $messages["resetbysmshelp"];
    echo "</p></div>\n";
}
?>

<?php if ( $result !== "tokenrequired" and $result !== "tokennotvalid"  ) { ?>

<?php
if ($pwd_show_policy_pos === 'below') {
    show_policy($messages, $pwd_policy_config, $result);
}
?>

<form action="#" method="post">
<?php if ($use_recaptcha) recaptcha_get_conf($recaptcha_theme, $lang); ?>
    <input type="hidden" name="token" value="<?php echo htmlentities($token) ?>" />
    <table>
    <tr><th><?php echo $messages["login"]; ?></th>
    <td><p><?php echo htmlentities($login) ?></p></td></tr>
    <tr><th><?php echo $messages["newpassword"]; ?></th>
    <td><input type="password" name="newpassword" /></td></tr>
    <tr><th><?php echo $messages["confirmpassword"]; ?></th>
    <td><input type="password" name="confirmpassword" /></td></tr>
<?php if ($use_recaptcha) { ?>
    <tr><td colspan="2">
<?php echo recaptcha_get_html($recaptcha_publickey, null, $recaptcha_ssl); ?>
    </td></tr>
<?php } ?>
    <tr><td colspan="2">
    <input type="submit" value="<?php echo $messages['submit']; ?>" /></td></tr>
    </table>
</form>

<?php 
if ($pwd_show_policy_pos === 'below') {
    show_policy($messages, $pwd_policy_config, $result);
}   
?>

<?php } ?>

<?php } else {

    # Notify password change
    if ($mail and $notify_on_change) {
        $data = array( "login" => $login, "mail" => $mail, "password" => $newpassword);
        if ( !send_mail($mail, $mail_from, $messages["changesubject"], $messages["changemessage"], $data) ) {
            error_log("Error while sending change email to $mail (user $login)");
        }
    }

}
?>

