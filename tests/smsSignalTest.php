<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/smsapi-signal-cli.inc.php';

class smsSignalTest extends \PHPUnit\Framework\TestCase
{

    use \phpmock\phpunit\PHPMock;

    public function test_send_sms_by_api_signal(): void
    {
        $signal_user = "user";
        $signal_config = "config";
        $signal_cli = "cli";

        $mobile = "+33123456789";
        $message = "my message";

        $mock = $this->getFunctionMock("smsapi", "exec");
        $mock->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                $this->assertEquals("cli -u 'user' --config 'config' send -m 'my message' '+33123456789' 2>&1", $command);
                $output = "success";
                $return_var = 0;
            }
        );

        $smsInstance = new smsapi\smsSignal($signal_user,
                                            $signal_config,
                                            $signal_cli);

        $this->assertEquals("$signal_user", $smsInstance->signal_user, "Bad signal user");
        $this->assertEquals("$signal_config", $smsInstance->signal_config, "Bad signal config");
        $this->assertEquals("$signal_cli", $smsInstance->signal_cli, "Bad signal cli");

        $res = $smsInstance->send_sms_by_api($mobile, $message);

        $this->assertEquals(1, $res, "Wrong return code by send_sms_by_api function");
    }

}
