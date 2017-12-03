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

use App\Exception\LdapEntryFoundInvalid;
use App\Exception\LdapError;
use App\Exception\LdapInvalidUserCredentials;
use App\Exception\LdapUpdateFailed;
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

    /**
     * @throws LdapError
     */
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
            throw new LdapError();
        }

        // Bind
        $success = ldap_bind($this->ldap, $ldap_binddn, $ldap_bindpw);

        if ( $success === false ) {
            $this->throwLdapError('Bind error');
        }
    }

    /**
     * @throws LdapError
     * @throws LdapInvalidUserCredentials
     */
    public function fetchUserEntryContext($login, $wanted, &$context) {
        $entry = $this->getUserEntry($login);

        if(in_array('dn', $wanted)) {
            $this->updateContextDn($entry, $context);
        }
        if(in_array('samba', $wanted) || in_array('shadow', $wanted)) {
            $this->updateContextSambaAndShadow($entry, $context);
        }
        if(in_array('mail', $wanted)) {
            $this->updateContextMail($entry, $context);
        }
        if(in_array('sms', $wanted)) {
            $this->updateContextSms($entry, $context);
        }
        if(in_array('displayname', $wanted)) {
            $this->updateContextDisplayName($entry, $context);
        }
        if(in_array('questions', $wanted)) {
            $this->updateContextQuestions($entry, $context);
        }
    }

    /**
     * @throws LdapInvalidUserCredentials
     */
    public function checkOldPassword($oldpassword, &$context) {
        $success = $this->verifyPasswordWithBind($context['user_dn'], $oldpassword);

        if ($success === false) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Bind user error $errno  (".ldap_error($this->ldap).")");
            throw new LdapInvalidUserCredentials();
        }
    }

    // TODO move out
    public function checkQuestionAnswer($login, $question, $answer, &$context) {
        $match = 0;

        // Match with user submitted values
        foreach ($context['user_answers'] as $questionValue) {
            $answer = preg_quote("$answer","/");
            if (preg_match("/^\{$question\}$answer$/i", $questionValue)) {
                $match = 1;
            }
        }

        if (!$match) {
            error_log("Answer does not match question for user $login");
            return false;
        }

        return true;
    }

    /**
     * @throws LdapError
     * @throws LdapInvalidUserCredentials
     * @throws LdapEntryFoundInvalid
     */
    public function checkMail($login, $mail) {
        $fetch_mail_from_ldap = $this->config['mail_address_use_ldap'];

        $context = [];
        $wanted = ['mail'];
        $this->fetchUserEntryContext($login, $wanted, $context);

        if($context['user_mail'] == null) {
            error_log("Mail not found for user $login");
            throw new LdapEntryFoundInvalid();
        }

        $match = 0;

        if ($fetch_mail_from_ldap) {
            // Match with user submitted values
            foreach ($context['user_mails'] as $mailValue) {
                if (strcasecmp($mail, $mailValue) == 0) {
                    $match = 1;
                    break;
                }
            }
        }

        if (!$match) {
            error_log("Mail $mail does not match for user $login");
            throw new LdapEntryFoundInvalid();
        }
    }

    /**
     * @throws LdapError
     * @throws LdapUpdateFailed
     */
    public function changeQuestion($userdn, $question, $answer) {
        $who_change_password = $this->config['who_change_password'];
        $answer_objectClass = $this->config['answer_objectClass'];
        $answer_attribute = $this->config['answer_attribute'];

        // Rebind as Manager if needed
        if ( $who_change_password == "manager" ) {
            $this->rebindAsManager();
        }

        // Check objectClass presence
        $search = ldap_search($this->ldap, $userdn, '(objectClass=*)', ['objectClass']);

        if ($search === false) {
            $this->throwLdapError('Search error');
        }

        // Get objectClass values from user entry
        $entry = ldap_first_entry($this->ldap, $search);
        $ocValues = ldap_get_values($this->ldap, $entry, 'objectClass');

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
        $success = ldap_mod_replace($this->ldap, $userdn , $userdata);

        if ( $success === false ) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Modify answer (error $errno (".ldap_error($this->ldap).")");
            throw new LdapUpdateFailed();
        }
    }

    /**
     * @throws LdapUpdateFailed
     */
    public function changePassword($entry_dn, $newpassword, $oldpassword, $context) {
        $who_change_password = $this->config['who_change_password'];

        // Rebind as Manager if needed
        // TODO detect if needed ?
        if ( $who_change_password == "manager" ) {
            $this->rebindAsManager();
        }

        $ad_mode = $this->config['ad_mode'];
        $ad_options = $this->config['ad_options'];

        $hash = $this->config['hash'];

        // Get hash type if hash is set to auto
        if ( $hash == 'auto' ) {
            $hash = $this->findHash($entry_dn);
        }
        // Transform password value
        if($hash != 'clear') {
            $newpassword = $this->passwordEncoder->hash($hash, $newpassword);
        }

        // Special case: AD mode with password changed as user
        if ( $ad_mode and $who_change_password === 'user' ) {
            // The AD password change procedure is modifying the attribute unicodePwd by
            // first deleting unicodePwd with the old password and them adding it with the
            // the new password
            $oldpassword = $this->passwordEncoder->format('ad', $oldpassword);
            $newpassword = $this->passwordEncoder->format('ad', $newpassword);

            $modifications = [
                ['attrib' => 'unicodePwd', 'modtype' => LDAP_MODIFY_BATCH_REMOVE, 'values' => [$oldpassword]],
                ['attrib' => 'unicodePwd', 'modtype' => LDAP_MODIFY_BATCH_ADD, 'values' => [$newpassword]],
            ];

            $success = ldap_modify_batch($this->ldap, $entry_dn, $modifications);

            if ( !$success ) {
                $errno = ldap_errno($this->ldap);
                error_log("LDAP - Modify password error $errno (".ldap_error($this->ldap).")");
                throw new LdapUpdateFailed();
            }
            return;
        }

        // Generic case

        $samba_mode = $this->config['samba_mode'];
        $samba_options = $this->config['samba_options'];
        if(isset($context['user_is_samba_account']) && $context['user_is_samba_account'] == false) {
            $samba_mode = false;
        }

        $shadow_options = $this->config['shadow_options'];
        if(isset($context['user_is_shadow_account']) && $context['user_is_shadow_account'] == false) {
            $shadow_options['update_shadowLastChange'] = false;
            $shadow_options['update_shadowExpire'] = false;
        }

        $time = time();

        $userdata = [];

        // Set samba attributes
        if ( $samba_mode ) {
            $userdata['sambaNTPassword'] = $this->passwordEncoder->format('nt', $newpassword);
            $userdata['sambaPwdLastSet'] = $time;
            if ( isset($samba_options['min_age']) && $samba_options['min_age'] > 0 ) {
                $userdata['sambaPwdCanChange'] = $time + ( $samba_options['min_age'] * 86400 );
            }
            if ( isset($samba_options['max_age']) && $samba_options['max_age'] > 0 ) {
                $userdata['sambaPwdMustChange'] = $time + ( $samba_options['max_age'] * 86400 );
            }
        }

        // Set shadow attributes
        if ( $shadow_options['update_shadowLastChange'] ) {
            $userdata['shadowLastChange'] = floor($time / 86400);
        }
        if ( $shadow_options['update_shadowExpire'] ) {
            $daysBeforeExpiration = $shadow_options['shadow_expire_days'];
            if ( $daysBeforeExpiration > 0) {
                $userdata['shadowExpire'] = floor(($time / 86400) + $daysBeforeExpiration);
            } else {
                $userdata['shadowExpire'] = $daysBeforeExpiration;
            }
        }

        // Set password value
        if ( $ad_mode ) {
            $userdata['unicodePwd'] = $this->passwordEncoder->format('ad', $newpassword);

            if ( $ad_options['force_unlock'] ) {
                $userdata['lockoutTime'] = 0;
            }
            if ( $ad_options['force_pwd_change'] ) {
                $userdata['pwdLastSet'] = 0;
            }
        } else {
            $userdata['userPassword'] = $newpassword;
        }

        $success = ldap_mod_replace($this->ldap, $entry_dn, $userdata);

        if ( !$success ) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Modify password error $errno (".ldap_error($this->ldap).")");
            throw new LdapUpdateFailed();
        }
    }

    private function findHash($entry_dn) {
        $search_userpassword = ldap_read( $this->ldap, $entry_dn, '(objectClass=*)', ['userPassword']);
        if ( $search_userpassword ) {
            $userpassword = ldap_get_values($this->ldap, ldap_first_entry($this->ldap,$search_userpassword), 'userPassword');
            if ( isset($userpassword) ) {
                if ( preg_match( '/^\{(\w+)\}/', $userpassword[0], $matches ) ) {
                    return strtoupper($matches[1]);
                }
            }
        }

        return 'clear';
    }

    /**
     * Change sshPublicKey attribute
     * @param $entry_dn
     * @param $sshkey
     * @throws LdapUpdateFailed
     */
    public function changeSshKey($entry_dn, $sshkey) {
        $attribute = $this->config['change_sshkey_attribute'];
        $who_change_sshkey = $this->config['who_change_sshkey'];

        // Rebind as Manager if needed
        if ( $who_change_sshkey == "manager" ) {
            $this->rebindAsManager();
        }

        $userdata = [];
        $userdata[$attribute] = $sshkey;

        # Commit modification on directory
        $success = ldap_mod_replace($this->ldap, $entry_dn, $userdata);

        if ( $success === false ) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Modify $attribute error $errno (".ldap_error($this->ldap).")");
            throw new LdapUpdateFailed();
        }
    }

    /**
     * @throws LdapError
     */
    private function throwLdapError($error) {
        $errno = ldap_errno($this->ldap);
        error_log("LDAP - $error $errno (".ldap_error($this->ldap).")");
        throw new LdapError();
    }

    /**
     * @param $login
     * @return resource
     * @throws LdapError
     * @throws LdapInvalidUserCredentials
     */
    private function getUserEntry($login) {
        $ldap_filter = $this->config['ldap_filter'];
        $ldap_base = $this->config['ldap_base'];

        // Search for user
        $ldap_filter = str_replace("{login}", $login, $ldap_filter);
        $search = ldap_search($this->ldap, $ldap_base, $ldap_filter);

        if ( $search === false ) {
            $this->throwLdapError('Search error');
        }

        $entry = ldap_first_entry($this->ldap, $search);

        if ( $entry === false ) {
            error_log("LDAP - User $login not found");
            throw new LdapInvalidUserCredentials();
        }

        return $entry;
    }

    private function updateContextDn($entry, &$context) {
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;
    }

    private function updateContextDisplayName($entry, &$context) {
        $fullname_attribute = $this->config['ldap_fullname_attribute'];
        $displayname = ldap_get_values($this->ldap, $entry, $fullname_attribute);
        $context['user_displayname'] = $displayname;
    }

    private function updateContextMail($entry, &$context) {
        $mail_attribute = $this->config['mail_attribute'];
        $mailValues = ldap_get_values($this->ldap, $entry, $mail_attribute);

        $mails = [];
        $mail = null;

        if ( $mailValues["count"] > 0 ) {
            unset($mailValues["count"]);

            if (strcasecmp($mail_attribute, 'proxyAddresses') == 0) {
                $remove_prefix = function ($mailValue) { return str_ireplace('smtp:', '', $mailValue); };
                $mailValues = array_map($remove_prefix, $mailValues);
            }

            $mail = $mailValues[0];
            $mails = $mailValues;
        }

        $context['user_mail'] = $mail;
        $context['user_mails'] = $mails;
    }

    private function updateContextSms($entry, &$context) {
        $sms_attribute = $this->config['sms_attribute'];
        $sms_sanitize_number = $this->config['sms_sanitize_number'];
        $sms_truncate_number = $this->config['sms_truncate_number'];
        $sms_truncate_length = $this->config['sms_truncate_number_length'];

        // Get sms values
        $smsValues = ldap_get_values($this->ldap, $entry, $sms_attribute);

        $context['user_sms_raw'] = null;
        $context['user_sms'] = null;

        // Check sms number
        if ( $smsValues["count"] > 0 ) {
            $sms = $smsValues[0];
            $context['user_sms_raw'] = $sms;
            if ( $sms_sanitize_number ) {
                $sms = preg_replace('/[^0-9]/', '', $sms);
            }
            if ( $sms_truncate_number ) {
                $sms = substr($sms, -$sms_truncate_length);
            }
            $context['user_sms'] = $sms;
        }
    }

    private function updateContextSambaAndShadow($entry, &$context) {
        // Check objectClass to allow samba and shadow updates
        $ocValues = ldap_get_values($this->ldap, $entry, 'objectClass');
        if ( !in_array( 'sambaSamAccount', $ocValues ) and !in_array( 'sambaSAMAccount', $ocValues ) ) {
            $context['user_is_samba_account'] = false;
        }
        if ( !in_array( 'shadowAccount', $ocValues ) ) {
            $context['user_is_shadow_account'] = false;
        }
    }

    private function updateContextQuestions($entry, &$context) {
        $answer_attribute = $this->config['answer_attribute'];

        // Get question/answer values
        $questionValues = ldap_get_values($this->ldap, $entry, $answer_attribute);
        unset($questionValues["count"]);

        $context['user_answers'] = [];

        foreach ($questionValues as $questionValue) {
            $context['user_answers'] = $questionValue;
        }
    }

    private function verifyPasswordWithBind($dn, $password) {
        $ad_mode = $this->config['ad_mode'];
        $ad_options = $this->config['ad_options'];

        // Bind with old password
        $success = ldap_bind($this->ldap, $dn, $password);

        if ($success === false) {
            $errno = ldap_errno($this->ldap);
            if ( ($errno == 49) && $ad_mode ) {
                if ( ldap_get_option($this->ldap, 0x0032, $extended_error) ) {
                    error_log("LDAP - Bind user extended_error $extended_error  (".ldap_error($this->ldap).")");
                    $extended_error = explode(', ', $extended_error);
                    if ( strpos($extended_error[2], '773') or strpos($extended_error[0], 'NT_STATUS_PASSWORD_MUST_CHANGE') ) {
                        error_log("LDAP - Bind user password needs to be changed");
                        return true;
                    }
                    if ( ( strpos($extended_error[2], '532') or strpos($extended_error[0], 'NT_STATUS_ACCOUNT_EXPIRED') ) and $ad_options['change_expired_password'] ) {
                        error_log("LDAP - Bind user password is expired");
                        return true;
                    }
                }
            }
            return false;
        }

        return true;
    }

    private function rebindAsManager() {
        $ldap_binddn = isset($this->config['ldap_binddn']) ? $this->config['ldap_binddn'] : null;
        $ldap_bindpw = isset($this->config['ldap_bindpw']) ? $this->config['ldap_bindpw'] : null;
        ldap_bind($this->ldap, $ldap_binddn, $ldap_bindpw);
    }
}
