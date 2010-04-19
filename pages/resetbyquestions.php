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

# This page is called to reset a password trsuting question/anwser

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

# Strip slashes added by PHP
$login = stripslashes_if_gpc_magic_quotes($login);
$question = stripslashes_if_gpc_magic_quotes($question);
$answer = stripslashes_if_gpc_magic_quotes($answer);
$newpassword = stripslashes_if_gpc_magic_quotes($newpassword);
$confirmpassword = stripslashes_if_gpc_magic_quotes($confirmpassword);

#==============================================================================
# Check question/answer
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
    
    # Get question/answer values
    $questionValues = ldap_get_values($ldap, $entry, $answer_attribute);
    unset($questionValues["count"]);
    $match = 0;

    # Match with user submitted values
    foreach ($questionValues as $questionValue) {
        if (preg_match("/^\{$question\}$answer$/i", $questionValue)) {
            $match = 1;
        }
    }

    if (!$match) {
        $result = "answernomatch";
        error_log("Answer does not match question for user $login");
    }

}}}}

#==============================================================================
# Check and regsiter new passord
#==============================================================================
# Match new and confirm password
if ( $result === "" ) {
    if ( $newpassword != $confirmpassword ) { $result="nomatch"; }
}

# Check password strength
if ( $result === "" ) {
    $result = check_password_strength( $newpassword, $pwd_special_chars, $pwd_forbidden_chars, $pwd_min_length, $pwd_max_length, $pwd_min_lower, $pwd_min_upper, $pwd_min_digit, $pwd_min_special );
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
<h2 class="<?php echo get_criticity($result) ?>"><?php echo $messages[$lang][$result]; ?></h2>
</div>

<?php if ( $result !== "passwordchanged" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help\"><p>";
    echo $messages[$lang]["resetbyquestionshelp"];
    echo "</p></div>\n";
}
?>

<?php
if ( $pwd_show_policy ) {
    show_policy($lang, $messages,
        $pwd_min_length, $pwd_max_length,
        $pwd_min_lower, $pwd_min_upper,
        $pwd_min_digit, $pwd_min_special,
        $pwd_forbidden_chars
    );
}
?>

<form action="#" method="post">
    <table>
    <tr><th><?php echo $messages[$lang]["login"]; ?></th>
    <td><input type="text" name="login" value="<?php echo htmlentities($login) ?>" /></td></tr>
    <tr><th><?php echo $messages[$lang]["question"]; ?></th>
    <td>
    <select name="question">

<?php
# Build options
foreach ( $messages[$lang]["questions"] as $value => $text ) {
    echo "<option value=\"$value\">$text</option>";
}
?>

    </select>
    </td></tr>
    <tr><th><?php echo $messages[$lang]["answer"]; ?></th>
    <td><input type="text" name="answer" /></td></tr>
    <tr><th><?php echo $messages[$lang]["newpassword"]; ?></th>
    <td><input type="password" name="newpassword" /></td></tr>
    <tr><th><?php echo $messages[$lang]["confirmpassword"]; ?></th>
    <td><input type="password" name="confirmpassword" /></td></tr>
    <tr><td colspan="2">
    <input type="submit" value="<?php echo $messages[$lang]['submit']; ?>" /></td></tr>
    </table>
</form>

<?php } ?>
