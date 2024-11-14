<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/captcha/ReCaptcha.php';

class ReCaptchaTest extends \PHPUnit\Framework\TestCase
{

    use \phpmock\phpunit\PHPMock;

    public function test_construct(): void
    {
        $recaptcha_url = 'http://127.0.0.1/';
        $recaptcha_sitekey = 'sitekey';
        $recaptcha_secretkey = 'secret';
        $recaptcha_minscore = 0.5;

        $captchaInstance = new captcha\ReCaptcha($recaptcha_url,
                                                 $recaptcha_sitekey,
                                                 $recaptcha_secretkey,
                                                 $recaptcha_minscore);

        $this->assertEquals('captcha\ReCaptcha', get_class($captchaInstance), "Wrong class");
    }

    public function test_generate_js_captcha(): void
    {
        $recaptcha_url = 'http://127.0.0.1/';
        $recaptcha_sitekey = 'sitekey';
        $recaptcha_secretkey = 'secret';
        $recaptcha_minscore = 0.5;

        $captchaInstance = new captcha\ReCaptcha($recaptcha_url,
                                                 $recaptcha_sitekey,
                                                 $recaptcha_secretkey,
                                                 $recaptcha_minscore);

        $js = $captchaInstance->generate_js_captcha();

        $this->assertMatchesRegularExpression('/https:\/\/www.google.com\/recaptcha\/api.js/i',$js, "dummy js code returned");
    }

    public function test_generate_html_captcha(): void
    {
        $messages = array();

        $recaptcha_url = 'http://127.0.0.1/';
        $recaptcha_sitekey = 'sitekey';
        $recaptcha_secretkey = 'secret';
        $recaptcha_minscore = 0.5;

        $captchaInstance = new captcha\ReCaptcha($recaptcha_url,
                                                 $recaptcha_sitekey,
                                                 $recaptcha_secretkey,
                                                 $recaptcha_minscore);

        $html = $captchaInstance->generate_html_captcha($messages, "en");

        $this->assertMatchesRegularExpression('/<input type="hidden" autocomplete="new-password" name="captchaphrase" id="captchaphrase" class="form-control"/',$html, "dummy challenge in html code");
    }

    public function test_verify_captcha_challenge_ok(): void
    {

        $recaptcha_url = 'http://127.0.0.1/';
        $recaptcha_sitekey = 'sitekey';
        $recaptcha_secretkey = 'secret';
        $recaptcha_minscore = 0.5;
        $http_response = '{"success": "true", "score": "0.9"}';

        $captchaInstance = new captcha\ReCaptcha($recaptcha_url,
                                                 $recaptcha_sitekey,
                                                 $recaptcha_secretkey,
                                                 $recaptcha_minscore);

        $error_log = $this->getFunctionMock("captcha", "error_log");
        $error_log->expects($this->any())->willReturn("");
        $stream_context_create = $this->getFunctionMock("captcha", "stream_context_create");
        $stream_context_create->expects($this->once())->willReturn("stream_context_create");
        $file_get_contents = $this->getFunctionMock("captcha", "file_get_contents");
        $file_get_contents->expects($this->once())->willReturn($http_response);

        $_POST["captchaphrase"] = "ABCDE";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('',$captcha, "unexpected return response during verify_captcha_challenge");
    }

    public function test_verify_captcha_challenge_badcaptcha(): void
    {

        $recaptcha_url = 'http://127.0.0.1/';
        $recaptcha_sitekey = 'sitekey';
        $recaptcha_secretkey = 'secret';
        $recaptcha_minscore = 0.5;
        $http_response = '{"success": "false"}';

        $captchaInstance = new captcha\ReCaptcha($recaptcha_url,
                                                 $recaptcha_sitekey,
                                                 $recaptcha_secretkey,
                                                 $recaptcha_minscore);

        $error_log = $this->getFunctionMock("captcha", "error_log");
        $error_log->expects($this->any())->willReturn("");
        $stream_context_create = $this->getFunctionMock("captcha", "stream_context_create");
        $stream_context_create->expects($this->once())->willReturn("stream_context_create");
        $file_get_contents = $this->getFunctionMock("captcha", "file_get_contents");
        $file_get_contents->expects($this->once())->willReturn($http_response);

        $_POST["captchaphrase"] = "ABCDE";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('badcaptcha',$captcha, "unexpected return response during verify_captcha_challenge");
    }

    public function test_verify_captcha_challenge_insufficientscore(): void
    {

        $recaptcha_url = 'http://127.0.0.1/';
        $recaptcha_sitekey = 'sitekey';
        $recaptcha_secretkey = 'secret';
        $recaptcha_minscore = 0.5;
        $http_response = '{"success": "true", "score": "0.4"}';

        $captchaInstance = new captcha\ReCaptcha($recaptcha_url,
                                                 $recaptcha_sitekey,
                                                 $recaptcha_secretkey,
                                                 $recaptcha_minscore);

        $error_log = $this->getFunctionMock("captcha", "error_log");
        $error_log->expects($this->any())->willReturn("");
        $stream_context_create = $this->getFunctionMock("captcha", "stream_context_create");
        $stream_context_create->expects($this->once())->willReturn("stream_context_create");
        $file_get_contents = $this->getFunctionMock("captcha", "file_get_contents");
        $file_get_contents->expects($this->once())->willReturn($http_response);

        $_POST["captchaphrase"] = "ABCDE";
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('badcaptcha',$captcha, "unexpected return response during verify_captcha_challenge");
    }

    public function test_verify_captcha_challenge_nocaptcha(): void
    {

        $recaptcha_url = 'http://127.0.0.1/';
        $recaptcha_sitekey = 'sitekey';
        $recaptcha_secretkey = 'secret';
        $recaptcha_minscore = 0.5;

        $captchaInstance = new captcha\ReCaptcha($recaptcha_url,
                                                 $recaptcha_sitekey,
                                                 $recaptcha_secretkey,
                                                 $recaptcha_minscore);

        $error_log = $this->getFunctionMock("captcha", "error_log");
        $error_log->expects($this->any())->willReturn("");

        unset($_POST);
        $captcha = $captchaInstance->verify_captcha_challenge();
        $this->assertEquals('captcharequired',$captcha, "unexpected return response during verify_captcha_challenge");
    }

}

