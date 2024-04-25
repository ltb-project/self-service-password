<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/smsapi-twilio.inc.php';

class smsTwilioTest extends \PHPUnit\Framework\TestCase
{

    use \phpmock\phpunit\PHPMock;

    public function test_send_sms_by_api_twilio(): void
    {
        $twilio_sid = "sid";
        $twilio_auth_token = "authtoken";
        $twilio_outgoing_number = "+18881234567";
        $twilio_lookup_first = false;

        $mobile = "+33123456789";
        $message = "my message";


        $mock_init = $this->getFunctionMock("smsapi", "curl_init");
        $mock_init->expects($this->any())->willReturnCallback(
            function () {
                $ch = array();
                return $ch;
            }
        );

        $mock_setopt = $this->getFunctionMock("smsapi", "curl_setopt");
        $mock_setopt->expects($this->any())->willReturnCallback(
            function ($ch, $option, $value) {

                $twilio_sid = "sid";
                $twilio_auth_token = "authtoken";
                $twilio_outgoing_number = "+18881234567";
                $twilio_lookup_first = false;
                $mobile = "+33123456789";
                $message = "my message";

                switch ($option) {
                    case CURLOPT_URL:
                        $this->assertEquals("https://api.twilio.com/2010-04-01/Accounts/" . rawurlencode($twilio_sid) . '/Messages.json' , $value, "Bad Twilio CURLOPT_URL");
                        break;
                    case CURLOPT_USERPWD:
                        $this->assertEquals($twilio_sid . ":" . $twilio_auth_token , $value, "Bad Twilio CURLOPT_USERPWD");
                        break;
                    case CURLOPT_POSTFIELDS:
                        $this->assertEquals('Body=my+message&From=%2B18881234567&To=%2B33123456789' , $value, "Bad Twilio CURLOPT_POSTFIELDS");
                        break;
                }
                $ch[$option] = $value;
            }
        );


        $mock_exec = $this->getFunctionMock("smsapi", "curl_exec");
        $mock_exec->expects($this->once())->willReturnCallback(
            function ($ch) {
                return '{"code": "0", "message": ""}'; # code corresponding to a success
            }
        );

        $mock_getinfo = $this->getFunctionMock("smsapi", "curl_getinfo");
        $mock_getinfo->expects($this->once())->willReturnCallback(
            function ($ch, $option) {
                $this->assertEquals(CURLINFO_HTTP_CODE, $option, "Bad option in Twilio curl_getinfo");
                return "200";
            }
        );

        $mock_close = $this->getFunctionMock("smsapi", "curl_close");
        $mock_close->expects($this->once())->willReturnCallback(
            function ($ch) {
            }
        );

        $smsInstance = new smsapi\smsTwilio($twilio_sid,
                                            $twilio_auth_token,
                                            $twilio_outgoing_number,
                                            $twilio_lookup_first);

        $res = $smsInstance->send_sms_by_api($mobile, $message);

        $this->assertEquals(1, $res, "Wrong return code by twilio send_sms_by_api function");
    }



    public function test_send_sms_by_api_twilio_lookup_first(): void
    {
        $twilio_sid = "sid";
        $twilio_auth_token = "authtoken";
        $twilio_outgoing_number = "+18881234567";
        $twilio_lookup_first = true;

        $mobile = "+33123456789";
        $message = "my message";


        $mock_init = $this->getFunctionMock("smsapi", "curl_init");
        $mock_init->expects($this->any())->willReturnCallback(
            function () {
                $ch = array();
                return $ch;
            }
        );

        $mock_setopt = $this->getFunctionMock("smsapi", "curl_setopt");
        $mock_setopt->expects($this->any())->willReturnCallback(
            function ($ch, $option, $value) {

                $twilio_sid = "sid";
                $twilio_auth_token = "authtoken";
                $twilio_outgoing_number = "+18881234567";
                $twilio_lookup_first = true;
                $mobile = "+33123456789";
                $message = "my message";

                switch ($option) {
                    case CURLOPT_URL:
                        $this->assertEquals('https://lookups.twilio.com/v1/PhoneNumbers/' . rawurlencode($mobile) , $value, "Bad Twilio lookup_first CURLOPT_URL");
                        break;
                    case CURLOPT_USERPWD:
                        $this->assertEquals($twilio_sid . ":" . $twilio_auth_token , $value, "Bad Twilio CURLOPT_USERPWD");
                        break;
                }
                $ch[$option] = $value;
            }
        );


        $mock_exec = $this->getFunctionMock("smsapi", "curl_exec");
        $mock_exec->expects($this->once())->willReturnCallback(
            function ($ch) {
                return '{"code": "1"}'; # code corresponding to an error
            }
        );

        $mock_getinfo = $this->getFunctionMock("smsapi", "curl_getinfo");
        $mock_getinfo->expects($this->once())->willReturnCallback(
            function ($ch, $option) {
                $this->assertEquals(CURLINFO_HTTP_CODE, $option, "Bad option in Twilio curl_getinfo");
                return "200";
            }
        );

        $mock_close = $this->getFunctionMock("smsapi", "curl_close");
        $mock_close->expects($this->once())->willReturnCallback(
            function ($ch) {
            }
        );

        $smsInstance = new smsapi\smsTwilio($twilio_sid,
                                            $twilio_auth_token,
                                            $twilio_outgoing_number,
                                            $twilio_lookup_first);

        $res = $smsInstance->send_sms_by_api($mobile, $message);

        $this->assertEquals(0, $res, "Wrong return code by twilio send_sms_by_api function during first lookup");
    }
}
