<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/smsovh/smsapi-ovh.inc.php';

final class smsOVHTest extends \Mockery\Adapter\Phpunit\MockeryTestCase
{
    public function test_send_sms_by_api_ovh(): void
    {

        $ovh_appkey      = "appkey";
        $ovh_appsecret   = "secret";
        $ovh_consumerkey = "consumerkey";
        $ovh_smssender   = "sender";

        $mobile = "0123456789";
        $message = "my message";

        $mockSmsMessage = Mockery::mock('overload:\Ovh\Sms\Message');

        $mockSmsMessage->shouldreceive('setSender')
                       ->with($ovh_smssender);

        $mockSmsMessage->shouldreceive('addReceiver')
                       ->with("+33123456789");

        $mockSmsMessage->shouldreceive('setIsMarketing')
                       ->with(false);

        $mockSmsMessage->shouldreceive('send')
                       ->andReturn(0);

        $mockSmsApi = Mockery::mock('overload:\Ovh\Sms\SmsApi');

        $mockSmsApi->shouldreceive('getAccounts')
                   ->andReturn(["account1", "account2", "account3"]);

        $mockSmsApi->shouldreceive('setAccount')
                   ->with("account1");

        $mockSmsApi->shouldreceive('createMessage')
                   ->andReturn(new \Ovh\Sms\Message($mockSmsApi));


        $smsInstance = new smsapi\smsOVH($ovh_appkey,
                                         $ovh_appsecret,
                                         $ovh_consumerkey,
                                         $ovh_smssender);

        $res = $smsInstance->send_sms_by_api($mobile, $message);

        $this->assertEquals(0, $res, "Wrong return code by ovh send_sms_by_api function");
    }
}
