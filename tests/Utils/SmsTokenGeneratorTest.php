<?php

namespace App\Tests\Utils;

use App\Utils\SmsTokenGenerator;

class SmsTokenGeneratorTest extends \PHPUnit_Framework_TestCase {
    public function testSmsTokenRegex()
    {
        $tg = new SmsTokenGenerator(6);

        $this->assertRegExp('/[0-9]{6}/',  $tg->generate_sms_token());
        $this->assertRegExp('/[0-9]{6}/',  $tg->generate_sms_token());
        $this->assertRegExp('/[0-9]{6}/',  $tg->generate_sms_token());

        $tg = new SmsTokenGenerator(9);

        $this->assertRegExp('/[0-9]{9}/',  $tg->generate_sms_token());
        $this->assertRegExp('/[0-9]{9}/',  $tg->generate_sms_token());
        $this->assertRegExp('/[0-9]{9}/',  $tg->generate_sms_token());
    }

    public function testSmsTokenRandom()
    {
        $tg = new SmsTokenGenerator(9);

        $a = $tg->generate_sms_token();
        $b = $tg->generate_sms_token();
        $c = $tg->generate_sms_token();

        $this->assertNotSame($a , $b);
        $this->assertNotSame($b , $c);
        $this->assertNotSame($a , $c);
    }
}
