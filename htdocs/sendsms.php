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

# This page is called to send random generated password to user by SMS

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = $presetLogin;
$sms = "";
$phone = "";
$smsdisplay = "";
$ldap = "";
$userdn = "";
$smstoken = "";
$token = "";
$sessiontoken = "";
$attempts = 0;


#==============================================================================
# Verify minimal information for treatment
# Encryption needs to be activated
# Login needs to be given
# By default, phone needs to be given (this can be deactivated in configuration.)
#==============================================================================
if (!$crypt_tokens) {
    $result = "crypttokensrequired";
}else{
    if (!isset($_POST["smstoken"]) and !$sms_use_ldap ) {
        if (isset($_REQUEST["phone"]) and $_REQUEST["phone"]) {
            $phone = strval($_REQUEST["phone"]);
            if ($sms_sanitize_number) {
                $phone = sanitize_number($phone);
            }
            if ($sms_truncate_number) {
                $phone = truncate_number($phone);
            }
        }else{
            $result = "smsrequired";
        }
        if (isset($_POST["login"]) and $_POST["login"]) {
            $login = strval($_REQUEST["login"]);
            $login_validity_test = check_username_validity($login,$login_forbidden_chars);
            if ($login_validity_test){
                $result = $login_validity_test;
            }
        } else {
            $login= false;
            $result = "loginrequired";
        }
        if ((!$login) and (!$phone)){
            $result = "emptysendsmsform";
        }
    }
#==============================================================================
# Crypt tokens
#==============================================================================
    elseif (isset($_REQUEST["smstoken"]) and isset($_REQUEST["token"])) {

        $token = strval($_REQUEST["token"]);
        $smstoken = strval($_REQUEST["smstoken"]);

        $tokenid = decrypt($token, $keyphrase);

        ini_set("session.use_cookies",0);
        ini_set("session.use_only_cookies",1);

        session_id($tokenid);
        session_name("smstoken");
        session_start();
        $login        = $_SESSION['login'];
        $sessiontoken = $_SESSION['smstoken'];
        $attempts     = $_SESSION['attempts'];

        if (!$login or !$sessiontoken) {
            list($result, $token) = obscure_info_sendsms("tokenattempts","tokennotvalid");
            error_log("Unable to open session $smstokenid");
        } elseif ($sessiontoken != $smstoken) {
            if ($attempts < $max_attempts) {
                $_SESSION['attempts'] = $attempts + 1;
                $result = "tokenattempts";
                error_log("SMS token $smstoken not valid, attempt $attempts");
            } else {
                $result = "tokennotvalid";
                error_log("SMS token $smstoken not valid");
            }
        } elseif (isset($token_lifetime)) {
            $tokentime = $_SESSION['time'];
            if ( time() - $tokentime > $token_lifetime ) {
                $result = "tokennotvalid";
                error_log("Token lifetime expired");
            }
        }
        if ( $result === "tokennotvalid" ) {
            $_SESSION = array();
            session_destroy();
        }
        if ( $result === "" ) {
            $_SESSION = array();
            session_destroy();
            $result = "buildtoken";
        }
    } elseif (isset($_REQUEST["encrypted_sms_login"])) {
        $decrypted_sms_login = explode(':', decrypt($_REQUEST["encrypted_sms_login"], $keyphrase));
        $login = $decrypted_sms_login[1];
        [$result, $phone] = get_mobile_and_displayname($login);
        if (!$result) { $result = "sendsms"; }
    } elseif (isset($_REQUEST["login"]) and $_REQUEST["login"] and $sms_use_ldap) {
        $login = strval($_REQUEST["login"]);
        $result = check_username_validity($login,$login_forbidden_chars);
    }else{
        $result = "emptysendsmsform";
    }
}

#==============================================================================
# Check captcha
#==============================================================================
if ( $result === "" and $use_captcha) {
        $result = global_captcha_check();
}

#==============================================================================
# Check sms
#==============================================================================
if ( $result === "" ) {
    [$result, $sms, $displayname] = get_mobile_and_displayname($login);
    if ($sms){
        if (!$sms_use_ldap) {
            $match = false;
            if (strcasecmp($sms, $phone) == 0) {
                $match = true;
                $encrypted_sms_login = encrypt("$sms:$login", $keyphrase);
                $result = "sendsms";
            }
            if (!$match){
                list($result, $token) = obscure_info_sendsms("smssent","smsnomatch");
                error_log("SMS number $phone does not match for user $login");
            }
        }else{
            $encrypted_sms_login = encrypt("$sms:$login", $keyphrase);
            $smsdisplay = $sms;
            if ( $sms_partially_hide_number ) {
                $smsdisplay = substr_replace($sms, '****', 4 , 4);
            }
            $result = "smsuserfound";
        }
        if ($use_ratelimit) {
            if ( !allowed_rate($login,$_SERVER[$client_ip_header],$rrl_config) ) {
                $result = "throttle";
                error_log("LDAP - User $login too fast");
            }
        }
    }
}


#==============================================================================
# Generate sms token and send by sms
#==============================================================================
if ($result === "sendsms") {

    # Generate sms token
    $smstoken = generate_sms_token($sms_token_length);
    # Create temporary session to avoid token replay
    ini_set("session.use_cookies",0);
    ini_set("session.use_only_cookies",1);

    session_name("smstoken");
    session_start();
    $_SESSION['login']    = $login;
    $_SESSION['smstoken'] = $smstoken;
    $_SESSION['time']     = time();
    $_SESSION['attempts'] = 0;

    $data = array( "sms_attribute" => $sms, "smsresetmessage" => $messages['smsresetmessage'], "smstoken" => $smstoken) ;

    # Send message
    if (!$sms_method) { $sms_method = "mail"; }

    if ($sms_method === "mail") {

        if (send_mail($mailer, $smsmailto, $mail_from, $mail_from_name, $smsmail_subject, $sms_message, $data)) {
            $token  = encrypt(session_id(), $keyphrase);
            $result = "smssent";
            if (!empty($reset_request_log)) {
                error_log("Send SMS code $smstoken by $sms_method to $sms\n\n", 3, $reset_request_log);
            } else {
                error_log("Send SMS code $smstoken by $sms_method to $sms");
            }
        } else {
            $result = "smsnotsent";
            error_log("Error while sending sms by $sms_method to $sms (user $login)");
        }

    }

    if ($sms_method === "api") {
        if (!$sms_api_lib) {
            $result = "smsnotsent";
            error_log('No API library found, set $sms_api_lib in configuration.');
        } else {
            include_once("../".$sms_api_lib);
            $sms_message = str_replace('{smsresetmessage}', $messages['smsresetmessage'], $sms_message);
            $sms_message = str_replace('{smstoken}', $smstoken, $sms_message);
            if (send_sms_by_api($sms, $sms_message)) {
                $token  = encrypt(session_id(), $keyphrase);
                $result = "smssent";
                if ( !empty($reset_request_log) ) {
                    error_log("Send SMS code $smstoken by $sms_method to $sms\n\n", 3, $reset_request_log);
                } else {
                    error_log("Send SMS code $smstoken by $sms_method to $sms");
                }
            } else {
                $result = "smsnotsent";
                error_log("Error while sending sms by $sms_method to $sms (user $login)");
            }
        }
    }
}

#==============================================================================
# Build and store token
#==============================================================================
if ($result === "buildtoken") {

    # Use PHP session to register token
    # We do not generate cookie
    ini_set("session.use_cookies",0);
    ini_set("session.use_only_cookies",1);

    session_name("token");
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['time']  = time();
    $_SESSION['smstoken'] = $smstoken;

    $token = encrypt(session_id(), $keyphrase);

    $result = "redirect";
}

#==============================================================================
# Redirect to resetbytoken page
#==============================================================================
if ($result === "redirect") {

    if (empty($reset_url)) {

        # Build reset by token URL
        $method = "http";
        if ( !empty($_SERVER['HTTPS']) ) { $method .= "s"; }
        $server_name = $_SERVER['SERVER_NAME'];
        $server_port = $_SERVER['SERVER_PORT'];
        $script_name = $_SERVER['SCRIPT_NAME'];

        # Force server port if non standard port
        if (   ( $method === "http"  and $server_port != "80"  )
            or ( $method === "https" and $server_port != "443" )) {
            $server_name .= ":".$server_port;
        }

        $reset_url = $method."://".$server_name.$script_name;
    }

    $reset_url .= "?action=resetbytoken&source=sms&token=".urlencode($token)."&smstoken=".urlencode($smstoken);

    if (!empty($reset_request_log)) {
        error_log("Send reset URL " . ( $debug ? "$reset_url" : "HIDDEN") . "\n\n", 3, $reset_request_log);
    } else {
        error_log("Send reset URL " . ( $debug ? "$reset_url" : "HIDDEN") );
    }

    # Redirect
    header("Location: " . $reset_url);
    exit;
}
#
#==============================================================================
# Functions
#==============================================================================
function obscure_info_sendsms($obscure_message, $real_message){
    global $token;
    global $obscure_notfound_sendsms;

    if ($obscure_notfound_sendsms){
        $result = $obscure_message;
        if ($token === ""){
            $token = create_fake_token();
        }
    } else {
        $result = $real_message;
    }
    return [$result, $token];
}

function create_fake_token(){
    global $keyphrase;
    $salt = bin2hex(random_bytes(26));
    $token = encrypt($salt, $keyphrase);
    return $token;
}

function sanitize_number($phone_number){
  $phone_number = preg_replace('/[^0-9]/', '', $phone_number);
  return $phone_number;
}

function truncate_number($phone_number){
  $phone_number = substr($phone_number, -$sms_truncate_number_length);
  return $phone_number;
}

function get_mobile_and_displayname($login) {

    $sms = "";
    $result = "";
    $displayname = "";
    global $userdn;
    global $ldap_url;
    global $ldap_starttls;
    global $ldap_binddn;
    global $ldap_bindpw;
    global $ldap_base;
    global $ldap_filter;
    global $ldap_fullname_attribute;
    global $sms_attributes;
    global $sms_sanitize_number;
    global $sms_truncate_number;
    global $obscure_notfound_sendsms;
    $search_attributes = $sms_attributes;
    $search_attributes[] = $ldap_fullname_attribute;

    # Connect to LDAP
    $ldap_connection = \Ltb\Ldap::connect($ldap_url, $ldap_starttls, $ldap_binddn, $ldap_bindpw, $ldap_network_timeout, $ldap_krb5ccname);
    $ldap = $ldap_connection[0];
    $result = $ldap_connection[1];

    if ($ldap) {

        # Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($ldap, $ldap_base, $ldap_filter, $search_attributes);

        $errno = ldap_errno($ldap);
        if ($errno) {
            $result = "ldaperror";
            error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
        } else {

            # Get user DN
            $entry = ldap_first_entry($ldap, $search);
            if($entry) {
                $userdn = ldap_get_dn($ldap, $entry);
                $displayname = ldap_get_values($ldap, $entry, $ldap_fullname_attribute);
            }
            if (!$userdn) {
                list($result, $token) = obscure_info_sendsms("smssent","badcredentials");
                error_log("LDAP - User $login not found");
            } else {
                # Get first sms number for configured ldap attributes in sms_attributes.
                $smsValue = \Ltb\AttributeValue::ldap_get_first_available_value($ldap, $entry, $sms_attributes);
                # Check sms number
                if ($smsValue) {
                    $sms = $smsValue->value;
                    if ( $sms_sanitize_number ) {
                        $sms = sanitize_number($sms);
                    }
                    if ($sms_truncate_number) {
                        $sms = truncate_number($sms);
                    }
                }else{
                    list($result, $token) = obscure_info_sendsms("smssent","smsnonumber");
                    error_log("No SMS number found for user $login");
                }
            }
         }
    }
    return [$result, $sms, $displayname];
}
