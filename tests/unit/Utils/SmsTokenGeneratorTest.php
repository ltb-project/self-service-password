<?php

namespace App\Tests\Unit\Utils;

use App\Utils\SmsTokenGenerator;

class SmsTokenGeneratorTest extends \PHPUnit_Framework_TestCase {
    public function testSmsTokenRegex()
    {
        $tg = new SmsTokenGenerator(6);

        $this->assertRegExp('/[0-9]{6}/',  $tg->generateSmsCode());
        $this->assertRegExp('/[0-9]{6}/',  $tg->generateSmsCode());
        $this->assertRegExp('/[0-9]{6}/',  $tg->generateSmsCode());

        $tg = new SmsTokenGenerator(9);

        $this->assertRegExp('/[0-9]{9}/',  $tg->generateSmsCode());
        $this->assertRegExp('/[0-9]{9}/',  $tg->generateSmsCode());
        $this->assertRegExp('/[0-9]{9}/',  $tg->generateSmsCode());
    }

    public function testSmsTokenRandom()
    {
        $tokenGenerator = new SmsTokenGenerator(9);

        $token1 = $tokenGenerator->generateSmsCode();
        $token2 = $tokenGenerator->generateSmsCode();
        $token3 = $tokenGenerator->generateSmsCode();

        $this->assertNotSame($token1 , $token2);
        $this->assertNotSame($token2 , $token3);
        $this->assertNotSame($token1 , $token3);
    }
}
