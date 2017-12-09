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

namespace App\Utils;

use PHPMailer;

/**
 * Class MailSender
 */
class MailSender
{
    /** @var PHPMailer */
    private $mailer;

    /**
     * MailSender constructor.
     *
     * @param PHPMailer $mailer
     */
    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send a mail, replace strings in body
     *
     * @param string $mail            Destination
     * @param string $mailFromAddress Sender
     * @param string $mailFromName    Sender name
     * @param string $subject         Subject
     * @param string $body            Body
     * @param array  $data            Data for string replacement
     *
     * @return bool
     */
    public function send($mail, $mailFromAddress, $mailFromName, $subject, $body, $data)
    {

        $result = false;

        if (!is_a($this->mailer, 'PHPMailer')) {
            error_log("send_mail: PHPMailer object required!");

            return $result;
        }

        if (!$mail) {
            error_log("send_mail: no mail given, exiting...");

            return $result;
        }

        /* Replace data in mail, subject and body */
        foreach ($data as $key => $value) {
            $mail = str_replace('{'.$key.'}', $value, $mail);
            $mailFromAddress = str_replace('{'.$key.'}', $value, $mailFromAddress);
            $subject = str_replace('{'.$key.'}', $value, $subject);
            $body = str_replace('{'.$key.'}', $value, $body);
        }

        try {
            $this->mailer->setFrom($mailFromAddress, $mailFromName);

            $this->mailer->addReplyTo($mailFromAddress, $mailFromName);
            $this->mailer->addAddress($mail);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            $result = $this->mailer->send();
        } catch (\phpmailerException $e) {
            error_log("send_mail: ".$e->errorMessage());
        }

        if (!$result) {
            error_log("send_mail: ".$this->mailer->ErrorInfo);
        }

        return $result;
    }
}
