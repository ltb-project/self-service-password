<?php

namespace App\Tests\Utils;

use App\Utils\SmsTokenGenerator;

class SmsTokenGeneratorTest extends \PHPUnit_Framework_TestCase {
    public function testSmsTokenRegex()
    {
        $tg = new SmsTokenGenerator(6);

        $this->assertRegExp('/[0-9]{6}/',  $tg->generate_sms_code());
        $this->assertRegExp('/[0-9]{6}/',  $tg->generate_sms_code());
        $this->assertRegExp('/[0-9]{6}/',  $tg->generate_sms_code());

        $tg = new SmsTokenGenerator(9);

        $this->assertRegExp('/[0-9]{9}/',  $tg->generate_sms_code());
        $this->assertRegExp('/[0-9]{9}/',  $tg->generate_sms_code());
        $this->assertRegExp('/[0-9]{9}/',  $tg->generate_sms_code());
    }

    public function testSmsTokenRandom()
    {
        $tokenGenerator = new SmsTokenGenerator(9);

        $token1 = $tokenGenerator->generate_sms_code();
        $token2 = $tokenGenerator->generate_sms_code();
        $token3 = $tokenGenerator->generate_sms_code();

        $this->assertNotSame($token1 , $token2);
        $this->assertNotSame($token2 , $token3);
        $this->assertNotSame($token1 , $token3);
    }
}
