<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# GPL License: http://www.gnu.org/licenses/gpl.txt
#
#==============================================================================

namespace App\Service;

use App\Utils\MailSender;

class SmsNotificationService {
    private $sms_method;
    /** @var MailSender */
    private $mailSender;
    private $smsmailto;
    private $mail_from;
    private $mail_from_name;
    private $sms_api_lib;
    private $messages;

    public function __construct($sms_method, $mailSender, $smsmailto, $mail_from, $mail_from_name, $sms_api_lib, $messages)
    {
        $this->sms_method = $sms_method;
        if( !$this->sms_method ) { $this->sms_method = "mail"; }
        $this->mailSender = $mailSender;
        $this->smsmailto = $smsmailto;
        $this->mail_from = $mail_from;
        $this->mail_from_name = $mail_from_name;
        $this->sms_api_lib = $sms_api_lib;
        $this->messages = $messages;
    }

    public function send($sms, $login, $smsmail_subject, $sms_message, $data, $smstoken) {
        if ( $this->sms_method === "mail" ) {
            if ( $this->mailSender->send_mail($this->smsmailto, $this->mail_from, $this->mail_from_name, $smsmail_subject, $sms_message, $data) ) {
                if ( !empty($reset_request_log) ) {
                    error_log("Send SMS code $smstoken by " . $this->sms_method . " to $sms\n\n", 3, $reset_request_log);
                } else {
                    error_log("Send SMS code $smstoken by " . $this->sms_method . " to $sms");
                }

                return "smssent";
            }
        }

        if ( $this->sms_method === "api" ) {
            if (!$this->sms_api_lib) {
                error_log('No API library found, set $sms_api_lib in configuration.');
                return "smsnotsent";
            }

            include_once($this->sms_api_lib);
            $sms_message = str_replace('{smsresetmessage}', $this->messages['smsresetmessage'], $sms_message);
            $sms_message = str_replace('{smstoken}', $smstoken, $sms_message);
            if ( send_sms_by_api($sms, $sms_message) ) {
                if ( !empty($reset_request_log) ) {
                    error_log("Send SMS code $smstoken by " . $this->sms_method . " to $sms\n\n", 3, $reset_request_log);
                } else {
                    error_log("Send SMS code $smstoken by " . $this->sms_method . " to $sms");
                }

                return "smssent";
            }
        }

        error_log("Error while sending sms by " . $this->sms_method . " to $sms (user $login)");

        return "smsnotsent";
    }
}
