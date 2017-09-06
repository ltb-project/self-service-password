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

# This page is called to change sshPublicKey

class SshKeyController extends Controller {
    /**
     * @param $request Request
     * @return string
     */
    public function indexAction($request) {
        extract($this->config);

        // Initiate vars
        $result = "";
        $login = $request->get("login", "");
        $password = $request->request->get("password", "");
        $sshkey = $request->request->get("sshkey", "");
        $mail = "";

        $missings = array();
        if (!$request->get("login")) { $missings[] = "loginrequired"; }
        if (!$request->request->has("password")) { $missings[] = "passwordrequired"; }
        if (!$request->request->has("sshkey")) { $missings[] = "sshkeyrequired"; }

        if(count($missings) > 0) {
            $result = count($missings) == 3 ? 'emptysshkeychangeform' : $missings[0];
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
                    error_log("LDAP - Bind error $errno  (".ldap_error($ldap).")");
                } else {

                    // Search for user
                    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
                    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

                    $errno = ldap_errno($ldap);
                    if ( $errno ) {
                        $result = "ldaperror";
                        error_log("LDAP - Search error $errno  (".ldap_error($ldap).")");
                    } else {

                        // Get user DN
                        $entry = ldap_first_entry($ldap, $search);
                        $userdn = ldap_get_dn($ldap, $entry);

                        if( !$userdn ) {
                            $result = "badcredentials";
                            error_log("LDAP - User $login not found");
                        } else {

                            // Get user email for notification
                            if ( $notify_on_sshkey_change ) {
                                $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
                                if ( $mailValues["count"] > 0 ) {
                                    $mail = $mailValues[0];
                                }
                            }

                            // Bind with old password
                            $bind = ldap_bind($ldap, $userdn, $password);
                            $errno = ldap_errno($ldap);
                            if ( ($errno == 49) && $ad_mode ) {
                                if ( ldap_get_option($ldap, 0x0032, $extended_error) ) {
                                    error_log("LDAP - Bind user extended_error $extended_error  (".ldap_error($ldap).")");
                                    $extended_error = explode(', ', $extended_error);
                                    if ( strpos($extended_error[2], '773') or strpos($extended_error[0], 'NT_STATUS_PASSWORD_MUST_CHANGE') ) {
                                        error_log("LDAP - Bind user password needs to be changed");
                                        $errno = 0;
                                    }
                                    if ( ( strpos($extended_error[2], '532') or strpos($extended_error[0], 'NT_STATUS_ACCOUNT_EXPIRED') ) and $ad_options['change_expired_password'] ) {
                                        error_log("LDAP - Bind user password is expired");
                                        $errno = 0;
                                    }
                                    unset($extended_error);
                                }
                            }
                            if ( $errno ) {
                                $result = "badcredentials";
                                error_log("LDAP - Bind user error $errno  (".ldap_error($ldap).")");
                            } else {

                                // Rebind as Manager if needed
                                if ( $who_change_sshkey == "manager" ) {
                                    $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
                                }

                            }}}}}

        }

        // Change sshPublicKey
        if ( $result === "" ) {
            $result = change_sshkey($ldap, $userdn, $change_sshkey_attribute, $sshkey);
        }

        if ( $result === "sshkeychanged") {
            // Notify password change
            if ($mail and $notify_on_sshkey_change) {
                $data = array( "login" => $login, "mail" => $mail, "sshkey" => $sshkey);
                if ( !send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changesshkeysubject"], $messages["changesshkeymessage"].$mail_signature, $data) ) {
                    error_log("Error while sending change email to $mail (user $login)");
                }
            }
        }

        // Render associated template
        return $this->render('changesshkey.twig', array(
            'result' => $result,
            'show_help' => $show_help,
            'login' => $login,
            'recaptcha_publickey' => $recaptcha_publickey,
            'recaptcha_theme' => $recaptcha_theme,
            'recaptcha_type' => $recaptcha_type,
            'recaptcha_size' => $recaptcha_size,
        ));
    }
}

$controller = new SshKeyController($config);
return $controller->indexAction($request);
