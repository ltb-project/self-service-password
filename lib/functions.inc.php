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

/*
  Pre-requisites: install zxcvbn library

  Make sure to have this in composer.json:

    "require": {
        "bjeavons/zxcvbn-php": "^1.0"
    }

  and run: composer update

*/

require_once __DIR__ . '/../vendor/autoload.php';

# Generate SMS token
function generate_sms_token( $sms_token_length ) {
    $Range = explode(',', '48-57');
    $NumRanges = count($Range);
    $smstoken = '';
    for ($i = 1; $i <= $sms_token_length; $i++){
        $r = random_int(0, $NumRanges-1);
        list($min, $max) = explode('-', $Range[$r]);
        $smstoken .= chr(random_int($min, $max));
    }
    return $smstoken;
}

# Get message criticity
function get_criticity( $msg ) {

    if ( preg_match( "/nophpldap|phpupgraderequired|nophpmhash|nokeyphrase|ldaperror|nomatch|badcredentials|passworderror|tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|answermoderror|answernomatch|mailnomatch|tokennotsent|tokennotvalid|notcomplex|smsnonumber|smscrypttokensrequired|nophpmbstring|nophpxml|smsnotsent|sameaslogin|pwned|invalidsshkey|sshkeyerror|specialatends|forbiddenwords|forbiddenldapfields|diffminchars|badquality|tooyoung|inhistory|throttle|attributesmoderror|insufficiententropy|noreseturl|nocrypttokens|smsnomatch|unknowncustompwdfield|sameascustompwd|missingformtoken|invalidformtoken/" , $msg ) ) {
    return "danger";
    }

    if ( preg_match( "/(login|oldpassword|newpassword|confirmpassword|answer|question|password|mail|sms|token|sshkey|captcha)required|badcaptcha|tokenattempts|checkdatabeforesubmit/" , $msg ) ) {
        return "warning";
    }

    return "success";
}

# Get FontAwesome class icon
function get_fa_class( $msg) {

    $criticity = get_criticity( $msg );

    if ( $criticity === "danger" ) { return "fa-exclamation-circle"; }
    if ( $criticity === "warning" ) { return "fa-exclamation-triangle"; }
    if ( $criticity === "success" ) { return "fa-check-square"; }

}

# Change password
# @return result code
function change_password( $ldapInstance, $dn, $password, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword, $use_exop_passwd, $use_ppolicy_control, $custom_pwd_field_mode, $custom_pwd_attribute ) {

    $result = "";
    $error_code = "";
    $error_msg = "";
    $ppolicy_error_code = false;

    $time = time();
    $userdata = [];

    if ( $custom_pwd_field_mode ) {
        $pwd_attribute = $custom_pwd_attribute;
    } else {
        $pwd_attribute = "userPassword";
    }

    # Set Samba password value
    if ( $samba_mode ) {
        $userdata = \Ltb\Password::set_samba_data($userdata, $samba_options, $password, $time);
    }

    if (!$ad_mode && !$use_exop_passwd) {
        if ($hash === "auto") {
            $old_password_hashed = $ldapInstance->get_password_value($dn, "userPassword");
            $hash = \Ltb\Password::get_hash_type($old_password_hashed);
        }
        $password = \Ltb\Password::make_password($password, $hash, $hash_options);
    } elseif ($ad_mode) {
        $password = \Ltb\Password::make_ad_password($password);
    }

    # Set password value
    if ( $ad_mode ) {
        $userdata = \Ltb\Password::set_ad_data($userdata, $ad_options, $password);
    }

    $userdata = \Ltb\Password::set_shadow_data($userdata, $shadow_options, $time);

    # Commit modification on directory

    # Special case: AD mode with password changed as user
    if ( $ad_mode and $who_change_password === "user" ) {
        list($error_code, $error_msg) = $ldapInstance->change_ad_password_as_user($dn, $oldpassword, $password);
    } elseif ($use_exop_passwd) {
        list($error_code, $error_msg, $ppolicy_error_code) = $ldapInstance->change_password_with_exop($dn, $oldpassword, $password, $use_ppolicy_control);
        if( $error_code == 0 )
        {
            list($error_code, $error_msg) = $ldapInstance->modify_attributes($dn, $userdata);
        }
    } else {
        # Else just replace with new password
        if (!$ad_mode) {
            $userdata[$pwd_attribute] = $password;
        }
        if ( $use_ppolicy_control ) {
            list($error_code, $error_msg, $ppolicy_error_code) = $ldapInstance->modify_attributes_using_ppolicy($dn, $userdata);
        } else {
            list($error_code, $error_msg) = $ldapInstance->modify_attributes($dn, $userdata);
        }
    }

    if ( !isset($error_code) ) {
        $result = "ldaperror";
    } elseif ( $error_code > 0 ) {
        $result = "passworderror";
        error_log("LDAP - Modify password error $error_code ($error_msg)");
        if ( $ppolicy_error_code != false && $ppolicy_error_code > 4 ) { 
            $result = \Ltb\Ldap::PPOLICY_ERROR_CODE_TO_RESULT_MAPPER[$ppolicy_error_code]; 
        }
    } else {
        $result = "passwordchanged";
    }

    return $result;
}

/* @function check_sshkey(string $sshkey, array $valid_types)
 * Verifies sshPublicKey is valid
 * @param string $sshkey Publich SSH Keys
 * @param array $valid_types List of valid SSH Key types
 * @return boolean
 */
function check_sshkey ( $sshkey, $valid_types ) {

    $keys = preg_split('/\n|\r\n?/', $sshkey);
    $found = 0;
    for ($c = 0; $c < count($keys); $c++) {
        if (preg_match('/^[ \t]*$/', $keys[$c])) {
            continue;
        }
        $key_parts = preg_split('/[\s]+/', $keys[$c]);

        if (count($key_parts) < 2) {
            return false;
        }

        $algorithm = $key_parts[0];
        if (count($valid_types) > 0) {
            if (! in_array($algorithm, $valid_types)) {
                return false;
            }
        }

        $key = $key_parts[1];
        $key_base64_decoded = base64_decode($key, true);
        if ($key_base64_decoded == FALSE) {
            return false;
        }

        $ealg = base64_encode($algorithm . " AAAA");
        $check = preg_replace('/[\x00-\x1F\x7F]/u', '', base64_decode(substr($key, 0, strlen($ealg))));
        if ((string) $check !== (string) $algorithm) {
            return false;
        }
        $found++;
    }

    return $found > 0 ? true : false;
}

# Change sshPublicKey attribute
# @return result code
function change_sshkey( $ldap, $dn, $objectClass, $attribute, $sshkey ) {

    $result = "";
    $keys = preg_split('/\n|\r\n?/', $sshkey);
    $userdata[$attribute] = $keys[0];

    # check for required objectclass, if configured
    if ($objectClass !== "") {
        # Check objectClass presence and pull back previous answers.
        $search = ldap_search($ldap, $dn, "(objectClass=*)", array("objectClass") );

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

            if (! in_array( $objectClass, $ocValues ) ) {
                # Answer objectClass is not present, add it
                array_push($ocValues, $objectClass );
                $ocValues = array_values( $ocValues );
                $userdata["objectClass"] = $ocValues;
            }
        }
    }

    # Commit modification on directory
    $replace = ldap_mod_replace($ldap, $dn, $userdata);

    $errno = ldap_errno($ldap);

    if ( $errno ) {
        $result = "sshkeyerror";
        error_log("LDAP - Modify $attribute error $errno (".ldap_error($ldap).")");
    } else {
        for ($c = 1; $c < count($keys); $c++) {
            if (preg_match('/^[ \t]*$/', $keys[$c])) {
                continue;
            }
            $userdata[$attribute] = $keys[$c];
            $add = ldap_mod_add($ldap, $dn, $userdata);
            $errno = ldap_errno($ldap);
            if ( $errno ) {
                $result = "sshkeyerror";
                error_log("LDAP - Modify $attribute error $errno (".ldap_error($ldap).")");
                break;
            }
        }
        if ($result === "") {
            $result = "sshkeychanged";
        }
    }

    return $result;
}


/* @function encrypt(string $data)
 * Encrypt a data
 * @param string $data Data to encrypt
 * @param string $keyphrase Password for encryption
 * @return string Encrypted data, base64 encoded
 */
function encrypt($data, $keyphrase) {
    return base64_encode(\Defuse\Crypto\Crypto::encryptWithPassword($data, $keyphrase, true));
}

/* @function decrypt(string $data)
 * Decrypt a data
 * @param string $data Encrypted data, base64 encoded
 * @param string $keyphrase Password for decryption
 * @return string Decrypted data
 */
function decrypt($data, $keyphrase) {
    try {
        return \Defuse\Crypto\Crypto::decryptWithPassword(base64_decode($data), $keyphrase, true);
    } catch (\Defuse\Crypto\Exception\CryptoException $e) {
        error_log("crypto: decryption error " . $e->getMessage());
        return '';
    }
}


/* @function string str_putcsv(array $fields[, string $delimiter = ','[, string $enclosure = '"'[, string $escape_char = '\\']]])
 * Convert array to CSV line. Based on https://gist.github.com/johanmeiring/2894568 and https://bugs.php.net/bug.php?id=64183#1506521511
 * Wrapped in `if(!function_exists(...` in case it gets added to PHP.
 * Also see https://www.php.net/manual/en/function.fgetcsv.php and related
 * @param string $fields An array of strings
 * @param string $delimiter field delimiter (one character only)
 * @param string $enclosure field enclosure (one character only)
 * @param string $escape_char escape character (at most one character) - empty string ("") disables escape mechanism
 * @return string fields in CSV format
 */
if(!function_exists('str_putcsv'))
{
    function str_putcsv($fields, $delimiter = ',', $enclosure = '"', $escape_char = '\\')
    {
        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, $fields, $delimiter, $enclosure, $escape_char);
        rewind($fp);
        $data = stream_get_contents($fp);
        fclose($fp);
        return rtrim($data, "\n");
    }
}


/* @function boolean send_mail(PHPMailer $mailer, string $mail, string $mail_from, string $subject, string $body, array $data)
 * Send a mail, replace strings in body
 * @param mailer PHPMailer object
 * @param mail Destination
 * @param mail_from Sender
 * @param subject Subject
 * @param body Body
 * @param data Data for string replacement
 * @return result
 */
function send_mail($mailer, $mail, $mail_from, $mail_from_name, $subject, $body, $data) {

    $result = false;

    if (!is_a($mailer, 'PHPMailer\PHPMailer\PHPMailer')) {
        error_log("send_mail: PHPMailer object required!");
        return $result;
    }

    if (!$mail) {
        error_log("send_mail: no mail given, exiting...");
        return $result;
    }

    /* Replace data in mail, subject and body */
    foreach ($data as $key => $value ) {
        $mail = str_replace('{'.$key.'}', $value, $mail);
        $mail_from = str_replace('{'.$key.'}', $value, $mail_from);
        $subject = str_replace('{'.$key.'}', $value, $subject);
        $body = str_replace('{'.$key.'}', $value, $body);
    }

    $mailer->setFrom($mail_from, $mail_from_name);
    $mailer->addReplyTo($mail_from, $mail_from_name);
    $mailer->addAddress($mail);
    $mailer->Subject = $subject;
    $mailer->Body = $body;

    $result = $mailer->send();

    if (!$result) {
        error_log("send_mail: ".$mailer->ErrorInfo);
    }

    return $result;

}

/* @function string check_username_validity(string $username, string $login_forbidden_chars)
 * Check the user name against a regex or internal ctype_alnum() call to make sure the username doesn't contain
 * predetermined bad values, like an '*' can allow an attacker to 'test' to find valid usernames.
 * @param username the user name to test against
 * @param optional login_forbidden_chars invalid characters
 * @return $result
 */
function check_username_validity($username,$login_forbidden_chars) {
    $result = "";

    if (!$login_forbidden_chars) {
        if (!ctype_alnum($username)) {
            $result = "badcredentials";
            error_log("Non alphanumeric characters in username $username");
        }
    } else {
        preg_match_all("/[$login_forbidden_chars]/", $username, $forbidden_res);
        if (count($forbidden_res[0])) {
            $result = "badcredentials";
            error_log("Illegal characters in username $username (list of forbidden characters: $login_forbidden_chars)");
        }
    }

    return $result;
}

/* @function string hook_command(string $hook, string  $login, string $newpassword, null|string $oldpassword, null|boolean $hook_password_encodebase64)
   Creates the command line to execute for the prehook/posthook process. Passwords will be base64 encoded if configured. Base64 encoding will prevent passwords with special
   characters to be modified by the escapeshellarg() function.
   @param $hook string script/command to execute for procesing hook data
   @param $login string username to change/set password for
   @param $newpassword string new passwword for given login
   @param $oldpassword string old password for given login
   @param hook_password_encodebase64 boolean set to true if passwords are to be converted to base64 encoded strings
*/
function hook_command($hook, $login, $newpassword, $oldpassword = null, $hook_password_encodebase64 = false) {

    $command = '';
    if ( isset($hook_password_encodebase64) && $hook_password_encodebase64 ) {
        $command = escapeshellcmd($hook).' '.escapeshellarg($login).' '.base64_encode($newpassword);

        if ( ! is_null($oldpassword) ) {
            $command .= ' '.base64_encode($oldpassword);
        }

    } else {
        $command = escapeshellcmd($hook).' '.escapeshellarg($login).' '.escapeshellarg($newpassword);

        if ( ! is_null($oldpassword) ) {
            $command .= ' '.escapeshellarg($oldpassword);
        }
    }
    return $command;
}

/* read $rrldb as a json array and update key matching $selector
   with now timestamp
   and keep other timestamps if in per_time timeframe then persist it
   return count of timestamps records
*/
function updatedb_selector_count($rrldb,$selector,$per_time,$now,$wouldblock) {
    if (!file_exists($rrldb)) {
        file_put_contents($rrldb,"{}");
    }
    $dbfh = fopen($rrldb . ".lock","w");
    if (!$dbfh) { throw new Exception('nowrite to '.$rrldb); }
    flock($dbfh,LOCK_EX,$fblock);
    $arraycontent = (array) json_decode(file_get_contents($rrldb));
    $atts = [$now];
    if (array_key_exists($selector,$arraycontent)) {
        foreach ($arraycontent[$selector] as $when) {
            if ( $when > ($now - $per_time) ) {
                array_push($atts,$when);
            }
        }
    }
    $arraycontent[$selector] = $atts;
    file_put_contents($rrldb,json_encode($arraycontent));
    flock($dbfh,LOCK_UN);
    return count($atts);
}

# handle non numeric value like 'infinite'
function parse_rate_max($attribute_value,$default)
{
    if ( is_numeric($attribute_value) )
    {
        return $attribute_value;
    }
    elseif ( $attribute_value === 'infinite' )
    {
        return 0;
    }
    return $default;
}
/* function allowed_rate(string $login, string $ip_addr, array $rrl_config)
 * Check if this login / this IP reached the limit fixed
 * apply specific paramters based on ip_addr if filter_by_ip file was configured
 * @return bool allowed
 */
function allowed_rate($login,$ip_addr,$rrl_config) {
    $now = time();
    $fblock=1;

    $max_per_user = $rrl_config["max_per_user"];
    $max_per_ip = $rrl_config["max_per_ip"];
    $per_time = $rrl_config["per_time"];

    if ($rrl_config["filter_by_ip"]) {
        $arraycontent = (array) json_decode(file_get_contents($rrl_config["filter_by_ip"]));
        if (array_key_exists($ip_addr,$arraycontent)) {
            $filter_by_ip= (array) $arraycontent[$ip_addr];
            if (array_key_exists("max_per_user",$filter_by_ip)) {
                $max_per_user = parse_rate_max($filter_by_ip["max_per_user"],$max_per_user);
            }
            if (array_key_exists("max_per_ip",$filter_by_ip)) {
                $max_per_ip = parse_rate_max($filter_by_ip["max_per_ip"],$max_per_ip);
            }
            if (array_key_exists("per_time",$filter_by_ip)) {
                $per_time = parse_rate_max($filter_by_ip["per_time"],$per_time);
            }
            if ( $per_time == 0 )
            {
                return true;
            }
        }
    }

    if ($max_per_user > 0) {
        $count =  updatedb_selector_count( $rrl_config["dbdir"] . "/ssp_rrl_users.json",$login,$per_time,$now,$fblock);
        if ($count > $max_per_user) {
            return false;
        }
    }
    if ($max_per_ip > 0) {
        $count =  updatedb_selector_count( $rrl_config["dbdir"] . "/ssp_rrl_ips.json",$ip_addr,$per_time,$now,$fblock);
        if ($count > $max_per_ip) {
            return false;
        }
    }
    return true;
}
