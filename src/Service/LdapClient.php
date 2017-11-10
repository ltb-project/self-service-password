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

namespace App\Service;

use App\Utils\PasswordEncoder;

class LdapClient {
    /**
     * @var array
     */
    private $config;

    /**
     * @var resource
     */
    private $ldap;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * LdapClient constructor.
     * @param $config
     * @param $passwordEncoder PasswordEncoder
     */
    public function __construct($config, $passwordEncoder) {
        $this->config = $config;
        $this->passwordEncoder = $passwordEncoder;
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
        $notify_on_change = $this->config['notify_on_sshkey_change'];
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
        if ( $notify_on_change ) {
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
        $sms_truncate_length = $this->config['sms_truncate_number_length'];
        $fullname_attribute = $this->config['ldap_fullname_attribute'];

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
                $sms = substr($sms, -$sms_truncate_length);
            }
            $context['user_sms'] = $sms;
        }

        if ( !$sms ) {
            error_log("No SMS number found for user $login");
            return "smsnonumber";
        }

        $displayname = ldap_get_values($this->ldap, $entry, $fullname_attribute);
        $context['user_displayname'] = $displayname;

        return "smsuserfound";
    }

    public function checkMail($login, $mail) {
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];
        $mail_attribute = $this->config['mail_attribute'];
        $fetch_mail_from_ldap = $this->config['mail_address_use_ldap'];

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

        if (!$fetch_mail_from_ldap) {
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
            if (!$fetch_mail_from_ldap) {
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
        $who_change_password = $this->config['who_change_password'];

        if(isset($context['user_is_samba_account']) && $context['user_is_samba_account'] == false) {
            $samba_mode = false;
        }

        if(isset($context['user_is_shadow_account']) && $context['user_is_shadow_account'] == false) {
            $shadow_options['update_shadowLastChange'] = false;
            $shadow_options['update_shadowExpire'] = false;
        }

        return $this->change_password($this->ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $who_change_password, $oldpassword);
    }

    private function change_password($ldap, $entry_dn, $password, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $who_change_password, $oldpassword ) {
        $time = time();

        # Set Samba password value
        if ( $samba_mode ) {
            $userdata["sambaNTPassword"] = $this->passwordEncoder->format('nt', $password);
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
            $search_userpassword = ldap_read( $ldap, $entry_dn, "(objectClass=*)", array("userPassword") );
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
            $password = $this->passwordEncoder->format('ad', $password);
        } else {
            if($hash != 'clear') {
                $password = $this->passwordEncoder->hash($hash, $password);
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
            $oldpassword = $this->passwordEncoder->format('ad', $oldpassword);

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

            ldap_modify_batch($ldap, $entry_dn, $modifications);
        } else {
            # Else just replace with new password
            ldap_mod_replace($ldap, $entry_dn, $userdata);
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

    /**
     * Change sshPublicKey attribute
     * @param $entry_dn
     * @param $sshkey
     * @return string
     */
    public function changeSshKey($entry_dn, $sshkey ) {
        $attribute = $this->config['change_sshkey_attribute'];

        $userdata[$attribute] = $sshkey;

        # Commit modification on directory
        ldap_mod_replace($this->ldap, $entry_dn, $userdata);

        $errno = ldap_errno($this->ldap);

        if ( $errno ) {
            $result = "sshkeyerror";
            error_log("LDAP - Modify $attribute error $errno (".ldap_error($this->ldap).")");
        } else {
            $result = "sshkeychanged";
        }

        return $result;
    }
}
