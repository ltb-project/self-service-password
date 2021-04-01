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
use GuzzleHttp\Client;

/**
 * Wrapper to manage login and exchanges with Ovh API
 *
 * This class manage how works connections to the simple Ovh API with
 * login method and call wrapper
 * Http connections use guzzle http client api and result of request are
 * object from this http wrapper
 *
 * @package  Ovh\Sms
 * @category Ovh\Sms
 */
class SmsApi
{

    /**
     * Contain API connection
     *
     * @var \Ovh\Api
     */
    private $conn = null;

    /**
     * Account
     *
     * @var string
     */
    private $account = null;

     /**
     * User
     *
     * @var string
     */
    private $user = null;

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
        $application_key,
        $application_secret,
        $api_endpoint,
        $consumer_key = null,
        Client $http_client = null
    ) {
        $this->conn = new \Ovh\Api($application_key, $application_secret, $api_endpoint, $consumer_key, $http_client);
    }


    /**
     * Request a new sender
     *
     * @param string $sender      The sender to add
     * @param string $reason      A short and descriptive reason why to add the sender
     * @param string $description A description of the sender
     *
     * @return void
     * @throws \GuzzleHttp\Exception\ClientException     if http request returns an error
     * @throws \Ovh\Exceptions\InvalidParameterException if one parameter is missing or with bad value
     */
    public function addSender($sender, $reason, $description = "")
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        if (!isset($sender)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Sender parameter is empty");
        }
        if (!isset($reason)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Reason parameter is empty");
        }

        $parameters = (object) array("sender" => $sender, "reason" => $reason, "description" => $description);

        return $this->conn->post("/sms/".$this->account."/senders", $parameters);
    }


    /**
     * Check if an account exists and is enabled
     *
     * @param string $account The account to check
     *
     * @return boolean
     */
    public function checkAccount($account)
    {
        if (!isset($account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Account parameter is empty");
        }

        try {
            $details = $this->getAccountDetails($account);

            if ($details['status'] != "enable") {
                return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * Check if a sender exists and is enabled
     *
     * @param string $sender The sender to check
     *
     * @return boolean
     */
    public function checkSender($sender)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }
        if (!isset($sender)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Sender parameter is empty");
        }

        try {
            $details = $this->getSenderDetails($sender);

            if ($details['status'] != "enable") {
                return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * Check if a user exists
     *
     * @param string $user The user to check
     *
     * @return boolean
     */
    public function checkUser($user)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }
        if (!isset($user)) {
            throw new \Ovh\Exceptions\InvalidParameterException("User parameter is empty");
        }

        try {
            $details = $this->getUserDetails($user);

            if ($details['quotaInformations']['quotaStatus'] != "active") {
                return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * Get the URI to use
     * @return string
     */
    public function getUri()
    {
        $uri = '/sms/' . $this->account . '/';
        if (is_null($this->getUser())) {
            return $uri;
        }
        return $uri . 'users/' . $this->getUser() . '/';
    }


    /**
     * Get an instance of \Ovh\Sms\Message
     * to create a new message to send
     *
     * @param boolean allowingAnswer Whether or not the message
     *                               will allow the recipient to answer
     *
     * @return \Ovh\Sms\Message or \Ovh\Sms\MessageForResponse
     */
    public function createMessage($allowingAnswer = false)
    {
        if ($allowingAnswer) {
            return new \Ovh\Sms\MessageForResponse($this);
        }

        return new \Ovh\Sms\Message($this);
    }


    /**
     * Get all SMS accounts
     *
     * @param string $details Get accounts details or not
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function getAccounts($details = false)
    {
        $accounts = $this->conn->get("/sms/");

        if ($details) {
            foreach ($accounts as $id => $account) {
                $accounts[$id] = $this->getAccountDetails($account);
            }
        }

        return $accounts;
    }


    /**
     * Get details for an account
     *
     * @param string $account Account to get details
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function getAccountDetails($account)
    {
        return $this->conn->get("/sms/$account");
    }



    /**
     * Get the connection to OVH API
     *
     * @return \Ovh\Api
     */
    public function getConnection()
    {
        return $this->conn;
    }


    /**
     * Get the current account to work on
     *
     * @return string
     * @throws \Ovh\Exceptions\InvalidParameterException if account is not set
     */
    public function getAccount()
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        return $this->account;
    }


    /**
     * Get the current user to use
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Get incoming messages
     *
     * @param DateTime $startDateTime Start of the filter interval on the creation date
     * @param DateTime $endDateTime   End of the filter interval on the creation date
     * @param string   $sender        Filter on the sender
     * @param string   $tag           Filter on the tag
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException     if http request returns an error
     * @throws \Ovh\Exceptions\InvalidParameterException if account is not set or parameters are invalid
     */
    public function getIncomingMessages($startDateTime = null, $endDateTime = null, $sender = null, $tag = null)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        // Check and prepare parameters
        $parameters = array();

        if (!is_null($startDateTime)) {
            if (!is_a($startDateTime, "DateTime")) {
                throw new \Ovh\Exceptions\InvalidParameterException("StartDateTime parameter must be a DateTime object");
            }

            $parameters['creationDatetime.from'] = $startDateTime->format(\DateTime::RFC3339);
        }

        if (!is_null($endDateTime)) {
            if (!is_a($endDateTime, "DateTime")) {
                throw new \Ovh\Exceptions\InvalidParameterException("EndDateTime parameter must be a DateTime object");
            }

            $parameters['creationDatetime.to'] = $endDateTime->format(\DateTime::RFC3339);
        }

        if (!is_null($sender)) {
            $parameters['sender'] = $sender;
        }

        if (!is_null($tag)) {
            $parameters['tag'] = $tag;
        }


        // Get messages
        $messages = $this->conn->get($this->getUri() . "incoming", (object) $parameters);

        foreach ($messages as $id => $message) {
            $messages[$id] = new Sms($this, "incoming", $message);
        }

        return $messages;
    }


    /**
     * Get outgoing messages
     *
     * @param DateTime $startDateTime Start of the filter interval on the creation date
     * @param DateTime $endDateTime   End of the filter interval on the creation date
     * @param string   $sender        Filter on the sender
     * @param string   $receiver      Filter on the receiver
     * @param string   $tag           Filter on the tag
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException     if http request returns an error
     * @throws \Ovh\Exceptions\InvalidParameterException if account is not set or parameters are invalid
     */
    public function getOutgoingMessages($dateStart = null, $dateEnd = null, $sender = null, $receiver = null, $tag = null)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        // Check and prepare parameters
        $parameters = array();

        if (!is_null($startDateTime)) {
            if (!is_a($startDateTime, "DateTime")) {
                throw new \Ovh\Exceptions\InvalidParameterException("StartDateTime parameter must be a DateTime object");
            }

            $parameters['creationDatetime.from'] = $startDateTime->format(\DateTime::RFC3339);
        }

        if (!is_null($endDateTime)) {
            if (!is_a($endDateTime, "DateTime")) {
                throw new \Ovh\Exceptions\InvalidParameterException("EndDateTime parameter must be a DateTime object");
            }

            $parameters['creationDatetime.to'] = $endDateTime->format(\DateTime::RFC3339);
        }

        if (!is_null($sender)) {
            $parameters['sender'] = $sender;
        }

        if (!is_null($tag)) {
            $parameters['tag'] = $tag;
        }

        // Get messages
        $messages = $this->conn->get($this->getUri() . "outgoing", (object) $parameters);

        foreach ($messages as $id => $message) {
            $messages[$id] = new Sms($this, "outgoing", $message);
        }

        return $messages;
    }

    /**
     * Get planned
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException     if http request returns an error
     * @throws \Ovh\Exceptions\InvalidParameterException if account is not set or parameters are invalid
     */
    public function getPlannedMessages()
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        // Get messages
        $messages = $this->conn->get($this->getUri() . "jobs");

        foreach ($messages as $id => $message) {
            $messages[$id] = new Sms($this, "jobs", $message);
        }

        return $messages;
    }


    /**
     * Get price for a destination
     *
     * @param string $country         Country where to send the SMS
     * @param string $countryCurrency Country of the currency you want the price in
     * @param int    $quantity        Quantity of SMS in the pack
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException     if http request returns an error
     * @throws \Ovh\Exceptions\InvalidParameterException if account is not set or parameters are invalid
     */
    public function getPrice($country, $countryCurrency, $quantity)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        // Check and prepare parameters
        if (!isset($country)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Country parameter is empty");
        }
        if (!isset($countryCurrency)) {
            throw new \Ovh\Exceptions\InvalidParameterException("CountryCurrency parameter is empty");
        }
        if (!isset($quantity)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Quantity parameter is empty");
        }

        $parameters = array("countryDestination" => $country, "countryCurrencyPrice" => $countryCurrency, "quantity" => $quantity);

        return $this->conn->get("/sms/".$this->account."/seeOffers", (object) $parameters);
    }


    /**
     * Get all senders of current SMS account
     *
     * @param string $details Get senders' details or not
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function getSenders($details = false)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        $senders = $this->conn->get("/sms/".$this->account."/senders");

        if ($details) {
            foreach ($senders as $id => $sender) {
                $senders[$id] = $this->getSenderDetails($sender);
            }
        }

        return $senders;
    }

    /**
     * Get all users of current SMS account
     *
     * @param string $details Get users details or not
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function getUsers($details = false)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        $users = $this->conn->get("/sms/".$this->account."/users");

        if ($details) {
            foreach ($users as $id => $user) {
                $users[$id] = $this->getUserDetails($user);
            }
        }

        return $users;
    }

    /**
     * Get details for a user
     *
     * @param string $user User to get details
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function getUserDetails($user)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        if (!isset($user)) {
            throw new \Ovh\Exceptions\InvalidParameterException("User parameter is empty");
        }

        return $this->conn->get("/sms/".$this->account."/users/$user");
    }

    /**
     * Get details for a sender
     *
     * @param string $sender Sender to get details
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function getSenderDetails($sender)
    {
        if (is_null($this->account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Please set account before using this function");
        }

        if (!isset($sender)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Sender parameter is empty");
        }

        return $this->conn->get("/sms/".$this->account."/senders/".rawurlencode($sender));
    }

    /**
     * Set account to work on
     *
     * @param string $account Account to work on
     *
     * @return void
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function setAccount($account)
    {
        if (!isset($account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Account parameter is empty");
        }

        if (!$this->checkAccount($account)) {
            throw new \Ovh\Exceptions\InvalidParameterException("Account parameter is invalid");
        }

        $this->account = $account;
    }

    /**
     * Set user to use
     *
     * @param string $user User to use
     *
     * @return void
     * @throws \GuzzleHttp\Exception\ClientException if http request returns an error
     */
    public function setUser($user)
    {
        if (!isset($user)) {
            throw new \Ovh\Exceptions\InvalidParameterException("User parameter is empty");
        }

        if (!$this->checkUser($user)) {
            throw new \Ovh\Exceptions\InvalidParameterException("User parameter is invalid");
        }

        $this->user = $user;
    }
}
