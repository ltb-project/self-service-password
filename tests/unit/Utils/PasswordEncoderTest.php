<?php

namespace App\Tests\Unit\Utils;

use App\Utils\PasswordEncoder;

class PasswordEncoderTest extends \PHPUnit_Framework_TestCase {
    public function testHash()
    {
        $hash_options = [];
        $hash_options['crypt_salt_prefix'] = "$6$";
        $hash_options['crypt_salt_length'] = "6";

        $passwordEncoder = new PasswordEncoder($hash_options);

        $hashData = [
            ['scheme' => 'crypt', 'password' => 'password'],
            ['scheme' => 'CRYPT', 'password' => 'password2'],
            ['scheme' => 'md5', 'password' => 'password'],
            ['scheme' => 'MD5', 'password' => 'password2'],
            ['scheme' => 'smd5', 'password' => 'password'],
            ['scheme' => 'SMD5', 'password' => 'password2'],
            ['scheme' => 'sha', 'password' => 'password'],
            ['scheme' => 'SHA', 'password' => 'password2'],
            ['scheme' => 'ssha', 'password' => 'password'],
            ['scheme' => 'SSHA', 'password' => 'password2'],
            ['scheme' => 'sha256', 'password' => 'password'],
            ['scheme' => 'SHA256', 'password' => 'password2'],
            ['scheme' => 'ssha256', 'password' => 'password'],
            ['scheme' => 'SSHA256', 'password' => 'password2'],
            ['scheme' => 'sha384', 'password' => 'password'],
            ['scheme' => 'SHA384', 'password' => 'password2'],
            ['scheme' => 'ssha384', 'password' => 'password'],
            ['scheme' => 'SSHA384', 'password' => 'password2'],
            ['scheme' => 'sha512', 'password' => 'password'],
            ['scheme' => 'SHA512', 'password' => 'password2'],
            ['scheme' => 'ssha512', 'password' => 'password'],
            ['scheme' => 'SSHA512', 'password' => 'password2'],
        ];

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
