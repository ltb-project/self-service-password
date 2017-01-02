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

# This page is called to change a mail adress when a valid token is found in URL

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = "";
$token = "";
$tokenid = "";
$newmail = "";
$confirmmail = "";
$ldap = "";
$userdn = "";
$mail = "";
$source = "";

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
# Get mails
#==============================================================================
if ( $result === "" ) {

    if (isset($_POST["confirmmail"]) and $_POST["confirmmail"]) { $confirmpassword = $_POST["confirmmail"]; }
     else { $result = "confirmmailrequired"; }
    if (isset($_POST["newmail"]) and $_POST["newmail"]) { $newpassword = $_POST["newmail"]; }
     else { $result = "newmailrequired"; }

    # Strip slashes added by PHP
    $newmail = stripslashes_if_gpc_magic_quotes($newmail);
    $confirmmail = stripslashes_if_gpc_magic_quotes($confirmmail);
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
    if ( $newmail != $confirmmail ) { $result="mailnomatch"; }
}

# Check password strength
if ( $result === "" ) {
    $result = check_mail_validity( $newmail);
}

# Change password
if ($result === "") {
    $result = change_mail($ldap, $userdn, $newmail);
}

# Delete token if all is ok
if ( $result === "mailchanged" ) {
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

<?php if ( $result !== "mailchanged" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help alert alert-warning\"><p>";
    echo "<i class=\"fa fa-fw fa-info-circle\"></i> ";
    echo $messages["resetmailbytokenhelp"];
    echo "</p></div>\n";
}
?>

<?php if ( $result !== "tokenrequired" and $result !== "tokennotvalid"  ) { ?>


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
        <label for="newmail" class="col-sm-4 control-label"><?php echo $messages["newmail"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                <input type="text" name="newmail" id="newmail" class="form-control" placeholder="<?php echo $messages["newmail"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="confirmmail" class="col-sm-4 control-label"><?php echo $messages["confirmmail"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                <input type="text" name="confirmmail" id="confirmmail" class="form-control" placeholder="<?php echo $messages["confirmmail"]; ?>" />
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

<?php } ?>

<?php } else {

    # Notify password change
    if ($mail and $notify_on_change) {
        $data = array( "login" => $login, "mail" => $mail, "newmail" => $newmail);
        if ( !send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changemailsubject"], $messages["changemailmessage"].$mail_signature, $data) ) {
            error_log("Error while sending change email to $mail (user $login)");
        }
    }

}
?>

