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

if (isset($_POST["answer"]) and $_POST["answer"]) { $answer = $_POST["answer"]; }
 else { $result = "answerrequired"; }
if (isset($_POST["question"]) and $_POST["question"]) { $question = $_POST["question"]; }
 else { $result = "questionrequired"; }
if (isset($_POST["password"]) and $_POST["password"]) { $password = $_POST["password"]; }
 else { $result = "passwordrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = $_REQUEST["login"]; }
 else { $result = "loginrequired"; }

# Strip slashes added by PHP
$login = stripslashes_if_gpc_magic_quotes($login);
$password = stripslashes_if_gpc_magic_quotes($password);
$question = stripslashes_if_gpc_magic_quotes($question);
$answer = stripslashes_if_gpc_magic_quotes($answer);

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
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
# Check password
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
    
    # Bind with password
    $bind = ldap_bind($ldap, $userdn, $password);
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "badcredentials";
        error_log("LDAP - Bind user error $errno (".ldap_error($ldap).")");
}}}}}

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
    $userdata[$answer_attribute] = '{'.$question.'}'.$answer;

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
?>

<div class="result <?php echo get_criticity($result) ?>">
<h2 class="<?php echo get_criticity($result) ?>"><?php echo $messages[$result]; ?></h2>
</div>

<?php if ( $result !== "answerchanged" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help\"><p>";
    echo $messages["setquestionshelp"];
    echo "</p></div>\n";
}
?>

<form action="#" method="post">
<?php if ($use_recaptcha) recaptcha_get_conf($recaptcha_theme, $lang); ?>
    <table>
    <tr><th><?php echo $messages["login"]; ?></th>
    <td><input type="text" name="login" value="<?php echo htmlentities($login) ?>" /></td></tr>
    <tr><th><?php echo $messages["password"]; ?></th>
    <td><input type="password" name="password" /></td></tr>
    <tr><th><?php echo $messages["question"]; ?></th>
    <td>
    <select name="question">

<?php
# Build options
foreach ( $messages["questions"] as $value => $text ) {
    echo "<option value=\"$value\">$text</option>";
}
?>

    </select>
    </td></tr>
    <tr><th><?php echo $messages["answer"]; ?></th>
    <td><input type="text" name="answer" /></td></tr>
<?php if ($use_recaptcha) { ?>
    <tr><td colspan="2">
<?php echo recaptcha_get_html($recaptcha_publickey, null, $recaptcha_ssl); ?>
    </td></tr>
<?php } ?>
    <tr><td colspan="2">
    <input type="submit" value="<?php echo $messages['submit']; ?>" /></td></tr>
    </table>
</form>

<?php } ?>
