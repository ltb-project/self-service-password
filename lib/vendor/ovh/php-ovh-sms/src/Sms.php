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
 * This file contains code about \Ovh\Sms\Sms class
 */

namespace Ovh\Sms;

use Ovh\Api;

/**
 * Class to manage a SMS
 *
 * This class provides all methods to get infos about a message
 *
 * @package  Ovh\Sms
 * @category Ovh\Sms
 */
class Sms
{

    /**
     * Contain SmsApi parent object
     *
     * @var \Ovh\Sms\SmsApi
     */
    private $Sms = null;

    /**
     * ID
     *
     * @var string
     */
    private $id = null;

    /**
     * Type
     *
     * @var string
     */
    private $type = null;

    /**
     * Sender
     *
     * @var string
     */
    private $sender = null;

    /**
     * Receiver
     *
     * @var string
     */
    private $receiver = null;

    /**
     * Message
     *
     * @var string
     */
    private $message = null;

    /**
     * Creation DateTime
     *
     * @var DateTime
     */
    private $creationDateTime = null;

    /**
     * Delivery receipt
     *
     * @var int
     */
    private $deliveryReceipt = null;

    /**
     * Price
     *
     * @var string
     */
    private $price = null;

    /**
     * PTT
     *
     * @var int
     */
    private $ptt = null;

    /**
     * Send DateTime
     *
     * @var DateTime
     */
    private $sendDateTime = null;

    /**
     * Tag
     *
     * @var string
     */
    private $tag = null;

    /**
     * Construct a new wrapper instance
     *
     * @param string $application_key    key of your application.
     *                                   For OVH APIs, you can create a application's credentials on
     *                                   https://api.ovh.com/createApp/
     * @param string $application_secret secret of your application.
     * @param string $api_endpoint       name of api selected
     * @param string $consumer_key       If you have already a consumer key, this parameter prevent to do a
     *                                   new authentication
     * @param Client $http_client        instance of http client
     *
     * @throws Exceptions\InvalidParameterException if one parameter is missing or with bad value
     */
    public function __construct(
        $SmsApi,
        $type,
        $id
    ) {
        if (!isset($SmsApi)) {
            throw new \Ovh\Exceptions\InvalidParameterException("SmsApi parameter is empty");
        }
        if (!isset($type)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Type parameter is empty");
        }
        if (!isset($id)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Id parameter is empty");
        }
        if (!is_a($SmsApi, "Ovh\Sms\SmsApi")) {
            throw new \Ovh\Exceptions\InvalidParameterException("SmsApi parameter must be a SmsApi object");
        }

        $this->Sms              = $SmsApi;
        $this->type             = $type;
        $this->id               = $id;
    }


    /**
     * Delete the SMS
     *
     * @return void
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function delete()
    {
        return $this->Sms->getConnection()->delete('/sms/'.$this->Sms->getAccount().'/'.$this->type.'/'.$this->id);
    }


    /**
     * Get creation DateTime
     *
     * @return DateTime
     */
    public function getCreationDateTime()
    {
        return $this->creationDateTime;
    }


    /**
     * Get delivery details
     *
     * @return string
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function getDeliveryDetails()
    {
        $details = $this->Sms->getConnection('/sms/ptts', (object) array("ptt" => $this->ptt));

        return $details['comment'];
    }


    /**
     * Get delivery status
     *
     * @return int
     */
    public function getDeliveryStatus()
    {
        return $this->deliveryReceipt;
    }


    /**
     * Get ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get message content
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * Get message length
     *
     * @return int
     */
    public function getMessageLength()
    {
        return count($this->message);
    }


    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Get receiver
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }


    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }


    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return ($this->type == "jobs" ? "planned" : $this->type);
    }


    /**
     * Get send DateTime
     *
     * @return DateTime
     */
    public function getSendDateTime()
    {
        return $this->sendDateTime;
    }


    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }


    /**
     * Load messages details
     *
     * @return void
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function load()
    {
        $messageDetails         = $this->Sms->getConnection()->get('/sms/'.$this->Sms->getAccount().'/'.$this->type.'/'.$this->id);

        $this->sender           = $messageDetails['sender'];
        $this->receiver         = isset($messageDetails['receiver']) ? $messageDetails['receiver'] : null;
        $this->message          = $messageDetails['message'];
        $this->price            = $messageDetails['credits'];
        $this->creationDateTime = $messageDetails['creationDatetime'];
        $this->sendDateTime     = null;
        $this->tag              = $messageDetails['tag'];

        if (in_array($this->type, array('planned', 'outgoing'))) {
            $this->ptt              = $messageDetails['ptt'];
            $this->deliveryReceipt  = $messageDetails['deliveryReceipt'];
            $this->sendDateTime     = $this->creationDateTime;

            if ($messageDetails['differedDelivery'] > 0) {
                $this->sendDateTime->add(new DateInterval('PT'.$messageDetails['differedDelivery'].'M'));
            }
        }
    }

}
