<?php

require_once __DIR__ . '/../lib/vendor/defuse-crypto.phar';
require_once __DIR__ . '/../lib/functions.inc.php';

class LdapClientTest extends \PHPUnit_Framework_TestCase
{
    public function testHello()
    {
        $ldaprdn  = 'cn=Manager,dc=my-domain,dc=com';
        $ldappass = 'secret';

        $ldapconn = ldap_connect('localhost');
        if(!$ldapconn) {
            $this->fail("could not connect to ldap server");
            return null;
        }
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

        if ($ldapbind) {
            $this->assertTrue(true, 'Bind OK.');
            return $ldapconn;
        } else {
            $this->fail("could not bind to server");
            return null;
        }
    }

    /**
     * @depends testHello
     */
    public function testChangePassword($ldapconn)
    {
        $dn = 'uid=plewin,ou=People,dc=my-domain,dc=com';
        $password = 'newpassword';
        $ad_mode = false;
        $ad_options = array();
        $samba_mode = false;
        $samba_options = array();
        $shadow_options = array();
        $hash = 'sha';
        $hash_options = array();
        $who_change_password = 'manager';
        $oldpassword = null;

        $result = change_password( $ldapconn, $dn, $password, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, $who_change_password, $oldpassword );

        $this->assertSame($result, 'passwordchanged');
    }

}
