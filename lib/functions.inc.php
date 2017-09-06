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
    $salt = random_bytes(4);
    $hash = "{SSHA}" . base64_encode(pack("H*", sha1($password . $salt)) . $salt);
    return $hash;
}

# Create SSHA256 password
function make_ssha256_password($password) {
    $salt = random_bytes(4);
    $hash = "{SSHA256}" . base64_encode(pack("H*", hash('sha256', $password . $salt)) . $salt);
    return $hash;
}

# Create SSHA384 password
function make_ssha384_password($password) {
    $salt = random_bytes(4);
    $hash = "{SSHA384}" . base64_encode(pack("H*", hash('sha384', $password . $salt)) . $salt);
    return $hash;
}

# Create SSHA512 password
function make_ssha512_password($password) {
    $salt = random_bytes(4);
    $hash = "{SSHA512}" . base64_encode(pack("H*", hash('sha512', $password . $salt)) . $salt);
    return $hash;
}

# Create SHA password
function make_sha_password($password) {
    $hash = "{SHA}" . base64_encode(pack("H*", sha1($password)));
    return $hash;
}

# Create SHA256 password
function make_sha256_password($password) {
    $hash = "{SHA256}" . base64_encode(pack("H*", hash('sha256', $password)));
    return $hash;
}

# Create SHA384 password
function make_sha384_password($password) {
    $hash = "{SHA384}" . base64_encode(pack("H*", hash('sha384', $password)));
    return $hash;
}

# Create SHA512 password
function make_sha512_password($password) {
    $hash = "{SHA512}" . base64_encode(pack("H*", hash('sha512', $password)));
    return $hash;
}

# Create SMD5 password
function make_smd5_password($password) {
    $salt = random_bytes(4);
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

    $salt_length = 2;
    if ( isset($hash_options['crypt_salt_length']) ) {
        $salt_length = $hash_options['crypt_salt_length'];
    }

    // Generate salt
    $possible = '0123456789'.
		'abcdefghijklmnopqrstuvwxyz'.
		'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.
		'./';
    $salt = "";

    while( strlen( $salt ) < $salt_length ) {
        $salt .= substr( $possible, random_int( 0, strlen( $possible ) - 1 ), 1 );
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
        $r=random_int(0,$NumRanges-1);
        list($min,$max)=explode('-',$Range[$r]);
        $smstoken.=chr(random_int($min,$max));
    }
    return $smstoken;
}

# Get message criticity
function get_criticity( $msg ) {

    if ( preg_match( "/nophpldap|phpupgraderequired|nophpmhash|nokeyphrase|ldaperror|nomatch|badcredentials|passworderror|tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|answermoderror|answernomatch|mailnomatch|tokennotsent|tokennotvalid|notcomplex|smsnonumber|smscrypttokensrequired|nophpmbstring|nophpxml|smsnotsent|sameaslogin|sshkeyerror/" , $msg ) ) {
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

function is_error ( $msg ) {
    return preg_match( "/tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|notcomplex|sameaslogin/" , $msg);
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
        if ( $hash == "SSHA256" ) {
            $password = make_ssha256_password($password);
        }
        if ( $hash == "SSHA384" ) {
            $password = make_ssha384_password($password);
        }
        if ( $hash == "SSHA512" ) {
            $password = make_ssha512_password($password);
        }
        if ( $hash == "SHA" ) {
            $password = make_sha_password($password);
        }
        if ( $hash == "SHA256" ) {
            $password = make_sha256_password($password);
        }
        if ( $hash == "SHA384" ) {
            $password = make_sha384_password($password);
        }
        if ( $hash == "SHA512" ) {
            $password = make_sha512_password($password);
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

    if ( $shadow_options['update_shadowExpire'] ) {
        if ( $shadow_options['shadow_expire_days'] > 0) {
          $userdata["shadowExpire"] = floor(($time / 86400) + $shadow_options['shadow_expire_days']);
        } else {
          $userdata["shadowExpire"] = $shadow_options['shadow_expire_days'];
        }
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


# Change sshPublicKey attribute
# @return result code
function change_sshkey( $ldap, $dn, $attribute, $sshkey ) {

    $result = "";

    $userdata[$attribute] = $sshkey;

    # Commit modification on directory
    $replace = ldap_mod_replace($ldap, $dn, $userdata);

    $errno = ldap_errno($ldap);

    if ( $errno ) {
        $result = "sshkeyerror";
        error_log("LDAP - Modify $attribute error $errno (".ldap_error($ldap).")");
    } else {
        $result = "sshkeychanged";
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

/* @function string check_recaptcha(string $recaptcha_privatekey, null|string $recaptcha_request_method, string $response, string $login)
 * Check if $response verifies the reCAPTCHA by asking the recaptcha server, logs if errors
 * @param $recaptcha_privatekey string shared secret with reCAPTCHA server
 * @param $recaptcha_request_method null|string FQCN of request method, null for default
 * @param $response string response provided by user
 * @param $login string for logging purposes only
 * @return string empty string if the response is verified successfully, else string 'badcaptcha'
 */
function check_recaptcha($recaptcha_privatekey, $recaptcha_request_method, $response, $login) {
    $recaptcha = new \ReCaptcha\ReCaptcha($recaptcha_privatekey, is_null($recaptcha_request_method) ? null : new $recaptcha_request_method());
    $resp = $recaptcha->verify($response, $_SERVER['REMOTE_ADDR']);

    if (!$resp->isSuccess()) {
        error_log("Bad reCAPTCHA attempt with user $login");
        foreach ($resp->getErrorCodes() as $code) {
            error_log("reCAPTCHA error: $code");
        }
        return 'badcaptcha';
    }

    return '';
}

class PosthookExecutor {
    private $command;

    public function __construct($command)
    {
        $this->command = $command;
    }

    public function execute($login, $newpassword, $oldpassword = null) {
        $command = escapeshellcmd($this->command).' '.escapeshellarg($login).' '.escapeshellarg($newpassword);
        if($oldpassword != null) $command .= ' '.escapeshellarg($oldpassword);
        exec($command);
    }
}

class RecaptchaService {
    private $privatekey;
    private $request_method;

    public function __construct($privatekey, $request_method)
    {
        $this->privatekey = $privatekey;
        $this->request_method = $request_method;
    }

    public function verify($response, $login) {
        return $result = check_recaptcha($this->privatekey, $this->request_method, $response, $login);
    }
}

function generate_reset_url($reset_url, $params) {
    if ( empty($reset_url) ) {

        // Build reset by token URL
        $method = "http";
        if ( !empty($_SERVER['HTTPS']) ) { $method .= "s"; }
        $server_name = $_SERVER['SERVER_NAME'];
        $server_port = $_SERVER['SERVER_PORT'];
        $script_name = $_SERVER['SCRIPT_NAME'];

        // Force server port if non standard port
        if (   ( $method === "http"  and $server_port != "80"  )
            or ( $method === "https" and $server_port != "443" )
        ) {
            $server_name .= ":".$server_port;
        }

        $reset_url = $method."://".$server_name.$script_name;
    }

    return $reset_url . '?' . http_build_query(array ('action' => 'resetbytoken') + $params);
}

class MailNotificationService {
    private $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function send($mail, $mail_from, $mail_from_name, $subject, $body, $data) {
        $success = send_mail($this->mailer, $mail, $mail_from, $mail_from_name,$subject, $body, $data);

        if(!$success) {
            error_log("Error while sending email notification to $mail (user ${data['login']})");
        }

        return $success;
    }
}

class LdapClient {
    private $config;
    private $ldap;

    public function __construct($config) {
        $this->config = $config;
    }

    public function connect() {
        $ldap_url = $this->config['ldap_url'];
        $ldap_starttls = $this->config['ldap_starttls'];
        $ldap_binddn = isset($this->config['ldap_binddn']) ? $this->config['ldap_binddn'] : null;
        $ldap_bindpw = isset($this->config['ldap_bindpw']) ? $this->config['ldap_bindpw'] : null;

        //Connect to LDAP
        $this->ldap = ldap_connect($ldap_url);
        ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
        if ( $ldap_starttls && !ldap_start_tls($this->ldap) ) {
            error_log("LDAP - Unable to use StartTLS");
            return "ldaperror";
        }

        // Bind
        ldap_bind($this->ldap, $ldap_binddn, $ldap_bindpw);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Bind error $errno  (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        return '';
    }

    public function checkOldPassword($login, $oldpassword, &$context) {
        $ldap_binddn = isset($this->config['ldap_binddn']) ? $this->config['ldap_binddn'] : null;
        $ldap_bindpw = isset($this->config['ldap_bindpw']) ? $this->config['ldap_bindpw'] : null;
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        $notify_on_change = $this->config['notify_on_change'];
        $mail_attribute = $this->config['mail_attribute'];
        $ad_mode = $this->config['ad_mode'];
        $ad_options = $this->config['ad_options'];
        $who_change_password = $this->config['who_change_password'];

        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno  (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        // Get user DN
        $entry = ldap_first_entry($this->ldap, $search);
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;

        if( !$userdn ) {
            error_log("LDAP - User $login not found");
            return  "badcredentials";
        }

        // Get user email for notification
        if ( $notify_on_change ) {
            $mailValues = ldap_get_values($this->ldap, $entry, $mail_attribute);
            if ( $mailValues["count"] > 0 ) {
                $mail = $mailValues[0];
                $context['user_mail'] = $mail;
            }
        }

        // Check objectClass to allow samba and shadow updates
        $ocValues = ldap_get_values($this->ldap, $entry, 'objectClass');
        if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
            $context['user_is_samba_account'] = false;
        }
        if ( !in_array( 'shadowAccount', $ocValues ) ) {
            $context['user_is_shadow_account'] = false;
        }

        // Bind with old password
        ldap_bind($this->ldap, $userdn, $oldpassword);
        $errno = ldap_errno($this->ldap);
        if ( ($errno == 49) && $ad_mode ) {
            if ( ldap_get_option($this->ldap, 0x0032, $extended_error) ) {
                error_log("LDAP - Bind user extended_error $extended_error  (".ldap_error($this->ldap).")");
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
            error_log("LDAP - Bind user error $errno  (".ldap_error($this->ldap).")");
            return "badcredentials";
        }

        // Rebind as Manager if needed
        if ( $who_change_password == "manager" ) {
            ldap_bind($this->ldap, $ldap_binddn, $ldap_bindpw);
        }

        return '';
    }

    public function checkOldPassword2($login, $password, &$context) {
        $ldap_binddn = isset($this->config['ldap_binddn']) ? $this->config['ldap_binddn'] : null;
        $ldap_bindpw = isset($this->config['ldap_bindpw']) ? $this->config['ldap_bindpw'] : null;
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        $notify_on_sshkey_change = $this->config['notify_on_sshkey_change'];
        $mail_attribute = $this->config['mail_attribute'];
        $ad_mode = $this->config['ad_mode'];
        $ad_options = $this->config['ad_options'];
        $who_change_sshkey = $this->config['who_change_sshkey'];

        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno  (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        // Get user DN
        $entry = ldap_first_entry($this->ldap, $search);
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;

        if( !$userdn ) {
            error_log("LDAP - User $login not found");
            return "badcredentials";
        }

        // Get user email for notification
        if ( $notify_on_sshkey_change ) {
            $mailValues = ldap_get_values($this->ldap, $entry, $mail_attribute);
            if ( $mailValues["count"] > 0 ) {
                $mail = $mailValues[0];
                $context['user_mail'] = $mail;
            }
        }

        // Bind with old password
        ldap_bind($this->ldap, $userdn, $password);
        $errno = ldap_errno($this->ldap);
        if ( ($errno == 49) && $ad_mode ) {
            if ( ldap_get_option($this->ldap, 0x0032, $extended_error) ) {
                error_log("LDAP - Bind user extended_error $extended_error  (".ldap_error($this->ldap).")");
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
            error_log("LDAP - Bind user error $errno  (".ldap_error($this->ldap).")");
            return "badcredentials";
        }

        // Rebind as Manager if needed
        if ( $who_change_sshkey == "manager" ) {
            ldap_bind($this->ldap, $ldap_binddn, $ldap_bindpw);
        }

        return '';
    }

    public function checkQuestionAnswer($login, $question, $answer, &$context) {
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        $notify_on_change = $this->config['notify_on_change'];
        $mail_attribute = $this->config['mail_attribute'];
        $answer_attribute = $this->config['answer_attribute'];

        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        // Get user DN
        $entry = ldap_first_entry($this->ldap, $search);
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;

        if( !$userdn ) {
            error_log("LDAP - User $login not found");
            return "badcredentials";
        }

        // Check objectClass to allow samba and shadow updates
        $ocValues = ldap_get_values($this->ldap, $entry, 'objectClass');
        if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
            $context['user_is_samba_account'] = false;
        }
        if ( !in_array( 'shadowAccount', $ocValues ) ) {
            $context['user_is_shadow_account'] = false;
        }

        // Get user email for notification
        if ( $notify_on_change ) {
            $mailValues = ldap_get_values($this->ldap, $entry, $mail_attribute);
            if ( $mailValues["count"] > 0 ) {
                $mail = $mailValues[0];
                $context['user_mail'] = $mail;
            }
        }

        // Get question/answer values
        $questionValues = ldap_get_values($this->ldap, $entry, $answer_attribute);
        unset($questionValues["count"]);
        $match = 0;

        // Match with user submitted values
        foreach ($questionValues as $questionValue) {
            $answer = preg_quote("$answer","/");
            if (preg_match("/^\{$question\}$answer$/i", $questionValue)) {
                $match = 1;
            }
        }

        if (!$match) {
            error_log("Answer does not match question for user $login");
            return "answernomatch";
        }

        return '';
    }

    public function findUser($login, &$context) {
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        $notify_on_change = $this->config['notify_on_change'];
        $mail_attribute = $this->config['mail_attribute'];

        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        // Get user DN
        $entry = ldap_first_entry($this->ldap, $search);
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;

        if( !$userdn ) {
            error_log("LDAP - User $login not found");
            return "badcredentials";
        }

        // Check objectClass to allow samba and shadow updates
        $ocValues = ldap_get_values($this->ldap, $entry, 'objectClass');
        if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
            $context['user_is_samba_account'] = false;
        }
        if ( !in_array( 'shadowAccount', $ocValues ) ) {
            $context['user_is_shadow_account'] = false;
        }

        // Get user email for notification
        if ( $notify_on_change ) {
            $mailValues = ldap_get_values($this->ldap, $entry, $mail_attribute);
            if ( $mailValues["count"] > 0 ) {
                $mail = $mailValues[0];
                $context['user_mail'] = $mail;
            }
        }

        return '';
    }

    public function findUserSms($login, &$context) {
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        $sms_attribute = $this->config['sms_attribute'];
        $sms_sanitize_number = $this->config['sms_sanitize_number'];
        $sms_truncate_number = $this->config['sms_truncate_number'];
        $sms_truncate_number_length = $this->config['sms_truncate_number_length'];
        $ldap_fullname_attribute = $this->config['ldap_fullname_attribute'];

        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        // Get user DN
        $entry = ldap_first_entry($this->ldap, $search);
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;

        if( !$userdn ) {
            error_log("LDAP - User $login not found");
            return "badcredentials";
        }

        // Get sms values
        $smsValues = ldap_get_values($this->ldap, $entry, $sms_attribute);

        // Check sms number
        if ( $smsValues["count"] > 0 ) {
            $sms = $smsValues[0];
            if ( $sms_sanitize_number ) {
                $sms = preg_replace('/[^0-9]/', '', $sms);
            }
            if ( $sms_truncate_number ) {
                $sms = substr($sms, -$sms_truncate_number_length);
            }
            $context['user_sms'] = $sms;
        }

        if ( !$sms ) {
            error_log("No SMS number found for user $login");
            return "smsnonumber";
        }

        $displayname = ldap_get_values($this->ldap, $entry, $ldap_fullname_attribute);
        $context['user_displayname'] = $displayname;

        return "smsuserfound";
    }

    public function checkMail($login, $mail) {
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        $mail_attribute = $this->config['mail_attribute'];
        $mail_address_use_ldap = $this->config['mail_address_use_ldap'];

        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno (".ldap_error($this->ldap).")");
            return "ldaperror";
        }
        // Get user DN
        $entry = ldap_first_entry($this->ldap, $search);
        $userdn = ldap_get_dn($this->ldap, $entry);

        if( !$userdn ) {
            error_log("LDAP - User $login not found");
            return "badcredentials";
        }

        // Compare mail values
        $mailValues = ldap_get_values($this->ldap, $entry, $mail_attribute);
        unset($mailValues["count"]);
        $match = 0;

        if (!$mail_address_use_ldap) {
            // Match with user submitted values
            foreach ($mailValues as $mailValue) {
                if (strcasecmp($mail_attribute, "proxyAddresses") == 0) {
                    $mailValue = str_ireplace("smtp:", "", $mailValue);
                }
                if (strcasecmp($mail, $mailValue) == 0) {
                    $match = 1;
                }
            }
        } else {
            // Use first available mail adress in ldap
            if(count($mailValues) > 0) {
                $mailValue = $mailValues[0];
                if (strcasecmp($mail_attribute, "proxyAddresses") == 0) {
                    $mailValue = str_ireplace("smtp:", "", $mailValue);
                }
                $mail = $mailValue;
                $match = true;
            }
        }

        if (!$match) {
            if (!$mail_address_use_ldap) {
                error_log("Mail $mail does not match for user $login");
            } else {
                error_log("Mail not found for user $login");
            }
            return "mailnomatch";
        }

        return '';
    }

    function checkOldPassword3($login, $password, &$context) {
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        // Get user DN
        $entry = ldap_first_entry($this->ldap, $search);
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;

        if( !$userdn ) {
            error_log("LDAP - User $login not found");
            return "badcredentials";
        }

        // Bind with password
        ldap_bind($this->ldap, $userdn, $password);
        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Bind user error $errno (".ldap_error($this->ldap).")");
            return "badcredentials";
        }

        return '';
    }

    public function changeQuestion($userdn, $question, $answer) {
        $who_change_password = $this->config['who_change_password'];
        $ldap_binddn = $this->config['ldap_binddn'];
        $ldap_bindpw = $this->config['ldap_bindpw'];
        $answer_objectClass = $this->config['answer_objectClass'];
        $answer_attribute = $this->config['answer_attribute'];

        // Rebind as Manager if needed
        if ( $who_change_password == "manager" ) {
            ldap_bind($this->ldap, $ldap_binddn, $ldap_bindpw);
        }

        // Check objectClass presence
        $search = ldap_search($this->ldap, $userdn, "(objectClass=*)", array("objectClass") );

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Search error $errno (".ldap_error($this->ldap).")");
            return "ldaperror";
        }

        // Get objectClass values from user entry
        $entry = ldap_first_entry($this->ldap, $search);
        $ocValues = ldap_get_values($this->ldap, $entry, "objectClass");

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
        ldap_mod_replace($this->ldap, $userdn , $userdata);

        $errno = ldap_errno($this->ldap);
        if ( $errno ) {
            error_log("LDAP - Modify answer (error $errno (".ldap_error($this->ldap).")");
            return "answermoderror";
        }

        return "answerchanged";
    }

    public function changePassword($userdn, $newpassword, $oldpassword, $context) {
        $ad_mode = $this->config['ad_mode'];
        $ad_options = $this->config['ad_options'];
        $samba_mode = $this->config['samba_mode'];
        $samba_options = $this->config['samba_options'];
        $shadow_options = $this->config['shadow_options'];
        $hash = $this->config['hash'];
        $hash_options = $this->config['hash_options'];
        $who_change_password = $this->config['who_change_password'];

        if(isset($context['user_is_samba_account']) && $context['user_is_samba_account'] == false) {
            $samba_mode = false;
        }

        if(isset($context['user_is_shadow_account']) && $context['user_is_shadow_account'] == false) {
            $shadow_options['update_shadowLastChange'] = false;
            $shadow_options['update_shadowExpire'] = false;
        }

        return change_password($this->ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword);
    }

    public function changeSshKey( $dn, $sshkey ) {
        return change_sshkey($this->ldap, $dn, $this->config['change_sshkey_attribute'], $sshkey);
    }
}

class PasswordStrengthChecker {
    private $pwd_policy_config;

    public function __construct($pwd_policy_config) {
        $this->pwd_policy_config = $pwd_policy_config;
    }

    public function evaluate($newpassword, $oldpassword, $login) {
        return check_password_strength( $newpassword, $oldpassword, $this->pwd_policy_config, $login );
    }
}

class UsernameValidityChecker {
    private $login_forbidden_chars;

    public function __construct($login_forbidden_chars)
    {
        $this->login_forbidden_chars = $login_forbidden_chars;
    }

    public function evaluate($login) {
        return check_username_validity($login, $this->login_forbidden_chars);
    }
}