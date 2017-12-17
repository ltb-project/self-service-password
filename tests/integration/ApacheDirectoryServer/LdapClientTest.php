<?php

namespace App\Tests\Integration\ApacheDirectoryServer;

use App\Service\LdapClient;
use App\Utils\PasswordEncoder;

/**
 * Class LdapClientTest
 */
class LdapClientTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $client = $this->createLdapClient();

        // expect no exception
        $client->connect();
    }

    private function createLdapClient()
    {
        $passwordEncoder = new PasswordEncoder([]);
        $ldapUrl = 'ldap://localhost:10389';
        $ldapUseTls = false;
        $ldapBindDn = 'uid=admin,ou=system';
        $ldapBindPw = 'secret';
        $whoChangePassword = 'user';
        $adMode = false;
        $ldapFilter = '(&(objectClass=person)(uid={login}))';
        $ldapBase = 'ou=People,dc=example,dc=com';
        $hash = 'clear';
        $smsAttribute = 'number';
        $answerObjectClass = "extensibleObject";
        $answerAttribute = 'answer_attribute';
        $whoChangeSshKey = 'user';
        $sshKeyAttribute = 'sshPublicKey';
        $mailAttribute = 'mail';
        $fullnameAttribute = 'cn';
        $adOptions = [];
        $sambaMode = false;
        $sambaOptions = [];
        $shadowOptions = [];
        $mailAddressUseLdap = false;

        $ldapClient = new LdapClient(
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
        );

        return $ldapClient;
    }
}

