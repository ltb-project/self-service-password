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

# This page is called to set answers for a user

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = "";
$password = "";
$question = "";
$answer = "";
$ldap = "";
$userdn = "";

if (isset($_POST["answer"]) and $_POST["answer"]) { $answer = strval($_POST["answer"]); }
 else { $result = "answerrequired"; }
if (isset($_POST["question"]) and $_POST["question"]) { $question = strval($_POST["question"]); }
 else { $result = "questionrequired"; }
if (isset($_POST["password"]) and $_POST["password"]) { $password = strval($_POST["password"]); }
 else { $result = "passwordrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = strval($_REQUEST["login"]); }
 else { $result = "loginrequired"; }
if (! isset($_POST["answer"]) and ! isset($_POST["question"]) and ! isset($_POST["password"]) and ! isset($_REQUEST["login"]))
 { $result = "emptysetquestionsform"; }

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

#==============================================================================
# Check reCAPTCHA
#==============================================================================
if ( $result === "" && $use_recaptcha ) {
    $result = check_recaptcha($recaptcha_privatekey, $recaptcha_request_method, $_POST['g-recaptcha-response'], $login);
}

#==============================================================================
# Check password
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

    if ( !$bind ) {
        $result = "ldaperror";
        $errno = ldap_errno($ldap);
        if ( $errno ) {
            error_log("LDAP - Bind error $errno  (".ldap_error($ldap).")");
        }
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
    
    # Bind with password
    $bind = ldap_bind($ldap, $userdn, $password);
    if ( !$bind ) {
        $result = "badcredentials";
        $errno = ldap_errno($ldap);
        if ( $errno ) {
            error_log("LDAP - Bind user error $errno (".ldap_error($ldap).")");
        }
}}}}}}

#==============================================================================
# Register answer
#==============================================================================
if ( $result === "" ) {

    # Rebind as Manager if needed
    if ( $who_change_password == "manager" ) {
        $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    }

    # Check objectClass presence
    $search = ldap_search($ldap, $userdn, "(objectClass=*)", array("objectClass") );
 
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
    } else {

    # Get objectClass values from user entry
    $entry = ldap_first_entry($ldap, $search);
    $ocValues = ldap_get_values($ldap, $entry, "objectClass");

    # Remove 'count' key
    unset($ocValues["count"]);

    if (! in_array( $answer_objectClass, $ocValues ) ) {

        # Answer objectClass is not present, add it
        array_push($ocValues, $answer_objectClass );
        $ocValues = array_values( $ocValues );
        $userdata["objectClass"] = $ocValues;
    }

    # Question/Answer
    $answer_value = '{'.$question.'}'.$answer;
    $userdata[$answer_attribute] = $crypt_answers ? encrypt($answer_value, $keyphrase) : $answer_value;

    # Commit modification on directory
    $replace = ldap_mod_replace($ldap, $userdn , $userdata);
    
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "answermoderror";
        error_log("LDAP - Modify answer (error $errno (".ldap_error($ldap).")");
    } else {
        $result = "answerchanged";
    }

}}

#==============================================================================
# HTML
#==============================================================================
if ( in_array($result, $obscure_failure_messages) ) { $result = "badcredentials"; }
?>

<div class="result alert alert-<?php echo get_criticity($result) ?>">
<p><i class="fa fa-fw <?php echo get_fa_class($result) ?>" aria-hidden="true"></i> <?php echo $messages[$result]; ?></p>
</div>

<?php if ( $result !== "answerchanged" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help alert alert-warning\"><p>";
    echo "<i class=\"fa fa-fw fa-info-circle\"></i> ";
    echo $messages["setquestionshelp"];
    echo "</p></div>\n";
}
?>

<div class="alert alert-info">
<form action="#" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="login" class="col-sm-4 control-label"><?php echo $messages["login"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                <input type="text" name="login" id="login" value="<?php echo htmlentities($login) ?>" class="form-control" placeholder="<?php echo $messages["login"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-4 control-label"><?php echo $messages["password"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $messages["password"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="question" class="col-sm-4 control-label"><?php echo $messages["question"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-question"></i></span>
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
                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                <input type="text" name="answer" id="answer" class="form-control" placeholder="<?php echo $messages["answer"]; ?>" />
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
