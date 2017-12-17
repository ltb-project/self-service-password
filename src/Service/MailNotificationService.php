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
 * Class MailNotificationService
 */
class MailNotificationService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var MailSender */
    private $mailSender;
    private $mailFromAddress;
    private $mailFromName;

    /**
     * MailNotificationService constructor.
     * @param MailSender $mailerSender
     * @param string     $mailFromAddress
     * @param string     $mailFromName
     */
    public function __construct($mailerSender, $mailFromAddress, $mailFromName)
    {
        $this->mailSender = $mailerSender;
        $this->mailFromAddress = $mailFromAddress;
        $this->mailFromName = $mailFromName;
    }

    /**
     * @param string $mail
     * @param string $subject
     * @param string $body
     * @param array  $data
     *
     * @return boolean
     */
    public function send($mail, $subject, $body, $data)
    {
        $success = $this->mailSender->send($mail, $this->mailFromAddress, $this->mailFromName, $subject, $body, $data);
        if (!$success) {
            $this->logger->critical("Error while sending email notification to $mail (user ${data['login']})");
        }

        return $success;
    }
}
