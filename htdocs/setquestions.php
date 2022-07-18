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
$login = $presetLogin;
$password = "";
$question = [];
$answer = [];
$ldap = "";
$userdn = "";
$questions_count = $multiple_answers ? $questions_count : 1;

# Use arrays for question/answer, to accommodate multiple questions on the same page
if (isset($_POST["answer"]) and $_POST["answer"]) {
  if ($questions_count > 1) {
    $answer = $_POST["answer"];
    if (in_array('', $answer)) {
      $result = "answerrequired";
    }
  } else {
    $answer[0] = strval($_POST["answer"]);
  }
} else {
  $result = "answerrequired";
}
if (isset($_POST["question"]) and $_POST["question"]) {
  if ($questions_count > 1) {
    $question = $_POST["question"];
    if (in_array('', $question)) {
      $result = "questionrequired";
    }
  } else {
    $question[0] = strval($_POST["question"]);
  }
} else {
  $result = "questionrequired";
}
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
# Check captcha
#==============================================================================
if ( ( $result === "" ) and $use_captcha) { $result = global_captcha_check();}

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

    # Check objectClass presence and pull back previous answers.
    $search = ldap_search($ldap, $userdn, "(objectClass=*)", array("objectClass", $answer_attribute) );

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

    $aValues = ldap_get_values($ldap, $entry, $answer_attribute );
    # Remove 'count' key
    unset($aValues["count"]);

    if ($multiple_answers and $multiple_answers_one_str) {
        # Unpack multiple questions/answers
        $aValues = is_array($aValues) ? str_getcsv($aValues[0]) : array();
    }

    if (! in_array( $answer_objectClass, $ocValues ) ) {

        # Answer objectClass is not present, add it
        array_push($ocValues, $answer_objectClass );
        $ocValues = array_values( $ocValues );
        $userdata["objectClass"] = $ocValues;
    }

    $i = 0;
    while ($i < $questions_count) {
        $answer_value = '{'.$question[$i].'}'.$answer[$i];
        $answers[$i++] = $crypt_answers ? encrypt($answer_value, $keyphrase) : $answer_value;
    }

    # Do we need to process multiple answers on this request?
    if ($aValues != NULL && $multiple_answers == true ) {
        #  Now determine if this answer has already been registered. If yes, don't add to the answer array.
        $pattern  = "/^\{(.+?)\}/i";
        # Examine each previous question registered and look for matches.
        foreach ( $aValues as $key => $answer_encrypt ) {
            $value = $crypt_answers ? decrypt($answer_encrypt, $keyphrase) : $answer_encrypt;
            if (!(preg_match($pattern, $value, $matched) and in_array($matched[1], $question))) {
                $answers[$i++] = $answer_encrypt;
            }
        }
    }

    if ($multiple_answers and $multiple_answers_one_str) {
        # Pack multiple questions/answers - works whether encrypted or not
        $userdata[$answer_attribute][0] = str_putcsv($answers);
    } else {
        $userdata[$answer_attribute] = $answers;
    }
    $replace = ldap_mod_replace($ldap, $userdn , $userdata);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "answermoderror";
        error_log("LDAP - Modify answer (error $errno (".ldap_error($ldap).")");
    } else {
        $result = "answerchanged";
    }

}}
