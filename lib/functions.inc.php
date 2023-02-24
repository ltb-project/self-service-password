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

# Create ARGON2 password
function make_argon2_password($password) {

    $options = [
               'memory_cost' => 4096,
               'time_cost'   => 3,
               'threads'     => 1,
    ];

    $hash = '{ARGON2}' . password_hash($password,PASSWORD_ARGON2I,$options);
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

function check_hash_type($ldap, $dn, $pwdattribute) {
    $search_userpassword = ldap_read($ldap, $dn, "(objectClass=*)", array($pwdattribute));
        if ($search_userpassword) {
            $userpassword = ldap_get_values($ldap, ldap_first_entry($ldap, $search_userpassword), $pwdattribute);
            if (isset($userpassword) && preg_match('/^\{(\w+)\}/', $userpassword[0], $matches)) {
                return strtoupper($matches[1]);
            }
        }
}

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

    if ( preg_match( "/nophpldap|phpupgraderequired|nophpmhash|nokeyphrase|ldaperror|nomatch|badcredentials|passworderror|tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|answermoderror|answernomatch|mailnomatch|tokennotsent|tokennotvalid|notcomplex|smsnonumber|smscrypttokensrequired|nophpmbstring|nophpxml|smsnotsent|sameaslogin|pwned|invalidsshkey|sshkeyerror|specialatends|forbiddenwords|forbiddenldapfields|diffminchars|badquality|tooyoung|inhistory|throttle/" , $msg ) ) {
    return "danger";
    }

    if ( preg_match( "/(login|oldpassword|newpassword|confirmpassword|answer|question|password|mail|token|sshkey|captcha)required|badcaptcha|tokenattempts|checkdatabeforesubmit/" , $msg ) ) {
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
        if ( !preg_match( "/tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|notcomplex|sameaslogin|pwned||specialatendsforbiddenwords|forbiddenldapfields/" , $result) ) { return; }
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
    if ( $pwd_no_reuse        ) { echo "<li>".$messages["policynoreuse"]                                 ."</li>\n"; }
    if ( $pwd_diff_last_min_chars ) { echo "<li>".$messages['policydiffminchars']." $pwd_diff_last_min_chars</li>\n"; }
    if ( $pwd_diff_login      ) { echo "<li>".$messages["policydifflogin"]                               ."</li>\n"; }
    if ( $use_pwnedpasswords  ) { echo "<li>".$messages["policypwned"]                               ."</li>\n"; }
    if ( $pwd_no_special_at_ends  ) { echo "<li>".$messages["policyspecialatends"] ."</li>\n"; }
    if ( !empty($pwd_forbidden_words)) { echo "<li>".$messages["policyforbiddenwords"] ." " . implode(', ', $pwd_forbidden_words) ."</li>\n"; }
    if ( !empty($pwd_forbidden_ldap_fields)) {
        $pwd_forbidden_ldap_fields = array_map(
            function($field) use ($messages) {
                if (empty($messages['ldap_' . $field])) {
                    return $field;
                }
               return $messages['ldap_' . $field];
            }, $pwd_forbidden_ldap_fields);
        echo "<li>".$messages["policyforbiddenldapfields"] ." " . implode(', ', $pwd_forbidden_ldap_fields) ."</li>\n";
    }
    echo "</ul>\n";
    echo "</div>\n";
}

# Check password strength
# @param array entry_array ldap entry ( ie not resource or LDAP\Result )
# @return result code
function check_password_strength( $password, $oldpassword, $pwd_policy_config, $login, $entry_array ) {
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
    $special_at_ends = false;
    if ( isset($pwd_special_chars) && !empty($pwd_special_chars) ) {
        preg_match_all("/[$pwd_special_chars]/", $password, $special_res);
        $special = count( $special_res[0] );
        if ( $pwd_no_special_at_ends ) {
            $special_at_ends = preg_match("/(^[$pwd_special_chars]|[$pwd_special_chars]$)/", $password, $special_res);
        }
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

    # Special chars at beginning or end
    if ( $special_at_ends > 0 && $special == 1 ) { $result="specialatends"; }

    # Same as old password?
    if ( $pwd_no_reuse and $password === $oldpassword ) { $result="sameasold"; }

    # Same as login?
    if ( $pwd_diff_login and $password === $login ) { $result="sameaslogin"; }

    if ( $pwd_diff_last_min_chars > 0 and strlen($oldpassword) > 0 ) {
        $similarities = similar_text($oldpassword, $password);
        $check_len    = strlen($oldpassword) < strlen($password) ? strlen($oldpassword) : strlen($password);
        $new_chars    = $check_len - $similarities;
        if ($new_chars <= $pwd_diff_last_min_chars) { $result = "diffminchars"; }
    }

    # Contains forbidden words?
    if ( !empty($pwd_forbidden_words) ) {
        foreach( $pwd_forbidden_words as $disallowed ) {
            if( stripos($password, $disallowed) !== false ) {
                $result="forbiddenwords";
                break;
            }
        }
    }

    # Contains values from forbidden ldap fields?
    if ( !empty($pwd_forbidden_ldap_fields) ) {
        foreach ( $pwd_forbidden_ldap_fields as $field ) {
            # if entry does not hold requested attribute, continue
            if ( array_key_exists($field,$entry_array) )
            {
                $values = $entry_array[$field];
                if (!is_array($values)) {
                    $values = array($values);
                }
                foreach ($values as $key => $value) {
                    if ($key === 'count') {
                        continue;
                    }
                    if (stripos($password, $value) !== false) {
                        $result = "forbiddenldapfields";
                        break 2;
                    }
                }
            }
        }
    }

    # pwned?
    if ($use_pwnedpasswords and version_compare(PHP_VERSION, '7.2.5') >= 0) {
        $pwned_passwords = new PwnedPasswords\PwnedPasswords;
        $insecure = $pwned_passwords->isPwned($password);
        if ($insecure) { $result="pwned"; }
    }

    return $result;
}

# Change password
# @return result code
function change_password( $ldap, $dn, $password, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword, $use_exop_passwd, $use_ppolicy_control ) {

    $result = "";
    $error_code = "";
    $error_msg = "";
    $ppolicy_error_code = "";

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
        if ( isset($samba_options['expire_days']) && $samba_options['expire_days'] > 0 ) {
             $userdata["sambaKickoffTime"] = $time + ( $samba_options['expire_days'] * 86400 );
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
    } elseif (!$use_exop_passwd) {
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
         if ( $hash == "ARGON2" ) {
            $password = make_argon2_password($password);
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
        $error_code = ldap_errno($ldap);
        $error_msg = ldap_error($ldap);
    } elseif ($use_exop_passwd) {
        $exop_passwd = FALSE;
        if ( $use_ppolicy_control ) {
            $ctrls = array();
            $exop_passwd = ldap_exop_passwd($ldap, $dn, $oldpassword, $password, $ctrls);
            $error_code = ldap_errno($ldap);
            $error_msg = ldap_error($ldap);
            if (!$exop_passwd) {
                if (isset($ctrls[LDAP_CONTROL_PASSWORDPOLICYRESPONSE])) {
                    $value = $ctrls[LDAP_CONTROL_PASSWORDPOLICYRESPONSE]['value'];
                    if (isset($value['error'])) {
                        $ppolicy_error_code = $value['error'];
                        error_log("LDAP - Ppolicy error code: $ppolicy_error_code");
                    }
                }
            }
        } else {
            $exop_passwd = ldap_exop_passwd($ldap, $dn, $oldpassword, $password);
            $error_code = ldap_errno($ldap);
            $error_msg = ldap_error($ldap);
        }
        if ($exop_passwd === TRUE) {
            # If password change works update other data
            if (!empty($userdata)) {
                ldap_mod_replace($ldap, $dn, $userdata);
                $error_code = ldap_errno($ldap);
                $error_msg = ldap_error($ldap);
            }
        }
    } else {
        # Else just replace with new password
        if (!$ad_mode) {
            $userdata["userPassword"] = $password;
        }
        if ( $use_ppolicy_control ) {
            $ppolicy_replace = ldap_mod_replace_ext($ldap, $dn, $userdata, [['oid' => LDAP_CONTROL_PASSWORDPOLICYREQUEST]]);
            if (ldap_parse_result($ldap, $ppolicy_replace, $error_code, $matcheddn, $error_msg, $referrals, $ctrls)) {
                if (isset($ctrls[LDAP_CONTROL_PASSWORDPOLICYRESPONSE])) {
                    $value = $ctrls[LDAP_CONTROL_PASSWORDPOLICYRESPONSE]['value'];
                    if (isset($value['error'])) {
                        $ppolicy_error_code = $value['error'];
                        error_log("LDAP - Ppolicy error code: $ppolicy_error_code");
                    }
                }
            }
        } else {
            ldap_mod_replace($ldap, $dn, $userdata);
            $error_code = ldap_errno($ldap);
            $error_msg = ldap_error($ldap);
        }
    }

    if ( !isset($error_code) ) {
        $result = "ldaperror";
    } elseif ( $error_code > 0 ) {
        $result = "passworderror";
        error_log("LDAP - Modify password error $error_code ($error_msg)");
        if ( $ppolicy_error_code === 5 ) { $result = "badquality"; }
        if ( $ppolicy_error_code === 6 ) { $result = "tooshort"; }
        if ( $ppolicy_error_code === 7 ) { $result = "tooyoung"; }
        if ( $ppolicy_error_code === 8 ) { $result = "inhistory"; }
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
        if (count($key_parts) > 3) {
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

# Change apppassword
# @return result code

function change_apppassword($pwdattribute, $ldap, $dn, $apppassword, $hash, $hash_options, $use_ppolicy_control) {

    $result = "";
    $error_code = "";
    $error_msg = "";
    $ppolicy_error_code = "";

    # Get hash type if hash is set to auto
    if ($hash == "auto") {
        $hash = check_hash_type($ldap, $dn, $pwdattribute);
    }

    # Hash password if needed
    if ($hash == "SSHA") {
        $apppassword = make_ssha_password($apppassword);
    }
    if ($hash == "SSHA256") {
        $apppassword = make_ssha256_password($apppassword);
    }
    if ($hash == "SSHA384") {
        $apppassword = make_ssha384_password($apppassword);
    }
    if ($hash == "SSHA512") {
        $apppassword = make_ssha512_password($apppassword);
    }
    if ($hash == "SHA") {
        $apppassword = make_sha_password($apppassword);
    }
    if ($hash == "SHA256") {
        $apppassword = make_sha256_password($apppassword);
    }
    if ($hash == "SHA384") {
        $apppassword = make_sha384_password($apppassword);
    }
    if ($hash == "SHA512") {
        $apppassword = make_sha512_password($apppassword);
    }
    if ($hash == "SMD5") {
        $apppassword = make_smd5_password($apppassword);
    }
    if ($hash == "MD5") {
        $apppassword = make_md5_password($apppassword);
    }
    if ($hash == "CRYPT") {
        $apppassword = make_crypt_password($apppassword, $hash_options);
    }
    if ($hash == "ARGON2") {
        $apppassword = make_argon2_password($apppassword);
    }
    if ($hash == "NTLM") {
        $apppassword = make_md4_password($apppassword);
    }

    # Commit modification on directory

    $userdata[$pwdattribute] = $apppassword;
    if ( $use_ppolicy_control ) {
        $ppolicy_replace = ldap_mod_replace_ext($ldap, $dn, $userdata, [['oid' => LDAP_CONTROL_PASSWORDPOLICYREQUEST]]);
        if (ldap_parse_result($ldap, $ppolicy_replace, $error_code, $matcheddn, $error_msg, $referrals, $ctrls)) {
            if (isset($ctrls[LDAP_CONTROL_PASSWORDPOLICYRESPONSE])) {
                $value = $ctrls[LDAP_CONTROL_PASSWORDPOLICYRESPONSE]['value'];
                if (isset($value['error'])) {
                    $ppolicy_error_code = $value['error'];
                    error_log("LDAP - Ppolicy error code: $ppolicy_error_code");
                }
            }
        }
    } else {
        ldap_mod_replace($ldap, $dn, $userdata);
        $error_code = ldap_errno($ldap);
        $error_msg = ldap_error($ldap);
    }

    if (!isset($error_code)) {
        $result = "ldaperror";
    } elseif ($error_code > 0) {
        $result = "passworderror";
        error_log("LDAP - Modify password error $error_code ($error_msg)");
        if ($ppolicy_error_code === 5) {
            $result = "badquality";
        }
        if ($ppolicy_error_code === 6) {
            $result = "tooshort";
        }
        if ($ppolicy_error_code === 7) {
            $result = "tooyoung";
        }
        if ($ppolicy_error_code === 8) {
            $result = "inhistory";
        }
    } else {
        $result = "passwordchanged";
    }

    return $result;
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
