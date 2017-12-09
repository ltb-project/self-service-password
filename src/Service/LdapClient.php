<?php
/*
 * LTB Self Service Password
 *
 * Copyright (C) 2009 Clement OUDOT
 * Copyright (C) 2009 LTB-project.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * GPL License: http://www.gnu.org/licenses/gpl.txt
 */

namespace App\Service;

use App\Exception\LdapEntryFoundInvalidException;
use App\Exception\LdapErrorException;
use App\Exception\LdapInvalidUserCredentialsException;
use App\Exception\LdapUpdateFailedException;
use App\Utils\PasswordEncoder;

/**
 * Class LdapClient
 */
class LdapClient
{
    /** @var array */
    private $config;

    /** @var resource */
    private $ldap;

    /** @var PasswordEncoder */
    private $passwordEncoder;

    /**
     * LdapClient constructor.
     *
     * @param array           $config
     * @param PasswordEncoder $passwordEncoder
     */
    public function __construct($config, $passwordEncoder)
    {
        $this->config = $config;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @throws LdapErrorException
     */
    public function connect()
    {
        $ldapUrl = $this->config['ldap_url'];
        $ldapUseTls = $this->config['ldap_starttls'];
        $ldapBindDn = isset($this->config['ldap_binddn']) ? $this->config['ldap_binddn'] : null;
        $ldapBindPw = isset($this->config['ldap_bindpw']) ? $this->config['ldap_bindpw'] : null;

        //Connect to LDAP
        $this->ldap = ldap_connect($ldapUrl);
        ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
        if ($ldapUseTls && !ldap_start_tls($this->ldap)) {
            error_log("LDAP - Unable to use StartTLS");
            throw new LdapErrorException();
        }

        // Bind
        $success = ldap_bind($this->ldap, $ldapBindDn, $ldapBindPw);
        if (false === $success) {
            $this->throwLdapError('Bind error');
        }
    }

    /**
     * @param string $login
     * @param array  $wanted
     * @param array  $context
     *
     * @throws LdapErrorException
     * @throws LdapInvalidUserCredentialsException
     */
    public function fetchUserEntryContext($login, $wanted, &$context)
    {
        $entry = $this->getUserEntry($login);

        if (in_array('dn', $wanted)) {
            $this->updateContextDn($entry, $context);
        }
        if (in_array('samba', $wanted) || in_array('shadow', $wanted)) {
            $this->updateContextSambaAndShadow($entry, $context);
        }
        if (in_array('mail', $wanted)) {
            $this->updateContextMail($entry, $context);
        }
        if (in_array('sms', $wanted)) {
            $this->updateContextSms($entry, $context);
        }
        if (in_array('displayname', $wanted)) {
            $this->updateContextDisplayName($entry, $context);
        }
        if (in_array('questions', $wanted)) {
            $this->updateContextQuestions($entry, $context);
        }
    }

    /**
     * @param string $oldpassword
     * @param array  $context
     *
     * @throws LdapInvalidUserCredentialsException
     */
    public function checkOldPassword($oldpassword, &$context)
    {
        $success = $this->verifyPasswordWithBind($context['user_dn'], $oldpassword);
        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Bind user error $errno  (".ldap_error($this->ldap).")");
            throw new LdapInvalidUserCredentialsException();
        }
    }

    // TODO move out
    /**
     * @param string $login
     * @param string $question
     * @param string $answer
     * @param array  $context
     *
     * @return bool
     */
    public function checkQuestionAnswer($login, $question, $answer, &$context)
    {
        $match = 0;

        // Match with user submitted values
        foreach ($context['user_answers'] as $questionValue) {
            $answer = preg_quote("$answer", "/");
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
     * @param string $login
     * @param string $mail
     *
     * @throws LdapEntryFoundInvalidException
     * @throws LdapErrorException
     * @throws LdapInvalidUserCredentialsException
     */
    public function checkMail($login, $mail)
    {
        $fetchMailFromLdap = $this->config['mail_address_use_ldap'];

        $context = [];
        $wanted = ['mail'];
        $this->fetchUserEntryContext($login, $wanted, $context);

        if (null === $context['user_mail']) {
            error_log("Mail not found for user $login");
            throw new LdapEntryFoundInvalidException();
        }

        $match = 0;

        if ($fetchMailFromLdap) {
            // Match with user submitted values
            foreach ($context['user_mails'] as $mailValue) {
                if (strcasecmp($mail, $mailValue) === 0) {
                    $match = 1;
                    break;
                }
            }
        }

        if (!$match) {
            error_log("Mail $mail does not match for user $login");
            throw new LdapEntryFoundInvalidException();
        }
    }

    /**
     * @param string $userdn
     * @param string $question
     * @param string $answer
     *
     * @throws LdapErrorException
     * @throws LdapUpdateFailedException
     */
    public function changeQuestion($userdn, $question, $answer)
    {
        $whoChangePassword = $this->config['who_change_password'];
        $answerObjectClass = $this->config['answer_objectClass'];
        $answerAttribute = $this->config['answer_attribute'];

        // Rebind as Manager if needed
        if ('manager' === $whoChangePassword) {
            $this->rebindAsManager();
        }

        // Check objectClass presence
        $search = ldap_search($this->ldap, $userdn, '(objectClass=*)', ['objectClass']);
        if (false === $search) {
            $this->throwLdapError('Search error');
        }

        // Get objectClass values from user entry
        $entry = ldap_first_entry($this->ldap, $search);
        $ocValues = ldap_get_values($this->ldap, $entry, 'objectClass');

        // Remove 'count' key
        unset($ocValues['count']);

        if (!in_array($answerObjectClass, $ocValues)) {
            // Answer objectClass is not present, add it
            array_push($ocValues, $answerObjectClass);
            $ocValues = array_values($ocValues);
            $userdata["objectClass"] = $ocValues;
        }

        // Question/Answer
        $userdata[$answerAttribute] = '{'.$question.'}'.$answer;

        // Commit modification on directory
        $success = ldap_mod_replace($this->ldap, $userdn, $userdata);
        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Modify answer (error $errno (".ldap_error($this->ldap).")");
            throw new LdapUpdateFailedException();
        }
    }

    /**
     * @param string $entryDn
     * @param string $newpassword
     * @param string $oldpassword
     * @param array  $context
     *
     * @throws LdapUpdateFailedException
     */
    public function changePassword($entryDn, $newpassword, $oldpassword, $context)
    {
        $whoChangePassword = $this->config['who_change_password'];

        // Rebind as Manager if needed
        // TODO detect if needed ?
        if ("manager" === $whoChangePassword) {
            $this->rebindAsManager();
        }

        $adMode = $this->config['ad_mode'];
        $adOptions = $this->config['ad_options'];

        $hash = $this->config['hash'];

        // Get hash type if hash is set to auto
        if ('auto' === $hash) {
            $hash = $this->findHash($entryDn);
        }
        // Transform password value
        if ('clear' !== $hash) {
            $newpassword = $this->passwordEncoder->hash($hash, $newpassword);
        }

        // Special case: AD mode with password changed as user
        if ($adMode and 'user' === $whoChangePassword) {
            // The AD password change procedure is modifying the attribute unicodePwd by
            // first deleting unicodePwd with the old password and them adding it with the
            // the new password
            $oldpassword = $this->passwordEncoder->format('ad', $oldpassword);
            $newpassword = $this->passwordEncoder->format('ad', $newpassword);

            $modifications = [
                ['attrib' => 'unicodePwd', 'modtype' => LDAP_MODIFY_BATCH_REMOVE, 'values' => [$oldpassword]],
                ['attrib' => 'unicodePwd', 'modtype' => LDAP_MODIFY_BATCH_ADD, 'values' => [$newpassword]],
            ];

            $success = ldap_modify_batch($this->ldap, $entryDn, $modifications);
            if (!$success) {
                $errno = ldap_errno($this->ldap);
                error_log("LDAP - Modify password error $errno (".ldap_error($this->ldap).")");
                throw new LdapUpdateFailedException();
            }

            return;
        }

        // Generic case

        $sambaMode = $this->config['samba_mode'];
        $sambaOptions = $this->config['samba_options'];
        if (isset($context['user_is_samba_account']) && false === $context['user_is_samba_account']) {
            $sambaMode = false;
        }

        $shadowOptions = $this->config['shadow_options'];
        if (isset($context['user_is_shadow_account']) && false === $context['user_is_shadow_account']) {
            $shadowOptions['update_shadowLastChange'] = false;
            $shadowOptions['update_shadowExpire'] = false;
        }

        $time = time();

        $userdata = [];

        // Set samba attributes
        if ($sambaMode) {
            $userdata['sambaNTPassword'] = $this->passwordEncoder->format('nt', $newpassword);
            $userdata['sambaPwdLastSet'] = $time;
            if (isset($sambaOptions['min_age']) && $sambaOptions['min_age'] > 0) {
                $userdata['sambaPwdCanChange'] = $time + ( $sambaOptions['min_age'] * 86400 );
            }
            if (isset($sambaOptions['max_age']) && $sambaOptions['max_age'] > 0) {
                $userdata['sambaPwdMustChange'] = $time + ( $sambaOptions['max_age'] * 86400 );
            }
        }

        // Set shadow attributes
        if ($shadowOptions['update_shadowLastChange']) {
            $userdata['shadowLastChange'] = floor($time / 86400);
        }
        if ($shadowOptions['update_shadowExpire']) {
            $daysBeforeExpiration = $shadowOptions['shadow_expire_days'];
            if ($daysBeforeExpiration > 0) {
                $userdata['shadowExpire'] = floor(($time / 86400) + $daysBeforeExpiration);
            } else {
                $userdata['shadowExpire'] = $daysBeforeExpiration;
            }
        }

        // Set password value
        if ($adMode) {
            $userdata['unicodePwd'] = $this->passwordEncoder->format('ad', $newpassword);

            if ($adOptions['force_unlock']) {
                $userdata['lockoutTime'] = 0;
            }
            if ($adOptions['force_pwd_change']) {
                $userdata['pwdLastSet'] = 0;
            }
        } else {
            $userdata['userPassword'] = $newpassword;
        }

        $success = ldap_mod_replace($this->ldap, $entryDn, $userdata);
        if (!$success) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Modify password error $errno (".ldap_error($this->ldap).")");
            throw new LdapUpdateFailedException();
        }
    }

    /**
     * @param string $entryDn
     *
     * @return string
     */
    private function findHash($entryDn)
    {
        $searchUserPassword = ldap_read($this->ldap, $entryDn, '(objectClass=*)', ['userPassword']);
        if ($searchUserPassword) {
            $userPassword = ldap_get_values($this->ldap, ldap_first_entry($this->ldap, $searchUserPassword), 'userPassword');
            if (isset($userPassword)) {
                if (preg_match('/^\{(\w+)\}/', $userPassword[0], $matches)) {
                    return strtoupper($matches[1]);
                }
            }
        }

        return 'clear';
    }

    /**
     * Change sshPublicKey attribute
     *
     * @param string $entryDn
     * @param string $sshkey
     *
     * @throws LdapUpdateFailedException
     */
    public function changeSshKey($entryDn, $sshkey)
    {
        $attribute = $this->config['change_sshkey_attribute'];
        $whoChangeSshKey = $this->config['who_change_sshkey'];

        // Rebind as Manager if needed
        if ('manager' === $whoChangeSshKey) {
            $this->rebindAsManager();
        }

        $userdata = [];
        $userdata[$attribute] = $sshkey;

        // Commit modification on directory
        $success = ldap_mod_replace($this->ldap, $entryDn, $userdata);

        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            error_log("LDAP - Modify $attribute error $errno (".ldap_error($this->ldap).")");
            throw new LdapUpdateFailedException();
        }
    }

    /**
     * @param string $error
     *
     * @throws LdapErrorException
     */
    private function throwLdapError($error)
    {
        $errno = ldap_errno($this->ldap);
        error_log("LDAP - $error $errno (".ldap_error($this->ldap).")");
        throw new LdapErrorException();
    }

    /**
     * @param string $login
     *
     * @return resource
     *
     * @throws LdapErrorException
     * @throws LdapInvalidUserCredentialsException
     */
    private function getUserEntry($login)
    {
        $ldapFilter = $this->config['ldap_filter'];
        $ldapBase = $this->config['ldap_base'];

        // Search for user
        $refinedLdapFilter = str_replace("{login}", $login, $ldapFilter);
        $search = ldap_search($this->ldap, $ldapBase, $refinedLdapFilter);
        if (false === $search) {
            $this->throwLdapError('Search error');
        }

        $entry = ldap_first_entry($this->ldap, $search);
        if (false === $entry) {
            error_log("LDAP - User $login not found");
            throw new LdapInvalidUserCredentialsException();
        }

        return $entry;
    }

    /**
     * @param resource $entry
     * @param array    $context
     */
    private function updateContextDn($entry, &$context)
    {
        $userdn = ldap_get_dn($this->ldap, $entry);
        $context['user_dn'] = $userdn;
    }

    /**
     * @param resource $entry
     * @param array    $context
     */
    private function updateContextDisplayName($entry, &$context)
    {
        $fullnameAttribute = $this->config['ldap_fullname_attribute'];
        $displayname = ldap_get_values($this->ldap, $entry, $fullnameAttribute);
        $context['user_displayname'] = $displayname;
    }

    /**
     * @param resource $entry
     * @param array    $context
     */
    private function updateContextMail($entry, &$context)
    {
        $mailAttribute = $this->config['mail_attribute'];
        $mailValues = ldap_get_values($this->ldap, $entry, $mailAttribute);

        $mails = [];
        $mail = null;

        if ($mailValues['count'] > 0) {
            unset($mailValues['count']);

            if (strcasecmp($mailAttribute, 'proxyAddresses') === 0) {
                $removePrefixFn = function ($mailValue) {
                    return str_ireplace('smtp:', '', $mailValue);
                };
                $mailValues = array_map($removePrefixFn, $mailValues);
            }

            $mail = $mailValues[0];
            $mails = $mailValues;
        }

        $context['user_mail'] = $mail;
        $context['user_mails'] = $mails;
    }

    /**
     * @param resource $entry
     * @param array    $context
     */
    private function updateContextSms($entry, &$context)
    {
        $smsAttribute = $this->config['sms_attribute'];
        $smsSanitizeNumber = $this->config['sms_sanitize_number'];
        $smsTruncateNumber = $this->config['sms_truncate_number'];
        $smsTruncateLength = $this->config['sms_truncate_number_length'];

        // Get sms values
        $smsValues = ldap_get_values($this->ldap, $entry, $smsAttribute);

        $context['user_sms_raw'] = null;
        $context['user_sms'] = null;

        // Check sms number
        if ($smsValues["count"] > 0) {
            $sms = $smsValues[0];
            $context['user_sms_raw'] = $sms;
            if ($smsSanitizeNumber) {
                $sms = preg_replace('/[^0-9]/', '', $sms);
            }
            if ($smsTruncateNumber) {
                $sms = substr($sms, -$smsTruncateLength);
            }
            $context['user_sms'] = $sms;
        }
    }

    /**
     * @param resource $entry
     * @param array    $context
     */
    private function updateContextSambaAndShadow($entry, &$context)
    {
        // Check objectClass to allow samba and shadow updates
        $ocValues = ldap_get_values($this->ldap, $entry, 'objectClass');
        if (!in_array('sambaSamAccount', $ocValues) and !in_array('sambaSAMAccount', $ocValues)) {
            $context['user_is_samba_account'] = false;
        }
        if (!in_array('shadowAccount', $ocValues)) {
            $context['user_is_shadow_account'] = false;
        }
    }

    /**
     * @param resource $entry
     * @param array    $context
     */
    private function updateContextQuestions($entry, &$context)
    {
        $answerAttribute = $this->config['answer_attribute'];

        // Get question/answer values
        $questionValues = ldap_get_values($this->ldap, $entry, $answerAttribute);
        unset($questionValues["count"]);

        $context['user_answers'] = [];

        foreach ($questionValues as $questionValue) {
            $context['user_answers'] = $questionValue;
        }
    }

    /**
     * @param string $dn
     * @param string $password
     * @return bool
     */
    private function verifyPasswordWithBind($dn, $password)
    {
        $adMode = $this->config['ad_mode'];
        $adOptions = $this->config['ad_options'];

        // Bind with old password
        $success = ldap_bind($this->ldap, $dn, $password);
        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            if ((49 === $errno) && $adMode) {
                if (ldap_get_option($this->ldap, 0x0032, $extendedError)) {
                    error_log("LDAP - Bind user extended_error $extendedError  (".ldap_error($this->ldap).")");
                    $extendedError = explode(', ', $extendedError);
                    if (strpos($extendedError[2], '773') or strpos($extendedError[0], 'NT_STATUS_PASSWORD_MUST_CHANGE')) {
                        error_log("LDAP - Bind user password needs to be changed");

                        return true;
                    }
                    if (( strpos($extendedError[2], '532') or strpos($extendedError[0], 'NT_STATUS_ACCOUNT_EXPIRED')) and $adOptions['change_expired_password']) {
                        error_log("LDAP - Bind user password is expired");

                        return true;
                    }
                }
            }

            return false;
        }

        return true;
    }

    private function rebindAsManager()
    {
        $ldapBindDn = isset($this->config['ldap_binddn']) ? $this->config['ldap_binddn'] : null;
        $ldapBindPw = isset($this->config['ldap_bindpw']) ? $this->config['ldap_bindpw'] : null;
        ldap_bind($this->ldap, $ldapBindDn, $ldapBindPw);
    }
}
