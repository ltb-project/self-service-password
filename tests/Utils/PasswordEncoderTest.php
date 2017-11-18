<?php

namespace App\Tests\Utils;

use App\Utils\PasswordEncoder;

class PasswordEncoderTest extends \PHPUnit_Framework_TestCase {
    public function testHash()
    {
        $hash_options = array();
        $hash_options['crypt_salt_prefix'] = "$6$";
        $hash_options['crypt_salt_length'] = "6";

        $passwordEncoder = new PasswordEncoder($hash_options);

        $hashData = array(
            array('scheme' => 'crypt', 'password' => 'password'),
            array('scheme' => 'CRYPT', 'password' => 'password2'),
            array('scheme' => 'md5', 'password' => 'password'),
            array('scheme' => 'MD5', 'password' => 'password2'),
            array('scheme' => 'smd5', 'password' => 'password'),
            array('scheme' => 'SMD5', 'password' => 'password2'),
            array('scheme' => 'sha', 'password' => 'password'),
            array('scheme' => 'SHA', 'password' => 'password2'),
            array('scheme' => 'ssha', 'password' => 'password'),
            array('scheme' => 'SSHA', 'password' => 'password2'),
            array('scheme' => 'sha256', 'password' => 'password'),
            array('scheme' => 'SHA256', 'password' => 'password2'),
            array('scheme' => 'ssha256', 'password' => 'password'),
            array('scheme' => 'SSHA256', 'password' => 'password2'),
            array('scheme' => 'sha384', 'password' => 'password'),
            array('scheme' => 'SHA384', 'password' => 'password2'),
            array('scheme' => 'ssha384', 'password' => 'password'),
            array('scheme' => 'SSHA384', 'password' => 'password2'),
            array('scheme' => 'sha512', 'password' => 'password'),
            array('scheme' => 'SHA512', 'password' => 'password2'),
            array('scheme' => 'ssha512', 'password' => 'password'),
            array('scheme' => 'SSHA512', 'password' => 'password2'),
        );

        foreach ($hashData as $data) {
            $pass = $passwordEncoder->hash($data['scheme'], $data['password']);
            $this->assertPassword($pass, $data['scheme']);
        }
    }

    private function assertPassword($hashedPassword, $scheme) {
        $this->assertStringStartsWith('{' . strtoupper($scheme) . '}', $hashedPassword);
        $this->assertNotFalse(base64_decode(substr($hashedPassword, strlen($scheme)+2)));
    }

}
