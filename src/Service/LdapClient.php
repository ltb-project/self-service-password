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
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class LdapClient
 */
class LdapClient implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var array */
    private $config;

    /** @var resource */
    private $ldap;

    /** @var PasswordEncoder */
    private $passwordEncoder;

    private $ldapUrl;
    private $ldapUseTls;
    private $ldapBindDn;
    private $ldapBindPw;
    private $whoChangePassword;
    private $adMode;
    private $ldapBase;
    private $ldapFilter;
    private $hash;
    private $smsAttribute;
    private $answerObjectClass;
    private $answerAttribute;
    private $whoChangeSshKey;
    private $sshKeyAttribute;
    private $mailAttribute;
    private $fullnameAttribute;
    private $adOptions;
    private $sambaMode;
    private $sambaOptions;
    private $shadowOptions;
    private $mailAddressUseLdap;

    /**
     * LdapClient constructor.
     *
     * @param PasswordEncoder $passwordEncoder
     * @param $ldapUrl
     * @param $ldapUseTls
     * @param $ldapBindDn
     * @param $ldapBindPw
     * @param $whoChangePassword
     * @param $adMode
     * @param $ldapFilter
     * @param $ldapBase
     * @param $hash
     * @param $smsAttribute
     * @param $answerObjectClass
     * @param $answerAttribute
     * @param $whoChangeSshKey
     * @param $sshKeyAttribute
     * @param $mailAttribute
     * @param $fullnameAttribute
     * @param $adOptions
     * @param $sambaMode
     * @param $sambaOptions
     * @param $shadowOptions
     * @param $mailAddressUseLdap
     */
    public function __construct(
        $passwordEncoder,
        $ldapUrl,
        $ldapUseTls,
        $ldapBindDn,
        $ldapBindPw,
        $whoChangePassword,
        $adMode,
        $ldapFilter,
        $ldapBase,
        $hash,
        $smsAttribute,
        $answerObjectClass,
        $answerAttribute,
        $whoChangeSshKey,
        $sshKeyAttribute,
        $mailAttribute,
        $fullnameAttribute,
        $adOptions,
        $sambaMode,
        $sambaOptions,
        $shadowOptions,
        $mailAddressUseLdap
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->ldapUrl = $ldapUrl;
        $this->ldapUseTls = $ldapUseTls;
        $this->ldapBindDn = $ldapBindDn;
        $this->ldapBindPw = $ldapBindPw;
        $this->whoChangePassword = $whoChangePassword;
        $this->adMode = $adMode;
        $this->ldapBase = $ldapBase;
        $this->ldapFilter = $ldapFilter;
        $this->hash = $hash;
        $this->smsAttribute = $smsAttribute;
        $this->answerObjectClass = $answerObjectClass;
        $this->answerAttribute = $answerAttribute;
        $this->whoChangeSshKey = $whoChangeSshKey;
        $this->sshKeyAttribute = $sshKeyAttribute;
        $this->mailAttribute = $mailAttribute;
        $this->fullnameAttribute = $fullnameAttribute;
        $this->adOptions = $adOptions;
        $this->sambaMode = $sambaMode;
        $this->sambaOptions = $sambaOptions;
        $this->shadowOptions = $shadowOptions;
        $this->mailAddressUseLdap = $mailAddressUseLdap;
    }

    /**
     * @throws LdapErrorException
     */
    public function connect()
    {
        //Connect to LDAP
        $this->ldap = ldap_connect($this->ldapUrl);
        ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
        if ($this->ldapUseTls && !ldap_start_tls($this->ldap)) {
            $this->logger->alert("LDAP - Unable to use StartTLS");
            throw new LdapErrorException();
        }

        // Bind
        $success = ldap_bind($this->ldap, $this->ldapBindDn, $this->ldapBindPw);
        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            $this->logger->alert("LDAP - Bind error $errno (".ldap_error($this->ldap).")");
            throw new LdapErrorException();
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
            $this->logger->notice("LDAP - Bind user error $errno  (".ldap_error($this->ldap).")");
            throw new LdapInvalidUserCredentialsException();
        }
    }

    // TODO move out ?
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
            $this->logger->notice("Answer does not match question for user $login");

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
        $fetchMailFromLdap = $this->mailAddressUseLdap;

        $context = [];
        $wanted = ['mail'];
        $this->fetchUserEntryContext($login, $wanted, $context);

        if (null === $context['user_mail']) {
            $this->logger->warning("Mail not found for user $login");
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
            $this->logger->notice("Mail $mail does not match for user $login");
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
        // Rebind as Manager if needed
        if ('manager' === $this->whoChangePassword) {
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

        if (!in_array($this->answerObjectClass, $ocValues)) {
            // Answer objectClass is not present, add it
            array_push($ocValues, $this->answerObjectClass);
            $ocValues = array_values($ocValues);
            $userdata["objectClass"] = $ocValues;
        }

        // Question/Answer
        $userdata[$this->answerAttribute] = '{'.$question.'}'.$answer;

        // Commit modification on directory
        $success = ldap_mod_replace($this->ldap, $userdn, $userdata);
        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            $this->logger->critical("LDAP - Modify answer (error $errno (".ldap_error($this->ldap).")");
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
        // Rebind as Manager if needed
        // TODO detect if needed ?
        if ('manager' === $this->whoChangePassword) {
            $this->rebindAsManager();
        }

        $hash = $this->hash;

        // Get hash type if hash is set to auto
        if ('auto' === $hash) {
            $hash = $this->findHash($entryDn);
        }
        // Transform password value
        if ('clear' !== $hash) {
            $newpassword = $this->passwordEncoder->hash($hash, $newpassword);
        }

        // Special case: AD mode with password changed as user
        if ($this->adMode and 'user' === $this->whoChangePassword) {
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
                $this->logger->critical("LDAP - Modify password error $errno (".ldap_error($this->ldap).")");
                throw new LdapUpdateFailedException();
            }

            return;
        }

        // Generic case

        $sambaMode = $this->sambaMode;
        $sambaOptions = $this->sambaOptions;
        if (isset($context['user_is_samba_account']) && false === $context['user_is_samba_account']) {
            $sambaMode = false;
        }

        $shadowOptions = $this->shadowOptions;
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
        if ($this->adMode) {
            $userdata['unicodePwd'] = $this->passwordEncoder->format('ad', $newpassword);

            if ($this->adOptions['enable_force_unlock']) {
                $userdata['lockoutTime'] = 0;
            }
            if ($this->adOptions['enable_force_password_change']) {
                $userdata['pwdLastSet'] = 0;
            }
        } else {
            $userdata['userPassword'] = $newpassword;
        }

        $success = ldap_mod_replace($this->ldap, $entryDn, $userdata);
        if (!$success) {
            $errno = ldap_errno($this->ldap);
            $this->logger->critical("LDAP - Modify password error $errno (".ldap_error($this->ldap).")");
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
        // Rebind as Manager if needed
        if ('manager' === $this->whoChangeSshKey) {
            $this->rebindAsManager();
        }

        $userdata = [];
        $userdata[$this->sshKeyAttribute] = $sshkey;

        // Commit modification on directory
        $success = ldap_mod_replace($this->ldap, $entryDn, $userdata);

        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            $this->logger->critical("LDAP - Modify $this->sshKeyAttribute error $errno (".ldap_error($this->ldap).")");
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
        $this->logger->notice("LDAP - $error $errno (".ldap_error($this->ldap).")");
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
        // Search for user
        $refinedLdapFilter = str_replace("{login}", $login, $this->ldapFilter);
        $search = ldap_search($this->ldap, $this->ldapBase, $refinedLdapFilter);
        if (false === $search) {
            $this->throwLdapError('Search error');
        }

        $entry = ldap_first_entry($this->ldap, $search);
        if (false === $entry) {
            $this->logger->notice("LDAP - User $login not found");
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
        $displayname = ldap_get_values($this->ldap, $entry, $this->fullnameAttribute);
        $context['user_displayname'] = $displayname;
    }

    /**
     * @param resource $entry
     * @param array    $context
     */
    private function updateContextMail($entry, &$context)
    {
        $mailValues = ldap_get_values($this->ldap, $entry, $this->mailAttribute);

        $mails = [];
        $mail = null;

        if ($mailValues['count'] > 0) {
            unset($mailValues['count']);

            if (strcasecmp($this->mailAttribute, 'proxyAddresses') === 0) {
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
        $smsSanitizeNumber = $this->config['sms_sanitize_number'];
        $smsTruncateNumber = $this->config['sms_truncate_number'];
        $smsTruncateLength = $this->config['sms_truncate_number_length'];

        // Get sms values
        $smsValues = ldap_get_values($this->ldap, $entry, $this->smsAttribute);

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
        // Get question/answer values
        $questionValues = ldap_get_values($this->ldap, $entry, $this->answerAttribute);
        unset($questionValues['count']);

        $context['user_answers'] = [];

        foreach ($questionValues as $questionValue) {
            $context['user_answers'] = $questionValue;
        }
    }

    /**
     * @param string $dn
     * @param string $password
     *
     * @return bool
     */
    private function verifyPasswordWithBind($dn, $password)
    {
        // Bind with old password
        $success = ldap_bind($this->ldap, $dn, $password);
        if (false === $success) {
            $errno = ldap_errno($this->ldap);
            if ((49 === $errno) && $this->adMode) {
                if (ldap_get_option($this->ldap, 0x0032, $extendedError)) {
                    $this->logger->notice("LDAP - Bind user extended_error $extendedError  (".ldap_error($this->ldap).")");
                    $extendedError = explode(', ', $extendedError);
                    if (strpos($extendedError[2], '773') or strpos($extendedError[0], 'NT_STATUS_PASSWORD_MUST_CHANGE')) {
                        $this->logger->notice("LDAP - Bind user password needs to be changed");

                        return true;
                    }
                    if (( strpos($extendedError[2], '532') or strpos($extendedError[0], 'NT_STATUS_ACCOUNT_EXPIRED')) and $this->adOptions['enable_change_expired_password']) {
                        $this->logger->notice("LDAP - Bind user password is expired");

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
        ldap_bind($this->ldap, $this->ldapBindDn, $this->ldapBindPw);
    }
}
