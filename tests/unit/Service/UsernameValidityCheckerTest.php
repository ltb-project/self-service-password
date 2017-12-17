<?php

namespace App\Tests\Unit\Service;
use App\Service\UsernameValidityChecker;
use Psr\Log\NullLogger;

/**
 * Class UsernameValidityCheckerTest
 */
class UsernameValidityCheckerTest extends \PHPUnit_Framework_TestCase
{
    public function testUsernameCheckerWithoutForbiddenChars()
    {
        //should only accept alpha numeric usernames
        $uvc = new UsernameValidityChecker();
        $uvc->setLogger(new NullLogger());
        $this->assertSame('', $uvc->evaluate('username1'));
        $this->assertSame('', $uvc->evaluate('123422'));
        $this->assertSame('badcredentials', $uvc->evaluate('user_name1'));
        $this->assertSame('badcredentials', $uvc->evaluate('user-name1'));
        $this->assertSame('badcredentials', $uvc->evaluate('user*name1'));
        $this->assertSame('badcredentials', $uvc->evaluate('user&name1'));
    }

    public function testUsernameCheckerWithForbiddenChars()
    {
        //default forbidden chars
        $uvc = new UsernameValidityChecker('*()&|');
        $uvc->setLogger(new NullLogger());
        $this->assertSame('', $uvc->evaluate('username1'));
        $this->assertSame('', $uvc->evaluate('123422'));
        $this->assertSame('', $uvc->evaluate('user_name1'));
        $this->assertSame('', $uvc->evaluate('user-name1'));
        $this->assertSame('badcredentials', $uvc->evaluate('user*name1'));
        $this->assertSame('badcredentials', $uvc->evaluate('user&name1'));
        $this->assertSame('badcredentials', $uvc->evaluate('user|name1'));
        $this->assertSame('badcredentials', $uvc->evaluate('user(name1)'));
    }

}
