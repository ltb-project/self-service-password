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

# This page is called to send a reset token by mail

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = $presetLogin;
$mail = "";
$ldap = "";
$userdn = "";
$token = "";
$usermail = "";
$formtoken = "";

if (!$mail_address_use_ldap) {
    if (isset($_POST["mail"]) and $_POST["mail"]) {
        $mail = strval($_POST["mail"]);
        $usermail = strval($_POST["mail"]);
    } elseif (isset($_GET["usermail"]) and $_GET["usermail"]) {
        $usermail = strval($_GET["usermail"]);
        $result = "checkdatabeforesubmit";
    } else {
        $result = "mailrequired";
    }
}

if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = strval($_REQUEST["login"]);}
else { $result = "loginrequired";}

if ( $result === "" and ( ! isset($_REQUEST["formtoken"]) or ! $_REQUEST["formtoken"] )  ) {
    $result = "missingformtoken";
}

if (! isset($_POST["mail"]) and ! isset($_REQUEST["login"])) {

    $result = "emptysendtokenform";

    $formtoken = $sspCache->generate_form_token($cache_form_expiration);
}

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

#==============================================================================
# Check tokenform
#==============================================================================

if ( !$result ) {
    $formtoken = strval($_REQUEST["formtoken"]);
    $result = $sspCache->verify_form_token($formtoken);
}

#==============================================================================
# Check captcha
#==============================================================================
if ( ( $result === "" ) and $use_captcha) {
    $result = $captchaInstance->verify_captcha_challenge();
}

#==============================================================================
# Check mail
#==============================================================================
if ( $result === "" ) {

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

            if( !$entry ) {
                $result = $obscure_usernotfound_sendtoken ? "tokensent_ifexists" : "badcredentials";
                error_log("LDAP - User $login not found");
            } else {

                $userdn = ldap_get_dn($ldap, $entry);

                # Compare mail values
                $entry_attributes = ldap_get_attributes($ldap, $entry);
                for ($match = false, $i = 0; $i < sizeof($mail_attributes) and ! $match; $i++) {
                    $mail_attribute = $mail_attributes[$i];
                    if ( in_array($mail_attribute, $entry_attributes) ) {
                        $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
                        unset($mailValues["count"]);
                        if (! $mail_address_use_ldap) {
                            # Match with user submitted values
                            foreach ($mailValues as $mailValue) {
                                if (strcasecmp($mail_attribute, "proxyAddresses") == 0) {
                                    $mailValue = str_ireplace("smtp:", "", $mailValue);
                                }
                                if (strcasecmp($mail, $mailValue) == 0) {
                                    $match = true;
                                }
                            }
                        } else {
                            # Use first available mail address in ldap
                            $mail = \Ltb\AttributeValue::ldap_get_mail_for_notification($ldap, $entry, $mail_attributes);
                            if( $mail != "")
                                $match = true;
                        }
                    }
                }

                if (! $match) {
                    if (! $mail_address_use_ldap) {
                        $result = $obscure_usernotfound_sendtoken ? "tokensent_ifexists" : "mailnomatch";
                        error_log("Mail $mail does not match for user $login");
                    } else {
                        $result = $obscure_usernotfound_sendtoken ? "tokensent_ifexists" : "mailnomatch";
                        error_log("Mail not found for user $login");
                    }
                }
                if ($use_ratelimit) {
                    if (! allowed_rate($login, $_SERVER[$client_ip_header], $rrl_config)) {
                        $result = "throttle";
                        error_log("Mail - User $login too fast");
                    }
                }
            }
        }
    }
}

#==============================================================================
# if:
#  * this is not the first time we load this form (not emptysendtokenform), and
#  * something bad happened (bad captcha,...)
# regenerate a form token
#==============================================================================
if( $result != "emptysendtokenform" && $result != "" )
{
    $formtoken = $sspCache->generate_form_token($cache_form_expiration);
}

#==============================================================================
# Build and store token
#==============================================================================
if ( !$result ) {

    # Use cache to register token sent by mail
    $token_session_id = $sspCache->save_token(
                            [
                                'login' => $login,
                                'time' => time()
                            ],
                            null,
                            $cache_token_expiration
                        );
    if ( $crypt_tokens ) {
        $token = encrypt($token_session_id, $keyphrase);
    } else {
        $token = $token_session_id();
    }
}


#==============================================================================
# Send token by mail
#==============================================================================
if ( !$result ) {

    $reset_url .= "?action=resetbytoken&token=".urlencode($token);

    if ( !empty($reset_request_log) ) {
        error_log("Send reset URL " . ( $debug ? "$reset_url" : "HIDDEN") . "\n\n", 3, $reset_request_log);
    } else {
        error_log("Send reset URL " . ( $debug ? "$reset_url" : "HIDDEN"));
    }

    $data = array( "login" => $login, "mail" => $mail, "url" => $reset_url ) ;

    # Send message
    if ( $mailer->send_mail($mail, $mail_from, $mail_from_name, $messages["resetsubject"], $messages["resetmessage"].$mail_signature, $data) ) {
        $result = $obscure_usernotfound_sendtoken ? "tokensent_ifexists" : "tokensent";
    } else {
        $result = "tokennotsent";
        error_log("Error while sending token to $mail (user $login)");
    }
}
