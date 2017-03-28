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

if (isset($_REQUEST["token"]) and $_REQUEST["token"]) { $token = $_REQUEST["token"]; }
 else { $result = "tokenrequired"; }

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
        $recaptcha = new \ReCaptcha\ReCaptcha($recaptcha_privatekey);
        $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        if (!$resp->isSuccess()) {
            $result = "badcaptcha";
            error_log("Bad reCAPTCHA attempt with user $login");
            foreach ($resp->getErrorCodes() as $code) {
                error_log("reCAPTCHA error: $code");
            }
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
    if ( $ldap_starttls && !ldap_start_tls($ldap) ) {
        $result = "ldaperror";
        error_log("LDAP - Unable to use StartTLS");
    } else {

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
    if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
        $samba_mode = false;
    }
    if ( !in_array( 'shadowAccount', $ocValues ) ) {
        $shadow_options['update_shadowLastChange'] = false;
        $shadow_options['update_shadowExpire'] = false;
    }

    # Get user email for notification
    if ( $notify_on_change ) {
        $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
        if ( $mailValues["count"] > 0 ) {
            $mail = $mailValues[0];
        }
    }

}}}}

#==============================================================================
# Check and register new passord
#==============================================================================
# Match new and confirm password
if ( $result === "" ) {
    if ( $newpassword != $confirmpassword ) { $result="nomatch"; }
}

# Check password strength
if ( $result === "" ) {
    $result = check_password_strength( $newpassword, "", $pwd_policy_config, $login );
}

# Change password
if ($result === "") {
    $result = change_password($ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, "", "");
    if ( $result === "passwordchanged" && isset($posthook) ) {
        $command = escapeshellcmd($posthook).' '.escapeshellarg($login).' '.escapeshellarg($newpassword);
        exec($command);
    }
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

<div class="result alert alert-<?php echo get_criticity($result) ?>">
<p><i class="fa fa-fw <?php echo get_fa_class($result) ?>" aria-hidden="true"></i> <?php echo $messages[$result]; ?></p>
</div>

<?php if ( $result !== "passwordchanged" ) { ?>

<?php
if ( $show_help and ($source !== "sms") ) {
    echo "<div class=\"help alert alert-warning\"><p>";
    echo "<i class=\"fa fa-fw fa-info-circle\"></i> ";
    echo $messages["resetbytokenhelp"];
    echo "</p></div>\n";
} elseif ( $show_help and ($source === "sms") ) {
    echo "<div class=\"help alert alert-warning\"><p>";
    echo "<i class=\"fa fa-fw fa-info-circle\"></i> ";
    echo $messages["resetbysmshelp"];
    echo "</p></div>\n";
}
?>

<?php if ( $result !== "tokenrequired" and $result !== "tokennotvalid"  ) { ?>

<?php
if ($pwd_show_policy_pos === 'above') {
    show_policy($messages, $pwd_policy_config, $result);
}
?>

<div class="alert alert-info">
<form action="#" method="post" class="form-horizontal">
    <input type="hidden" name="token" value="<?php echo htmlentities($token) ?>" />
    <div class="form-group">
        <label for="login" class="col-sm-4 control-label"><?php echo $messages["login"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                <input type="text" name="login" id="login" value="<?php echo htmlentities($login) ?>" class="form-control" placeholder="<?php echo $messages["login"]; ?>" disabled />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="newpassword" class="col-sm-4 control-label"><?php echo $messages["newpassword"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="<?php echo $messages["newpassword"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="confirmpassword" class="col-sm-4 control-label"><?php echo $messages["confirmpassword"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="<?php echo $messages["confirmpassword"]; ?>" />
            </div>
        </div>
    </div>
<?php if ($use_recaptcha) { ?>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_publickey; ?>" data-theme="<?php echo $recaptcha_theme; ?>" data-type="<?php echo $recaptcha_type; ?>" data-size="<?php echo $recaptcha_size; ?>"></div>
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>"></script>
        </div>
    </div>
<?php } ?>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-fw fa-check-square-o"></i> <?php echo $messages['submit']; ?>
            </button>
        </div>
    </div>
</form>
</div>

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
        if ( !send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data) ) {
            error_log("Error while sending change email to $mail (user $login)");
        }
    }

}
?>

