<?php

require_once __DIR__ . '/../htdocs/sendsms.php';

class sendsmsTest extends \PHPUnit\Framework\TestCase
{
    public function testsmstruncate1()
    {
        $sms_truncate_number_length = 10;
        $result = truncate_number("12345678901", $sms_truncate_number_length);
        $this->assertEquals("2345678901", $result);
    }


    public function testsmstruncate2()
    {
        $sms_truncate_number_length = 9;
        $result = truncate_number("12345678901", $sms_truncate_number_length);
        $this->assertEquals("345678901", $result);
    }

    public function testsmstruncate3()
    {
        $sms_truncate_number_length = 0;
        $result = truncate_number("12345678901", $sms_truncate_number_length);
        $this->assertEquals("12345678901", $result);
    }
}