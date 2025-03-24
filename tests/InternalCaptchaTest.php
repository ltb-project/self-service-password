<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/captcha/InternalCaptcha.php';

class InternalCaptchaTest extends \PHPUnit\Framework\TestCase
{

    use \phpmock\phpunit\PHPMock;

    public function test_construct(): void
    {
        $captchaInstance = new captcha\InternalCaptcha();

        $this->assertEquals('captcha\InternalCaptcha', get_class($captchaInstance), "Wrong class");
    }

    public function test_generate_css_captcha(): void
    {
        $captchaInstance = new captcha\InternalCaptcha();

        $css = $captchaInstance->generate_css_captcha();

        $this->assertMatchesRegularExpression('/captcha-refresh/i',$css, "dummy css code returned");
    }

    public function test_generate_js_captcha(): void
    {
        $captchaInstance = new captcha\InternalCaptcha();

        $js = $captchaInstance->generate_js_captcha();

        $this->assertMatchesRegularExpression('/captcha-refresh/i',$js, "dummy js code returned");
    }

    public function test_generate_html_captcha(): void
    {
        $messages = array("captcha" => "Captcha");

        $captchaMock = $this->getMockBuilder(captcha\InternalCaptcha::class)
            ->onlyMethods(['generate_captcha_challenge'])
            ->getMock();
        $captchaMock->expects($this->once())
                    ->method('generate_captcha_challenge')
                    ->willReturn("my-challenge");

        $html = $captchaMock->generate_html_captcha($messages, "en");

        $this->assertMatchesRegularExpression('/<img src="my-challenge"/',$html, "dummy challenge in html code");
        $this->assertMatchesRegularExpression('/<input type="text" autocomplete="new-password" name="captchaphrase" id="captchaphrase" class="form-control" placeholder="Captcha"/',$html, "dummy captcha input box in html code");
    }

    public function test_generate_captcha_challenge(): void
    {
        $ini_set = $this->getFunctionMock("captcha", "ini_set");
        $ini_set->expects($this->any())->willReturn("dummy");
        $session_name = $this->getFunctionMock("captcha", "session_name");
        $session_name->expects($this->any())->willReturn("dummy");
        $session_start = $this->getFunctionMock("captcha", "session_start");
        $session_start->expects($this->any())->willReturn("dummy");

        $captchaInstance = new captcha\InternalCaptcha();

        $captcha = $captchaInstance->generate_captcha_challenge();

        $this->assertMatchesRegularExpression('/^data:image\/jpeg;base64,/',$captcha, "dummy challenge image");
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9]{5}$/',$_SESSION['phrase'], "dummy challenge text");

    }

    public function test_verify_captcha_challenge(): void
    {

        $_POST["captchaphrase"] = "ABCDE";
        $_SESSION['phrase'] = "ABCDE";

        $ini_set = $this->getFunctionMock("captcha", "ini_set");
        $ini_set->expects($this->any())->willReturn("dummy");
        $setcookie = $this->getFunctionMock("captcha", "setcookie");
        $setcookie->expects($this->any())->willReturn("dummy");
        $session_name = $this->getFunctionMock("captcha", "session_name");
        $session_name->expects($this->any())->willReturn("dummy");
        $session_start = $this->getFunctionMock("captcha", "session_start");
        $session_start->expects($this->any())->willReturn("dummy");

        $captchaInstance = new captcha\InternalCaptcha();

        # Test captcha == phrase : result OK
        $_POST["captchaphrase"] = "ABCDE";
        $_SESSION['phrase'] = "ABCDE";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('',$captcha, "unexpected return response during verify_captcha_challenge");

        # Test captcha != phrase : result KO
        $_POST["captchaphrase"] = "ABCDE";
        $_SESSION['phrase'] = "12345";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('badcaptcha',$captcha, "unexpected return response during verify_captcha_challenge");

        # Test no captcha present : result KO
        unset($_POST);
        $_SESSION['phrase'] = "12345";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('captcharequired',$captcha, "unexpected return response during verify_captcha_challenge");

    }
}
