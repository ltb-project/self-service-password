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

# Create SSHA password
function make_ssha_password($password) {
    mt_srand((double)microtime()*1000000);
    $salt = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
    $hash = "{SSHA}" . base64_encode(pack("H*", sha1($password . $salt)) . $salt);
    return $hash;
}

# Create SHA password
function make_sha_password($password) {
    $hash = "{SHA}" . base64_encode(pack("H*", sha1($password)));
    return $hash;
}

# Create SMD5 password
function make_smd5_password($password) {
    mt_srand((double)microtime()*1000000);
    $salt = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
    $hash = "{SMD5}" . base64_encode(pack("H*", md5($password . $salt)) . $salt);
    return $hash;
}

# Create MD5 password
function make_md5_password($password) {
    $hash = "{MD5}" . base64_encode(pack("H*", md5($password)));
    return $hash;
}

# Create CRYPT password
function make_crypt_password($password, $hash_options) {

    // Generate salt
    $possible = '0123456789'.
		'abcdefghijklmnopqrstuvwxyz'.
		'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.
		'./';
    $salt = "";

    mt_srand((double)microtime() * 1000000);

    while( strlen( $salt ) < 2 ) {
        $salt .= substr( $possible, ( rand() % strlen( $possible ) ), 1 );
    }

    if ( isset($hash_options['crypt_salt_prefix']) ) {
        $salt = $hash_options['crypt_salt_prefix'] . $salt;
    }

    $hash = '{CRYPT}' . crypt( $password,  $salt);
    return $hash;
}

# Create MD4 password (Microsoft NT password format)
function make_md4_password($password) {
    if (function_exists('hash')) {
        $hash = strtoupper( hash( "md4", iconv( "UTF-8", "UTF-16LE", $password ) ) );
    } else {
        $hash = strtoupper( bin2hex( mhash( MHASH_MD4, iconv( "UTF-8", "UTF-16LE", $password ) ) ) );
    }
    return $hash;
}

# Create AD password (Microsoft Active Directory password format)
function make_ad_password($password) {
    $password = "\"" . $password . "\"";
    $adpassword = mb_convert_encoding($password, "UTF-16LE", "UTF-8");
    return $adpassword;
}

# Generate SMS token
function generate_sms_token( $sms_token_length ) {
    $Range=explode(',','48-57');
    $NumRanges=count($Range);
    $smstoken='';
    for ($i = 1; $i <= $sms_token_length; $i++){
        $r=mt_rand(0,$NumRanges-1);
        list($min,$max)=explode('-',$Range[$r]);
        $smstoken.=chr(mt_rand($min,$max));
    }
    return $smstoken;
}

# Strip slashes added by PHP
# Only if magic_quote_gpc is not set to off in php.ini
function stripslashes_if_gpc_magic_quotes( $string ) {
    if(get_magic_quotes_gpc()) {
        return stripslashes($string);
    } else {
        return $string;
    }
}

# Get message criticity
function get_criticity( $msg ) {

    if ( preg_match( "/nophpldap|nophpmhash|ldaperror|nomatch|badcredentials|passworderror|tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|answermoderror|answernomatch|mailnomatch|tokennotsent|tokennotvalid|notcomplex|nophpmcrypt|smsnonumber|smscrypttokensrequired|nophpmbstring|smsnotsent|sameaslogin/" , $msg ) ) {
    return "danger";
    }
	
    if ( preg_match( "/(login|oldpassword|newpassword|confirmpassword|answer|question|password|mail|token)required|badcaptcha|tokenattempts/" , $msg ) ) {
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

# Display policy bloc
# @return HTML code
function show_policy( $messages, $pwd_policy_config, $result ) {
    extract( $pwd_policy_config );
    
    # Should we display it?
    if ( !$pwd_show_policy or $pwd_show_policy === "never" ) { return; }
    if ( $pwd_show_policy === "onerror" ) {
        if ( !preg_match( "/tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|notcomplex|sameaslogin/" , $result) ) { return; }
    }

    # Display bloc
    echo "<div class=\"help alert alert-warning\">\n";
    echo "<p>".$messages["policy"]."</p>\n";
    echo "<ul>\n";
    if ( $pwd_min_length      ) { echo "<li>".$messages["policyminlength"]      ." $pwd_min_length</li>\n"; }
    if ( $pwd_max_length      ) { echo "<li>".$messages["policymaxlength"]      ." $pwd_max_length</li>\n"; }
    if ( $pwd_min_lower       ) { echo "<li>".$messages["policyminlower"]       ." $pwd_min_lower</li>\n"; }
    if ( $pwd_min_upper       ) { echo "<li>".$messages["policyminupper"]       ." $pwd_min_upper</li>\n"; }
    if ( $pwd_min_digit       ) { echo "<li>".$messages["policymindigit"]       ." $pwd_min_digit</li>\n"; }
    if ( $pwd_min_special     ) { echo "<li>".$messages["policyminspecial"]     ." $pwd_min_special</li>\n"; }
    if ( $pwd_complexity      ) { echo "<li>".$messages["policycomplex"]        ." $pwd_complexity</li>\n"; }
    if ( $pwd_forbidden_chars ) { echo "<li>".$messages["policyforbiddenchars"] ." $pwd_forbidden_chars</li>\n"; }
    if ( $pwd_no_reuse        ) { echo "<li>".$messages["policynoreuse"]                                 ."\n"; }
    if ( $pwd_diff_login      ) { echo "<li>".$messages["policydifflogin"]                               ."\n"; }
    echo "</ul>\n";
    echo "</div>\n";
}

# Check password strength
# @return result code
function check_password_strength( $password, $oldpassword, $pwd_policy_config, $login ) {
    extract( $pwd_policy_config );
    
    $result = "";

    $length = strlen(utf8_decode($password));
    preg_match_all("/[a-z]/", $password, $lower_res);
    $lower = count( $lower_res[0] );
    preg_match_all("/[A-Z]/", $password, $upper_res);
    $upper = count( $upper_res[0] );
    preg_match_all("/[0-9]/", $password, $digit_res);
    $digit = count( $digit_res[0] );

    $special = 0;
    if ( isset($pwd_special_chars) && !empty($pwd_special_chars) ) {
        preg_match_all("/[$pwd_special_chars]/", $password, $special_res);
        $special = count( $special_res[0] );
    }

    $forbidden = 0;
    if ( isset($pwd_forbidden_chars) && !empty($pwd_forbidden_chars) ) {
        preg_match_all("/[$pwd_forbidden_chars]/", $password, $forbidden_res);
        $forbidden = count( $forbidden_res[0] );
    }

    # Complexity: checks for lower, upper, special, digits
    if ( $pwd_complexity ) {
        $complex = 0;
        if ( $special > 0 ) { $complex++; }
        if ( $digit > 0 ) { $complex++; }
        if ( $lower > 0 ) { $complex++; }
        if ( $upper > 0 ) { $complex++; }
        if ( $complex < $pwd_complexity ) { $result="notcomplex"; }
    }

    # Minimal lenght
    if ( $pwd_min_length and $length < $pwd_min_length ) { $result="tooshort"; }

    # Maximal lenght
    if ( $pwd_max_length and $length > $pwd_max_length ) { $result="toobig"; }

    # Minimal lower chars
    if ( $pwd_min_lower and $lower < $pwd_min_lower ) { $result="minlower"; }

    # Minimal upper chars
    if ( $pwd_min_upper and $upper < $pwd_min_upper ) { $result="minupper"; }

    # Minimal digit chars
    if ( $pwd_min_digit and $digit < $pwd_min_digit ) { $result="mindigit"; }

    # Minimal special chars
    if ( $pwd_min_special and $special < $pwd_min_special ) { $result="minspecial"; }

    # Forbidden chars
    if ( $forbidden > 0 ) { $result="forbiddenchars"; }

    # Same as old password?
    if ( $pwd_no_reuse and $password === $oldpassword ) { $result="sameasold"; }

    # Same as login?
    if ( $pwd_diff_login and $password === $login ) { $result="sameaslogin"; }

    return $result;
}

# Change password
# @return result code
function change_password( $ldap, $dn, $password, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword ) {

    $result = "";

    $time = time();

    # Set Samba password value
    if ( $samba_mode ) {
        $userdata["sambaNTPassword"] = make_md4_password($password);
        $userdata["sambaPwdLastSet"] = $time;
        if ( isset($samba_options['min_age']) && $samba_options['min_age'] > 0 ) {
             $userdata["sambaPwdCanChange"] = $time + ( $samba_options['min_age'] * 86400 );
        }
        if ( isset($samba_options['max_age']) && $samba_options['max_age'] > 0 ) {
             $userdata["sambaPwdMustChange"] = $time + ( $samba_options['max_age'] * 86400 );
        }
    }

    # Get hash type if hash is set to auto
    if ( !$ad_mode && $hash == "auto" ) {
        $search_userpassword = ldap_read( $ldap, $dn, "(objectClass=*)", array("userPassword") );
        if ( $search_userpassword ) {
            $userpassword = ldap_get_values($ldap, ldap_first_entry($ldap,$search_userpassword), "userPassword");
            if ( isset($userpassword) ) {
                if ( preg_match( '/^\{(\w+)\}/', $userpassword[0], $matches ) ) {
                    $hash = strtoupper($matches[1]);
		}
            }
        }
    }

    # Transform password value
    if ( $ad_mode ) {
        $password = make_ad_password($password);
    } else {
        # Hash password if needed
        if ( $hash == "SSHA" ) {
            $password = make_ssha_password($password);
        }
        if ( $hash == "SHA" ) {
            $password = make_sha_password($password);
        }
        if ( $hash == "SMD5" ) {
            $password = make_smd5_password($password);
        }
        if ( $hash == "MD5" ) {
            $password = make_md5_password($password);
        }
        if ( $hash == "CRYPT" ) {
            $password = make_crypt_password($password, $hash_options);
        }
    }

    # Set password value
    if ( $ad_mode ) {
        $userdata["unicodePwd"] = $password;
        if ( $ad_options['force_unlock'] ) {
            $userdata["lockoutTime"] = 0;
        }
        if ( $ad_options['force_pwd_change'] ) {
            $userdata["pwdLastSet"] = 0;
        }
    } else {
        $userdata["userPassword"] = $password;
    }

    # Shadow options
    if ( $shadow_options['update_shadowLastChange'] ) {
        $userdata["shadowLastChange"] = floor($time / 86400);
    }

    # Commit modification on directory
    
    # Special case: AD mode with password changed as user
    if ( $ad_mode and $who_change_password === "user" ) {
        # The AD password change procedure is modifying the attribute unicodePwd by
        # first deleting unicodePwd with the old password and them adding it with the
        # the new password
        $oldpassword = make_ad_password($oldpassword);

        $modifications = array(
            array(
                "attrib" => "unicodePwd",
                "modtype" => LDAP_MODIFY_BATCH_REMOVE,
                "values" => array($oldpassword),
            ),
            array(
                "attrib" => "unicodePwd",
                "modtype" => LDAP_MODIFY_BATCH_ADD,
                "values" => array($password),
            ),
        );

        $bmod = ldap_modify_batch($ldap, $dn, $modifications);
    } else {
        # Else just replace with new password
        $replace = ldap_mod_replace($ldap, $dn, $userdata);
    }

    $errno = ldap_errno($ldap);

    if ( $errno ) {
        $result = "passworderror";
        error_log("LDAP - Modify password error $errno (".ldap_error($ldap).")");
    } else {
        $result = "passwordchanged";
    }

    return $result;
}

/* @function encrypt(string $data)
 * Encrypt a data
 * @param data
 * @return encrypted data
 * @author Matthias Ganzinger
 */ 
function encrypt($data, $keyphrase) {

    /* Open the cipher (AES-256)*/
    $td = mcrypt_module_open('rijndael-256', '', 'ofb', '');

    /* Create the IV and determine the keysize length, use MCRYPT_RAND
     * on Windows instead */
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM);
    $ks = mcrypt_enc_get_key_size($td);

    /* Create key */
    $key = substr(md5($keyphrase), 0, $ks);

    /* Intialize encryption */
    mcrypt_generic_init($td, $key, $iv);

    /* Encrypt data */
    $encrypted = mcrypt_generic($td, $data);

    /* Terminate encryption handler */
    mcrypt_generic_deinit($td);

    /* Terminate decryption handle and close module */
    mcrypt_module_close($td);

    /* base64 encode iv and message */
    $iv = base64_encode($iv);
    $encrypted = base64_encode($encrypted);

    /* return data nn:ivencrypted */
    return strlen($iv). ":" . $iv . $encrypted;
}


/* @function decrypt(string $data)
 * Decrypt a data
 * @param data
 * @return decrypted data
 * @author Matthias Ganzinger
 */
function decrypt($data, $keyphrase) {

    /* replace spaces with +, otherwise base64_decode will fail */
    $data = str_replace(" ", "+", $data);

    /* get iv */
    $ivcount = substr($data, 0, strpos($data, ':'));
    $message = strstr($data, ':');
    $iv = substr($message, 1, $ivcount);
    $iv = base64_decode($iv);

    /* get data */
    $encrypted = base64_decode(substr($message, $ivcount+1));

    /* Open the cipher */
    $td = mcrypt_module_open('rijndael-256', '', 'ofb', '');
    $ks = mcrypt_enc_get_key_size($td);

    /* Create key */
    $key = substr(md5($keyphrase), 0, $ks);

    /* Intialize encryption */
    mcrypt_generic_init($td, $key, $iv);

    /* Decrypt encrypted string */
    $decrypted = mdecrypt_generic($td, $encrypted);

    /* Terminate decryption handle and close module */
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    /* Show string */
    return trim($decrypted);
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

    if(!is_a($mailer, 'PHPMailer')) {
        error_log("send_mail: PHPMailer object required!");
        return $result;
    }

    if (!$mail) {
        error_log("send_mail: no mail given, exiting...");
        return $result;
    }

    /* Replace data in mail, subject and body */
    foreach($data as $key => $value ) { 
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
    }
    else {
        preg_match_all("/[$login_forbidden_chars]/", $username, $forbidden_res);
        if (count($forbidden_res[0])) {
            $result = "badcredentials";
            error_log("Illegal characters in username $username (list of forbidden characters: $login_forbidden_chars)");
        }
    }

    return $result;
}

?>
