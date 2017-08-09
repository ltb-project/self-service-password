<?php

require_once __DIR__ . '/../lib/vendor/autoload.php';

class ReCaptchaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verifies that alternative request method is available (for $recaptcha_request_method in config)
     * @dataProvider requestMethodsProvider
     * @param $requestMethod string Request method FQCN
     */
    public function testRequestMethodAvailable($requestMethod)
    {
        $this->assertInstanceOf('\ReCaptcha\RequestMethod', new $requestMethod);
    }

    public function requestMethodsProvider()
    {
        return [
            ['\ReCaptcha\RequestMethod\Post'], // default reCAPTCHA request method
            ['\ReCaptcha\RequestMethod\SocketPost'],
            ['\ReCaptcha\RequestMethod\CurlPost'],
        ];
    }
}

