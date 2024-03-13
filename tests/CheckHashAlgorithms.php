<?php

class CheckHashAlgorithms extends \PHPUnit_Framework_TestCase
{
    function testCheckHashAlgorithms()
    {
        require_once("lib/functions.inc.php");

        $originalPassword = 'TestMe123!+*';

        $hash_algos = array("SSHA", "SSHA256", "SSHA384", "SSHA512", "SHA", "SHA256", "SHA384", "SHA512", "SMD5", "MD5", "CRYPT", "ARGON2", "NTLM", "clear");

        $hash_options=array('crypt_salt_length' => 10, 'crypt_salt_prefix' => "test");

        foreach ($hash_algos as $algo) {
            $hash = make_password($originalPassword, $algo, $hash_options);

            $this->assertEquals(true, check_password($originalPassword, $hash, $algo));
            $this->assertEquals(false, check_password("notSamePassword", $hash, $algo));
        }
    }
}