<?php

class LdapClientTest extends \PHPUnit_Framework_TestCase
{
    public function testHello()
    {
        $ldaprdn  = 'cn=Manager,dc=my-domain,dc=com';
        $ldappass = 'secret';

        $ldapconn = ldap_connect('localhost');
        if(!$ldapconn) {
            $this->fail("could not connect to ldap server");
        }
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

        if ($ldapbind) {
            $this->assertTrue(true, 'Bind OK.');
        } else {
            $this->fail("could not bind to server");
        }
    }
}
