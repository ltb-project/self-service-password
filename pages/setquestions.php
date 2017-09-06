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

class SetQuestionsController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get("login");
        $password = $request->request->get("password");;
        $question = $request->request->get("question");
        $answer = $request->request->get("answer");
        $ldap = "";
        $userdn = "";

        if (empty($login)) { $result = "loginrequired"; }
        if (empty($password)) { $result = "passwordrequired"; }
        if (empty($question)) { $result = "questionrequired"; }
        if (empty($answer)) { $result = "answerrequired"; }

        if (empty($login) and empty($password) and empty($question) and empty($answer)) {
            $result = "emptysetquestionsform";
        }

        // Check the entered username for characters that our installation doesn't support
        if ( $result === "" ) {
            $result = check_username_validity($login,$login_forbidden_chars);
        }

        // Check reCAPTCHA
        if ( $result === "" && $use_recaptcha ) {
            $result = check_recaptcha($recaptcha_privatekey, $recaptcha_request_method, $request->request->get('g-recaptcha-response'), $login);
        }

        // Check password
        if ( $result === "" ) {

            // Connect to LDAP
            $ldap = ldap_connect($ldap_url);
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
            if ( $ldap_starttls && !ldap_start_tls($ldap) ) {
                $result = "ldaperror";
                error_log("LDAP - Unable to use StartTLS");
            } else {

                // Bind
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

                    // Search for user
                    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
                    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

                    $errno = ldap_errno($ldap);
                    if ( $errno ) {
                        $result = "ldaperror";
                        error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
                    } else {

                        // Get user DN
                        $entry = ldap_first_entry($ldap, $search);
                        $userdn = ldap_get_dn($ldap, $entry);

                        if( !$userdn ) {
                            $result = "badcredentials";
                            error_log("LDAP - User $login not found");
                        } else {

                            // Bind with password
                            $bind = ldap_bind($ldap, $userdn, $password);
                            $errno = ldap_errno($ldap);
                            if ( $errno ) {
                                $result = "badcredentials";
                                error_log("LDAP - Bind user error $errno (".ldap_error($ldap).")");
                            }}}}}}

        // Register answer
        if ( $result === "" ) {

            // Rebind as Manager if needed
            if ( $who_change_password == "manager" ) {
                $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
            }

            // Check objectClass presence
            $search = ldap_search($ldap, $userdn, "(objectClass=*)", array("objectClass") );

            $errno = ldap_errno($ldap);
            if ( $errno ) {
                $result = "ldaperror";
                error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
            } else {

                // Get objectClass values from user entry
                $entry = ldap_first_entry($ldap, $search);
                $ocValues = ldap_get_values($ldap, $entry, "objectClass");

                // Remove 'count' key
                unset($ocValues["count"]);

                if (! in_array( $answer_objectClass, $ocValues ) ) {

                    // Answer objectClass is not present, add it
                    array_push($ocValues, $answer_objectClass );
                    $ocValues = array_values( $ocValues );
                    $userdata["objectClass"] = $ocValues;
                }

                // Question/Answer
                $userdata[$answer_attribute] = '{'.$question.'}'.$answer;

                // Commit modification on directory
                $replace = ldap_mod_replace($ldap, $userdn , $userdata);

                $errno = ldap_errno($ldap);
                if ( $errno ) {
                    $result = "answermoderror";
                    error_log("LDAP - Modify answer (error $errno (".ldap_error($ldap).")");
                } else {
                    $result = "answerchanged";
                }

            }}

        // Render associated template
        return $this->render('setquestions.twig', array(
            'result' => $result,
            'show_help' => $show_help,
            'login' => $login,
            'questions' => $messages["questions"],
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
        ));
    }
}

$controller = new SetQuestionsController($config);
return $controller->indexAction($request);
