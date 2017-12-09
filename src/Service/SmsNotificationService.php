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

/**
 * Class SmsNotificationService
 */
class SmsNotificationService
{
    private $smsMethod;
    /** @var MailSender */
    private $mailSender;
    private $smsmailto;
    private $mailFromAddress;
    private $mailFromName;
    private $smsApiLib;
    private $messages;

    /**
     * SmsNotificationService constructor.
     * @param string $smsMethod
     * @param string $mailSender
     * @param string $smsMailTo
     * @param string $mailFromAddress
     * @param string $mailFromName
     * @param string $smsApiLib
     * @param array  $messages
     */
    public function __construct($smsMethod, $mailSender, $smsMailTo, $mailFromAddress, $mailFromName, $smsApiLib, $messages)
    {
        $this->smsMethod = $smsMethod;
        if (!$this->smsMethod) {
            $this->smsMethod = 'mail';
        }
        $this->mailSender = $mailSender;
        $this->smsmailto = $smsMailTo;
        $this->mailFromAddress = $mailFromAddress;
        $this->mailFromName = $mailFromName;
        $this->smsApiLib = $smsApiLib;
        $this->messages = $messages;
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
                //TODO fix bug
                if (!empty($reset_request_log)) {
                    error_log("Send SMS code $smsCode by ".$this->smsMethod." to $sms\n\n", 3, $reset_request_log);
                } else {
                    error_log("Send SMS code $smsCode by ".$this->smsMethod." to $sms");
                }

                return "smssent";
            }
        }

        if ($this->smsMethod === 'api') {
            if (!$this->smsApiLib) {
                error_log('No API library found, set $sms_api_lib in configuration.');

                return "smsnotsent";
            }

            include_once($this->smsApiLib);
            $smsMessage = str_replace('{smsresetmessage}', $this->messages['smsresetmessage'], $smsMessage);
            $smsMessage = str_replace('{smstoken}', $smsCode, $smsMessage);
            if (send_sms_by_api($sms, $smsMessage)) {
                //TODO fix bug
                if (!empty($reset_request_log)) {
                    error_log("Send SMS code $smsCode by ".$this->smsMethod." to $sms\n\n", 3, $reset_request_log);
                } else {
                    error_log("Send SMS code $smsCode by ".$this->smsMethod." to $sms");
                }

                return "smssent";
            }
        }

        error_log("Error while sending sms by ".$this->smsMethod." to $sms (user $login)");

        return 'smsnotsent';
    }
}
