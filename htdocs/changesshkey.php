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

require_once("../lib/LtbAttributeValue_class.php");

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = $presetLogin;
$password = "";
$sshkey = "";
$ldap = "";
$userdn = "";
$mail = "";

if (isset($_POST["password"]) and $_POST["password"]) { $password = strval($_POST["password"]); }
else { $result = "passwordrequired"; }
if (isset($_POST["sshkey"]) and $_POST["sshkey"]) {
    $sshkey = strval($_POST["sshkey"]);
    if (! check_sshkey($sshkey, $ssh_valid_key_types)) { $result = "invalidsshkey"; }
} else { $result = "sshkeyrequired"; }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = strval($_REQUEST["login"]); }
else { $result = "loginrequired"; }
if (! isset($_REQUEST["login"]) and ! isset($_POST["password"]) and ! isset($_POST["sshkey"])) {
    $result = "emptysshkeychangeform";
}

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
                error_log("LDAP - Search error $errno  (".ldap_error($ldap).")");
            } else {

                # Get user DN
                $entry = ldap_first_entry($ldap, $search);
                $userdn = ldap_get_dn($ldap, $entry);

                if ( !$userdn ) {
                    $result = "badcredentials";
                    error_log("LDAP - User $login not found");
                } else {

                    # Get user email for notification
                    if ($notify_on_sshkey_change) {
                        $mail = (new LtbAttributeValue(null,null))->ldap_get_mail_for_notification($ldap, $entry);
                    }

                    # Confirm user credentials are valid
                    $bind = ldap_bind($ldap, $userdn, $password);
                    if ( !$bind ) {
                        $result = "badcredentials";
                        $errno = ldap_errno($ldap);
                        if ( $errno ) {
                           error_log("LDAP - Bind user error $errno  (".ldap_error($ldap).")");
                        }
                    } else {

                        # Rebind as Manager if needed
                        if ( $who_change_sshkey == "manager" ) {
                            $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
                        }
                    }
                }
            }

            if ( $use_ratelimit ) {
                if ( ! allowed_rate($login,$_SERVER[$client_ip_header],$rrl_config) ) {
                    $result = "throttle";
                    error_log("LDAP - User $login too fast");
                }
            }

        }
    }
}

#==============================================================================
# Change sshPublicKey
#==============================================================================
if ( $result === "" ) {
    $result = change_sshkey($ldap, $userdn, $change_sshkey_objectClass, $change_sshkey_attribute, $sshkey);
}

#==============================================================================
# Notify SSH Key change
#==============================================================================
if ($result === "sshkeychanged") {
    if ($mail and $notify_on_sshkey_change) {
        $data = array( "login" => $login, "mail" => $mail, "sshkey" => $sshkey);
        if (! send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["changesshkeysubject"], $messages["changesshkeymessage"].$mail_signature, $data)) {
            error_log("Error while sending change email to $mail (user $login)");
        }
    }
}
