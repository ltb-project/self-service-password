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
use App\Exception\LdapInvalidUserCredentialsException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class LdapClient
 */
class MockLdapClient implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $mockData = [];

    public function __construct()
    {
        $this->mockData = [
            'uid=user1,ou=People,dc=example,dc=com' => [
                'givenName' => 'User1GivenName',
                'sn' => 'User1SN',
                'mobile' => '0612345678',
                'displayName' => 'User1 DisplayName',
                'userPassword' => 'password1',
                'mail' => 'user1@example.com',
                'questions' => [
                    'birthday' => 'goodbirthday1',
                ],
            ],
            'uid=user2,ou=People,dc=example,dc=com' => [
                'givenName' => 'User2GivenName',
                'sn' => 'User2SN',
                'mobile' => '0712345678',
                'displayName' => 'User2 DisplayName',
                'userPassword' => 'password2',
                'mail' => 'user2@example.com',
                'questions' => [
                    'birthday' => 'goodbirthday2',
                ],
            ],
        ];
    }

    public function connect()
    {
        // fake connect
        return;
    }

    /**
     * @param $login
     * @param $wanted
     * @param $context
     * @throws LdapInvalidUserCredentialsException
     */
    public function fetchUserEntryContext($login, $wanted, &$context)
    {
        $dn = 'uid=' . $login . ',ou=People,dc=example,dc=com';

        if (!isset($this->mockData[$dn])) {
            throw new LdapInvalidUserCredentialsException();
        }

        $context['user_dn'] = $dn;
        $context['user_sms'] = $this->mockData[$dn]['mobile'];
        $context['user_displayname'] = $this->mockData[$dn]['displayName'];
    }

    /**
     * @param string $oldpassword
     * @param array $context
     *
     * @throws LdapInvalidUserCredentialsException
     */
    public function checkOldPassword($oldpassword, &$context)
    {
        $dn = $context['user_dn'];

        if ($this->mockData[$dn]['userPassword'] !== $oldpassword) {
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
        $dn = 'uid=' . $login . ',ou=People,dc=example,dc=com';

        return $this->mockData[$dn]['questions'][$question] == $answer;
    }

    /**
     * @param string $login
     * @param string $mail
     *
     * @throws LdapEntryFoundInvalidException
     */
    public function checkMail($login, $mail)
    {
        $dn = 'uid=' . $login . ',ou=People,dc=example,dc=com';
        $validMail = $this->mockData[$dn]['mail'];

        if ($mail !== $validMail) {
            throw new LdapEntryFoundInvalidException();
        }
    }

    /**
     * @param string $userdn
     * @param string $question
     * @param string $answer
     */
    public function changeQuestion($userdn, $question, $answer)
    {

    }

    /**
     * @param string $entryDn
     * @param string $newpassword
     * @param string $oldpassword
     * @param array  $context
     */
    public function changePassword($entryDn, $newpassword, $oldpassword, $context)
    {

    }

    /**
     * Change sshPublicKey attribute
     *
     * @param string $entryDn
     * @param string $sshkey
     */
    public function changeSshKey($entryDn, $sshkey)
    {

    }
}
