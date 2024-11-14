<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/captcha/FriendlyCaptcha.php';

class FriendlyCaptchaTest extends \PHPUnit\Framework\TestCase
{

    use \phpmock\phpunit\PHPMock;

    public function test_construct(): void
    {
        $friendlycaptcha_apiurl = 'http://127.0.0.1/';
        $friendlycaptcha_sitekey = 'FC12345';
        $friendlycaptcha_secret = 'secret';

        $captchaInstance = new captcha\FriendlyCaptcha($friendlycaptcha_apiurl,
                                                       $friendlycaptcha_sitekey,
                                                       $friendlycaptcha_secret);

        $this->assertEquals('captcha\FriendlyCaptcha', get_class($captchaInstance), "Wrong class");
    }

    public function test_generate_js_captcha(): void
    {
        $friendlycaptcha_apiurl = 'http://127.0.0.1/';
        $friendlycaptcha_sitekey = 'FC12345';
        $friendlycaptcha_secret = 'secret';

        $captchaInstance = new captcha\FriendlyCaptcha($friendlycaptcha_apiurl,
                                                       $friendlycaptcha_sitekey,
                                                       $friendlycaptcha_secret);

        $js = $captchaInstance->generate_js_captcha();

        $this->assertMatchesRegularExpression('/https:\/\/cdn.jsdelivr.net\/npm\/friendly-challenge/i',$js, "dummy js code returned");
    }

    public function test_generate_html_captcha(): void
    {
        $messages = array();

        $friendlycaptcha_apiurl = 'http://127.0.0.1/';
        $friendlycaptcha_sitekey = 'FC12345';
        $friendlycaptcha_secret = 'secret';

        $captchaInstance = new captcha\FriendlyCaptcha($friendlycaptcha_apiurl,
                                                       $friendlycaptcha_sitekey,
                                                       $friendlycaptcha_secret);

        $html = $captchaInstance->generate_html_captcha($messages, "en");

        $this->assertMatchesRegularExpression('/<div class="frc-captcha" data-sitekey="'.$friendlycaptcha_sitekey.'" data-lang="en">/',$html, "dummy challenge in html code");
    }

    public function test_verify_captcha_challenge_ok(): void
    {

        $friendlycaptcha_apiurl = 'http://127.0.0.1/';
        $friendlycaptcha_sitekey = 'FC12345';
        $friendlycaptcha_secret = 'secret';
        $http_response = '{"success": "true"}';

        $captchaInstance = new captcha\FriendlyCaptcha($friendlycaptcha_apiurl,
                                                       $friendlycaptcha_sitekey,
                                                       $friendlycaptcha_secret);

        $error_log = $this->getFunctionMock("captcha", "error_log");
        $error_log->expects($this->any())->willReturn("");
        $stream_context_create = $this->getFunctionMock("captcha", "stream_context_create");
        $stream_context_create->expects($this->once())->willReturn("stream_context_create");
        $file_get_contents = $this->getFunctionMock("captcha", "file_get_contents");
        $file_get_contents->expects($this->once())->willReturn($http_response);

        $_POST["frc-captcha-solution"] = "ABCDE";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('',$captcha, "unexpected return response during verify_captcha_challenge");
    }

    public function test_verify_captcha_challenge_badcaptcha(): void
    {

        $friendlycaptcha_apiurl = 'http://127.0.0.1/';
        $friendlycaptcha_sitekey = 'FC12345';
        $friendlycaptcha_secret = 'secret';
        $http_response = '{"success": "false", "errors": {"0": "solution_invalid"}}';

        $captchaInstance = new captcha\FriendlyCaptcha($friendlycaptcha_apiurl,
                                                       $friendlycaptcha_sitekey,
                                                       $friendlycaptcha_secret);

        $error_log = $this->getFunctionMock("captcha", "error_log");
        $error_log->expects($this->any())->willReturn("");
        $stream_context_create = $this->getFunctionMock("captcha", "stream_context_create");
        $stream_context_create->expects($this->once())->willReturn("stream_context_create");
        $file_get_contents = $this->getFunctionMock("captcha", "file_get_contents");
        $file_get_contents->expects($this->once())->willReturn($http_response);

        $_POST["frc-captcha-solution"] = "ABCDE";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('badcaptcha',$captcha, "unexpected return response during verify_captcha_challenge");
    }

    public function test_verify_captcha_challenge_nocaptcha(): void
    {

        $friendlycaptcha_apiurl = 'http://127.0.0.1/';
        $friendlycaptcha_sitekey = 'FC12345';
        $friendlycaptcha_secret = 'secret';

        $captchaInstance = new captcha\FriendlyCaptcha($friendlycaptcha_apiurl,
                                                       $friendlycaptcha_sitekey,
                                                       $friendlycaptcha_secret);

        $error_log = $this->getFunctionMock("captcha", "error_log");
        $error_log->expects($this->any())->willReturn("");

        unset($_POST);
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('captcharequired',$captcha, "unexpected return response during verify_captcha_challenge");
    }

}
