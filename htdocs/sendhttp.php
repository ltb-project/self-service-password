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

# This page is called to send a reset token by http

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = $presetLogin;
$ldap = "";
$userdn = "";
$token = "";
$usermail = "";
$captchaphrase = "";

if (isset($_REQUEST["login"]) and $_REQUEST["login"]) {
    $login = strval($_REQUEST["login"]);
    if (isset($_POST["mail"]) and $_POST["mail"]) {
        $usermail = strval($_POST["mail"]);
    } else if (isset($_REQUEST["usermail"]) and $_REQUEST["usermail"]) {
        $usermail = strval($_REQUEST["usermail"]);
    } else {
        $result = "mailrequired";
    }
} else {
    $result = "emptysendhttpform";
}
if ($use_captcha) {
    if (isset($_POST["captchaphrase"]) and $_POST["captchaphrase"]) {
        $captchaphrase = strval($_POST["captchaphrase"]);
    } else {
        $result = "captcharequired";
    }
}
if (strncmp($http_notifications_address, 'http', 4) !== 0) {
    $result = "httpnotificationmissingconfiguration";
}

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

#==============================================================================
# Check captcha
#==============================================================================
if ( $result === "" && $use_captcha ) {
    session_start();
    if ( !check_captcha($_SESSION['phrase'], $captchaphrase) ) {
        $result = "badcaptcha";
    }
    unset($_SESSION['phrase']);
}

#==============================================================================
# Check mail
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

                if (! $userdn) {
                    $result = "badcredentials";
                    error_log("LDAP - User $login not found");
                } else {

                    # Compare mail values
                    $match = false;
                    for ($i = 0; $match != true && $i < sizeof($mail_attributes); $i++) {
                        $mail_attribute = $mail_attributes[0];
                        $mailValues = ldap_get_values($ldap, $entry, $mail_attribute);
                        unset($mailValues["count"]);

                        # Match with user submitted values
                        foreach ($mailValues as $mailValue) {
                            if (strcasecmp($mail_attribute, "proxyAddresses") == 0) {
                                $mailValue = str_ireplace("smtp:", "", $mailValue);
                            }
                            if (strcasecmp($usermail, $mailValue) == 0) {
                                $match = true;
                                break;
                            }
                        }
                    }

                    if (! $match) {
                        $result = "mailnomatch";
                        error_log("Mail $mail does not match for user $login");
                    }
                    if ($use_ratelimit) {
                        if ( ! allowed_rate($login,$_SERVER[$client_ip_header],$rrl_config) ) {
                            $result = "throttle";
                            error_log("Mail - User $login too fast");
                        }
                    }
                }
            }
        }
    }
}

#==============================================================================
# Build and store token
#==============================================================================
if ( $result === "" ) {

    # Use PHP session to register token
    # We do not generate cookie
    ini_set("session.use_cookies",0);
    ini_set("session.use_only_cookies",1);

    session_name("token");
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['time']  = time();

    if ( $crypt_tokens ) {
        $token = encrypt(session_id(), $keyphrase);
    } else {
        $token = session_id();
    }

}

#==============================================================================
# Send token by http
#==============================================================================
if ( $result === "" ) {

    if ( empty($reset_url) ) {

        # Build reset by token URL
        $method = "http";
        if ( !empty($_SERVER['HTTPS']) ) { $method .= "s"; }
        $server_name = $_SERVER['SERVER_NAME'];
        $server_port = $_SERVER['SERVER_PORT'];
        $script_name = $_SERVER['SCRIPT_NAME'];

        # Force server port if non standard port
        if (   ( $method === "http"  and $server_port != "80"  )
            or ( $method === "https" and $server_port != "443" )
        ) {
            $server_name .= ":".$server_port;
        }

        $reset_url = $method."://".$server_name.$script_name;
    }

    $reset_url .= "?action=resetbytoken&source=http&token=".urlencode($token);

    if ( !empty($reset_request_log) ) {
        error_log("Send reset URL " . ( $debug ? "$reset_url" : "HIDDEN") . "\n\n", 3, $reset_request_log);
    } else {
        error_log("Send reset URL " . ( $debug ? "$reset_url" : "HIDDEN"));
    }

    $data = array( "login" => $login, "mail" => $usermail, "url" => $reset_url ) ;
    $httpoptions = array(
            "address" => $http_notifications_address,
            "body"    => $http_notifications_body,
            "headers" => $http_notifications_headers,
            "method"  => $http_notifications_method,
            "params"  => $http_notifications_params
        );

    # Send notification
    if ( send_http($httpoptions, $messages["resetmessage"], $data) ) {
        $result = "httpsent";
    } else {
        $result = "httpnotsent";
        error_log("Error while sending token to $login");
    }
}