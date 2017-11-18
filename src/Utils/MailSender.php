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

namespace App\Utils;

use PHPMailer;

class MailSender {
    /** @var PHPMailer */
    private $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    /* @function boolean send_mail(PHPMailer $mailer, string $mail, string $mail_from, string $subject, string $body, array $data)
     * Send a mail, replace strings in body
     * @param mailer PHPMailer object
     * @param mail Destination
     * @param mail_from Sender
     * @param subject Subject
     * @param body Body
     * @param data Data for string replacement
     * @return result
     */
    function send_mail($mail, $mail_from, $mail_from_name, $subject, $body, $data) {

        $result = false;

        if(!is_a($this->mailer, 'PHPMailer')) {
            error_log("send_mail: PHPMailer object required!");
            return $result;
        }

        if (!$mail) {
            error_log("send_mail: no mail given, exiting...");
            return $result;
        }

        /* Replace data in mail, subject and body */
        foreach($data as $key => $value ) {
            $mail = str_replace('{'.$key.'}', $value, $mail);
            $mail_from = str_replace('{'.$key.'}', $value, $mail_from);
            $subject = str_replace('{'.$key.'}', $value, $subject);
            $body = str_replace('{'.$key.'}', $value, $body);
        }

        $this->mailer->setFrom($mail_from, $mail_from_name);
        $this->mailer->addReplyTo($mail_from, $mail_from_name);
        $this->mailer->addAddress($mail);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;

        $result = $this->mailer->send();

        if (!$result) {
            error_log("send_mail: ".$this->mailer->ErrorInfo);
        }

        return $result;
    }
}