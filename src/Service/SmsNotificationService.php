<?php
/*
 * LTB Self Service Password
 *
 * Copyright (C) 2009 Clement OUDOT
 * Copyright (C) 2009 LTB-project.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * GPL License: http://www.gnu.org/licenses/gpl.txt
 */

namespace App\Service;

use App\Utils\MailSender;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class SmsNotificationService
 */
class SmsNotificationService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $smsMethod;
    /** @var MailSender */
    private $mailSender;
    private $smsmailto;
    private $mailFromAddress;
    private $mailFromName;
    private $smsApiLib;

    /**
     * SmsNotificationService constructor.
     * @param string $smsMethod
     * @param string $mailSender
     * @param string $smsMailTo
     * @param string $mailFromAddress
     * @param string $mailFromName
     * @param string $smsApiLib
     */
    public function __construct($smsMethod, $mailSender, $smsMailTo, $mailFromAddress, $mailFromName, $smsApiLib)
    {
        //TODO translator ?
        $this->smsMethod = $smsMethod;
        $this->mailSender = $mailSender;
        $this->smsmailto = $smsMailTo;
        $this->mailFromAddress = $mailFromAddress;
        $this->mailFromName = $mailFromName;
        $this->smsApiLib = $smsApiLib;
    }

    /**
     * @param string $sms
     * @param string $login
     * @param string $smsMailSubject
     * @param string $smsMessage
     * @param array  $data
     * @param string $smsCode
     *
     * @return string
     */
    public function send($sms, $login, $smsMailSubject, $smsMessage, $data, $smsCode)
    {
        if ($this->smsMethod === 'mail') {
            if ($this->mailSender->send($this->smsmailto, $this->mailFromAddress, $this->mailFromName, $smsMailSubject, $smsMessage, $data)) {
                $this->logger->notice("Send SMS code $smsCode by ".$this->smsMethod." to $sms");

                return "smssent";
            }
        }

        if ($this->smsMethod === 'api') {
            if (!$this->smsApiLib) {
                $this->logger->alert('No API library found, set $sms_api_lib in configuration.');

                return "smsnotsent";
            }

            include_once($this->smsApiLib);
            $smsMessage = str_replace('{smsresetmessage}', $data['smsresetmessage'], $smsMessage);
            $smsMessage = str_replace('{smstoken}', $smsCode, $smsMessage);
            if (send_sms_by_api($sms, $smsMessage)) {
                $this->logger->notice("Send SMS code $smsCode by ".$this->smsMethod." to $sms");

                return "smssent";
            }
        }

        $this->logger->critical("Error while sending sms by ".$this->smsMethod." to $sms (user $login)");

        //TODO report invalid sms method
        return 'smsnotsent';
    }
}
