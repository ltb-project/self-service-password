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

class MailNotificationService {
    /** @var MailSender */
    private $mailSender;
    private $mail_from;
    private $mail_from_name;

    public function __construct($mailerSender, $mail_from, $mail_from_name)
    {
        $this->mailSender = $mailerSender;
        $this->mail_from = $mail_from;
        $this->mail_from_name = $mail_from_name;
    }

    public function send($mail, $subject, $body, $data) {
        $success = $this->mailSender->send_mail($mail, $this->mail_from, $this->mail_from_name,$subject, $body, $data);

        if(!$success) {
            error_log("Error while sending email notification to $mail (user ${data['login']})");
        }

        return $success;
    }
}
