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

# This page is called to reset a password trusting question/anwser

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = "";
$question = "";
$answer = "";
$newpassword = "";
$confirmpassword = "";
$ldap = "";
$userdn = "";
if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }
$mail = "";

if (isset($_POST["confirmpassword"]) and $_POST["confirmpassword"]) { $confirmpassword = $_POST["confirmpassword"]; }
 else { $result = "confirmpasswordrequired"; }
if (isset($_POST["newpassword"]) and $_POST["newpassword"]) { $newpassword = $_POST["newpassword"]; }
  else { $result = "newpasswordrequired"; }
if (isset($_POST["answer"]) and $_POST["answer"]) { $answer = $_POST["answer"]; }
 else { $result = "answerrequired"; }
if (isset($_POST["question"]) and $_POST["question"]) { $question = $_POST["question"]; }
 else { $result = "questionrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = $_REQUEST["login"]; }
 else { $result = "loginrequired"; }
if (! isset($_POST["confirmpassword"]) and ! isset($_POST["newpassword"]) and ! isset($_POST["answer"]) and ! isset($_POST["question"]) and ! isset($_REQUEST["login"]))
 { $result = "emptyresetbyquestionsform"; }

# Strip slashes added by PHP
$login = stripslashes_if_gpc_magic_quotes($login);
$question = stripslashes_if_gpc_magic_quotes($question);
$answer = stripslashes_if_gpc_magic_quotes($answer);
$newpassword = stripslashes_if_gpc_magic_quotes($newpassword);
$confirmpassword = stripslashes_if_gpc_magic_quotes($confirmpassword);

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
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
# Check question/answer
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
    } else {

    # Check objectClass to allow samba and shadow updates
    $ocValues = ldap_get_values($ldap, $entry, 'objectClass');
    if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
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

    # Get question/answer values
    $questionValues = ldap_get_values($ldap, $entry, $answer_attribute);
    unset($questionValues["count"]);
    $match = 0;

    # Match with user submitted values
    foreach ($questionValues as $questionValue) {
        $answer = preg_quote("$answer","/");
        if (preg_match("/^\{$question\}$answer$/i", $questionValue)) {
            $match = 1;
        }
    }

    if (!$match) {
        $result = "answernomatch";
        error_log("Answer does not match question for user $login");
    }

}}}}}

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
        exec(escapeshellcmd("$posthook $login $newpassword"));
    }
}

#==============================================================================
# HTML
#==============================================================================
?>

<div class="result alert alert-<?php echo get_criticity($result) ?>">
<p><i class="fa <?php echo get_fa_class($result) ?>" aria-hidden="true"></i> <?php echo $messages[$result]; ?></p>
</div>

<?php if ( $result !== "passwordchanged" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help alert alert-warning\"><p>";
    echo "<i class=\"fa fa-info-circle\"></i> ";
    echo $messages["resetbyquestionshelp"];
    echo "</p></div>\n";
}
?>

<?php
if ($pwd_show_policy_pos === 'above') {
    show_policy($messages, $pwd_policy_config, $result);
}
?>

<div class="alert alert-info">
<form action="#" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="login" class="col-sm-4 control-label"><?php echo $messages["login"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="login" id="login" value="<?php echo htmlentities($login) ?>" class="form-control" placeholder="<?php echo $messages["login"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="question" class="col-sm-4 control-label"><?php echo $messages["question"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-question"></i></span>
                <select name="question" id="question" class="form-control">
<?php
# Build options
foreach ( $messages["questions"] as $value => $text ) {
    echo "<option value=\"$value\">$text</option>";
}
?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="answer" class="col-sm-4 control-label"><?php echo $messages["answer"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" name="answer" id="answer" class="form-control" placeholder="<?php echo $messages["answer"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="newpassword" class="col-sm-4 control-label"><?php echo $messages["newpassword"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="<?php echo $messages["newpassword"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="confirmpassword" class="col-sm-4 control-label"><?php echo $messages["confirmpassword"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
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
                <i class="fa fa-check-square-o"></i> <?php echo $messages['submit']; ?>
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

<?php } else {

    # Notify password change
    if ($mail and $notify_on_change) {
        $data = array( "login" => $login, "mail" => $mail, "password" => $newpassword);
        if ( !send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"], $data) ) {
            error_log("Error while sending change email to $mail (user $login)");
        }
    }

}
?>

