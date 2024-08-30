<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2024 Clement OUDOT
# Copyright (C) 2024 LTB-project.org
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
$login = $presetLogin;
$question = [];
$answer = [];
$newpassword = "";
$confirmpassword = "";
$ldap = "";
$userdn = "";
if (!isset($pwd_forbidden_chars)) { $pwd_forbidden_chars=""; }
$mail = "";
$extended_error_msg = "";
$questions_count = $multiple_answers ? $questions_count : 1;

if (isset($_POST["confirmpassword"]) and $_POST["confirmpassword"]) { $confirmpassword = strval($_POST["confirmpassword"]); }
else { $result = "confirmpasswordrequired"; }

if (isset($_POST["newpassword"]) and $_POST["newpassword"]) { $newpassword = strval($_POST["newpassword"]); }
else { $result = "newpasswordrequired"; }

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
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = strval($_REQUEST["login"]); }
else { $result = "loginrequired"; }
if (! isset($_POST["confirmpassword"]) and ! isset($_POST["newpassword"]) and ! isset($_POST["answer"]) and ! isset($_POST["question"]) and ! isset($_REQUEST["login"])) {
    $result = "emptyresetbyquestionsform";
}

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

#==============================================================================
# Check captcha
#==============================================================================
if ( ( $result === "" ) and $use_captcha) { $result = $captchaInstance->verify_captcha_challenge();}

# Should we pre-populate the question?
#   This should ensure that $login is valid and everything else is empty.
$populate_questions = $question_populate_enable
                    && $result == "questionrequired"
                    && !array_filter($question)
                    && !array_filter($answer)
                    && empty($newpassword)
                    && empty($confirmpassword);

#==============================================================================
# Check question/answer
#==============================================================================
if ( $result === ""  || $populate_questions) {

    # Connect to LDAP
    # Connect to LDAP
    $ldap_connection = $ldapInstance->connect();

    $ldap = $ldap_connection[0];
    $result = $ldap_connection[1];

    if ( $ldap ) {

            # Search for user
            $ldap_filter = str_replace("{login}", $login, $ldap_filter);
            $search = $ldapInstance->search_with_scope($ldap_scope, $ldap_base, $ldap_filter);

            $errno = ldap_errno($ldap);
            if ( $errno ) {
                $result = "ldaperror";
                error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
            } else {

                # Get user DN
                $entry = ldap_first_entry($ldap, $search);

                if ( !$entry ) {
                    $result = "badcredentials";
                    error_log("LDAP - User $login not found");
                } else {

                    $userdn = ldap_get_dn($ldap, $entry);

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
                    if ($notify_on_change) {
                        $mail = \Ltb\AttributeValue::ldap_get_mail_for_notification($ldap, $entry, $mail_attributes);
                    }

                    # Get question/answer values
                    $questionValues = ldap_get_values($ldap, $entry, $answer_attribute);
                    unset($questionValues["count"]);

                    if ($multiple_answers and $multiple_answers_one_str) {
                        # Unpack multiple questions/answers
                        $questionValues = str_getcsv($questionValues[0]);
                    }

                    if ($populate_questions) {
                        $pattern  = "/^\{(.+?)\}/i";
                        $i = 0;
                        foreach ($questionValues as $questionValue) {
                            $value = $crypt_answers ? decrypt($questionValue, $keyphrase) : $questionValue;
                            if (preg_match($pattern, $value, $matched)) {
                                $question[$i++] = $matched[1];
                            }
                            if ($i >= $questions_count) {
                                $result = "emptyresetbyquestionsform";
                                break;
                            }
                        }
                    } else {
                        # Match with user submitted values
                        $pattern  = "/^\{(.+?)\}(.+)$/i";
                        $registered_questions = [];

                        # Get registered questions
                        foreach ($questionValues as $questionValue) {
                            $value = $crypt_answers ? decrypt($questionValue, $keyphrase) : $questionValue;
                            if (preg_match($pattern, $value, $matched)) {
                                $registered_questions[$matched[1]] = $matched[2];
                            }
                        }

                        $matched = 0;
                        # Match answer(s)
                        for ($q = 0; $q < $questions_count; $q++) {
                            if (is_string($registered_questions[$question[$q]]) && is_string($answer[$q]) && hash_equals($registered_questions[$question[$q]], $answer[$q])) {
                                $matched++;
                            }
                        }

                        if ($matched < $questions_count) {
                            $result = "answernomatch";
                            error_log("Answer does not match question for user $login");
                        }
                    }

                    $entry_array = ldap_get_attributes($ldap, $entry);
                    $entry_array['dn'] = $userdn;
                }
            }
    }
}


if ( !$result ) {
    if ( $use_ratelimit ) {
        if ( ! allowed_rate($login,$_SERVER[$client_ip_header],$rrl_config) ) {
            $result = "throttle";
            error_log("LDAP - User $login too fast");
        }
    }
}

#==============================================================================
# Check and register new passord
#==============================================================================
# Match new and confirm password
if ( !$result ) {
    if ( $newpassword != $confirmpassword ) { $result="nomatch"; }
}

# Check password strength
if ( !$result ) {
    $result = \Ltb\Ppolicy::check_password_strength( $newpassword, "", $pwd_policy_config, $login, $entry_array, $change_custompwdfield );
}

# Change password
if ( !$result ) {
    if ( isset($prehook) ) {
        $command = hook_command($prehook, $login, $newpassword, null, $prehook_password_encodebase64);
        exec($command, $prehook_output, $prehook_return);
    }
    if ( ! isset($prehook_return) || $prehook_return === 0 || $ignore_prehook_error ) {
        $result = change_password($ldapInstance, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, "", "", $ldap_use_exop_passwd, $ldap_use_ppolicy_control, false, "");
        if ( $result === "passwordchanged" && isset($posthook) ) {
            $command = hook_command($posthook, $login, $newpassword, null, $posthook_password_encodebase64);
            exec($command, $posthook_output, $posthook_return);
        }
        if ( $result !== "passwordchanged" ) {
            if ( $show_extended_error ) {
                ldap_get_option($ldap, 0x0032, $extended_error_msg);
            }
        }
    }
}

#==============================================================================
# Notify password change
#==============================================================================
if ($mail and $notify_on_change and $result === 'paswordchanged') {
    $data = array( "login" => $login, "mail" => $mail, "password" => $newpassword);
    if ( !$mailer->send_mail($mail, $mail_from, $mail_from_name, $messages["changesubject"], $messages["changemessage"].$mail_signature, $data) ) {
        error_log("Error while sending change email to $mail (user $login)");
    }
}
