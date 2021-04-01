<?php
# Copyright (c) 2013-2016, OVH SAS.
# All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are met:
#
#   * Redistributions of source code must retain the above copyright
#     notice, this list of conditions and the following disclaimer.
#   * Redistributions in binary form must reproduce the above copyright
#     notice, this list of conditions and the following disclaimer in the
#     documentation and/or other materials provided with the distribution.
#   * Neither the name of OVH SAS nor the
#     names of its contributors may be used to endorse or promote products
#     derived from this software without specific prior written permission.
#
# THIS SOFTWARE IS PROVIDED BY OVH SAS AND CONTRIBUTORS ``AS IS'' AND ANY
# EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
# WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
# DISCLAIMED. IN NO EVENT SHALL OVH SAS AND CONTRIBUTORS BE LIABLE FOR ANY
# DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
# (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
# LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
# ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
# (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
# SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
/**
 * This file contains code about \Ovh\Sms\Message class
 */

namespace Ovh\Sms;

use Ovh\Api;

/**
 * Class to manage a new message to send
 *
 * This class provides all methods to create a new message
 * and send it through OVH API to one or many receipients.
 *
 * @package  Ovh\Sms
 * @category Ovh\Sms
 */
class Message
{
    /**
     * SMS parent object
     *
     * @var Ovh\Sms\SmsApi
     */
    private $Sms = null;

    /**
     * Sender to use
     *
     * @var string
     */
    private $sender = null;

    /**
     * Receiver to use
     *
     * @var string
     */
    private $receivers = array();

    /**
     * Is message marketing?
     *
     * @var string
     */
    private $isMarketing = true;

    /**
     * Delivery datetime
     *
     * @var DateTime
     */
    private $deliveryDate = null;

    /**
     * Tag of the message
     *
     * @var string
     */
    private $tag = null;

    /**
     * Construct a new wrapper instance
     *
     * @param Ovh\Sms $SmsApi Instance of Ovh\SmsApi
     *
     * @throws \Ovh\Exceptions\InvalidParameterException if one parameter is missing or with bad value
     */
    public function __construct($SmsApi)
    {
        if (!isset($SmsApi)) {
            throw new \Ovh\Exceptions\InvalidParameterException("SmsApi parameter is empty");
        }
        if (!is_a($SmsApi, "Ovh\Sms\SmsApi")) {
            throw new \Ovh\Exceptions\InvalidParameterException("SmsApi parameter must be a SmsApi object");
        }

        $this->Sms = $SmsApi;
    }

    /**
     * Add a receiver to the message
     *
     * @param string $receiver one of the message's receivers
     *
     * @return void
     * @throws \Ovh\Exceptions\InvalidParameterException if receiver is invalid (doesn't match following regex: /^(\+|00)[1-9][0-9]{9,16}$/)
     */
    public function addReceiver($receiver)
    {
        if (preg_match("/^(\+|00)[1-9][0-9]{9,16}$/", $receiver) != 1) {
            throw new \Ovh\Exceptions\InvalidParameterException("Receiver parameter must be a valid international phone number");
        }

        $receiver = preg_replace("/^00/", "+", $receiver);

        if (in_array($receiver, $this->receivers)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Receiver parameter has already been added to the receivers of this message");
        }

        array_push($this->receivers, $receiver);
    }

    /**
     * Send the message
     *
     * @param string $message content of the message
     *
     * @return array
     * @throws \Ovh\Exceptions\InvalidParameterException if a parameter is invalid
     * @throws \GuzzleHttp\Exception\ClientException     if http request is an error
     */
    public function send($message)
    {

        // Manage differed delivery
        $differedPeriod = 0;
        if (!is_null($this->deliveryDate)) {
            $now = new \DateTime('now');
            if ($now > $this->deliveryDate) {
                throw new \Ovh\Exceptions\InvalidParameterException("Delivery date parameter can't be in the past");
            }

            $timeBetween = $this->deliveryDate->diff($now);

            $differedPeriod += ($timeBetween->days * 24 * 60) + ($timeBetween->h * 60) + ($timeBetween->i);
        }

        // Manage coding
        $coding = ($this->is_gsm0338($message) ? '7bit' : '8bit');

        // Prepare request parameters
        $parameters = (object) array('message' => $message, 'receivers' => $this->receivers, 'noStopClause' => !$this->isMarketing, 'differedPeriod' => $differedPeriod, 'coding' => $coding, 'tag' => $this->tag);

        // Manage sender
        if ($this->sender) {
            $parameters->sender = $this->sender;
        } else {
            $parameters->senderForResponse = true;
        }

        return $this->Sms->getConnection()->post($this->Sms->getUri() . "jobs", $parameters);
    }

    /**
     * Set the delivery date of the message
     *
     * @param dateTime $dateTime date when the message should be sent
     *
     * @return void
     */
    public function setDeliveryDate($dateTime)
    {
        if (!isset($dateTime)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Date parameter is empty");
        }
        if (!is_a($dateTime, "DateTime")) {
            throw new \Ovh\Exceptions\InvalidParameterException("Date parameter must be a DateTime object");
        }

        $now = new \DateTime('now');
        if ($now > $dateTime) {
            throw new \Ovh\Exceptions\InvalidParameterException("Date parameter can't be in the past");
        } elseif ($now == $dateTime) {
            $dateTime = null;
        }

        $this->deliveryDate = $dateTime;
    }

    /**
     * Set the marketing information of the message
     * If the message is flaged as marketing, a "STOP" mention will be added
     * at the end of the message. Marketing messages will also be delayed
     * to the next open day if sent by night (22h - 8h) or the weekend.
     *
     * @param bool $isMarketing marketing flag of the message
     *
     * @return void
     */
    public function setIsMarketing($isMarketing)
    {
        $this->isMarketing = $isMarketing;
    }

    /**
     * Set the sender of the message after checking it is a valid sender
     *
     * @param string $sender sender of the message
     *
     * @return void
     * @throws \Ovh\Exceptions\InvalidParameterException if sender is invalid
     */
    public function setSender($sender)
    {
        if (!$this->Sms->checkSender($sender)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Sender parameter is invalid");
        }

        $this->sender = $sender;
    }

    private function is_gsm0338($utf8_string) {

        $gsm0338 = array(
            '@','Δ',' ','0','¡','P','¿','p',
            '£','_','!','1','A','Q','a','q',
            '$','Φ','"','2','B','R','b','r',
            '¥','Γ','#','3','C','S','c','s',
            'è','Λ','¤','4','D','T','d','t',
            'é','Ω','%','5','E','U','e','u',
            'ù','Π','&','6','F','V','f','v',
            'ì','Ψ','\'','7','G','W','g','w',
            'ò','Σ','(','8','H','X','h','x',
            'Ç','Θ',')','9','I','Y','i','y',
            "\n",'Ξ','*',':','J','Z','j','z',
            'Ø',"\x1B",'+',';','K','Ä','k','ä',
            'ø','Æ',',','<','L','Ö','l','ö',
            "\r",'æ','-','=','M','Ñ','m','ñ',
            'Å','ß','.','>','N','Ü','n','ü',
            'å','É','/','?','O','§','o','à', // single size char

            '|','^','€','{','}','[',']','~' // double size char
        );

        $len = mb_strlen($utf8_string, 'UTF-8');

        for( $i=0; $i < $len; $i++) {
            if (!in_array(mb_substr($utf8_string,$i,1,'UTF-8'), $gsm0338)) {
                return false;
            }
        }

        return true;
    }
}
