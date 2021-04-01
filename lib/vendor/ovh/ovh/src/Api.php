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
 * This file contains code about \Ovh\Api class
 */

namespace Ovh;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Wrapper to manage login and exchanges with simpliest Ovh API
 *
 * This class manage how works connections to the simple Ovh API with
 * login method and call wrapper
 * Http connections use guzzle http client api and result of request are
 * object from this http wrapper
 *
 * @package  Ovh
 * @category Ovh
 */
class Api
{
    /**
     * Url to communicate with Ovh API
     *
     * @var array
     */
    private $endpoints = [
        'ovh-eu'        => 'https://api.ovh.com/1.0',
        'ovh-ca'        => 'https://ca.api.ovh.com/1.0',
        'kimsufi-eu'    => 'https://eu.api.kimsufi.com/1.0',
        'kimsufi-ca'    => 'https://ca.api.kimsufi.com/1.0',
        'soyoustart-eu' => 'https://eu.api.soyoustart.com/1.0',
        'soyoustart-ca' => 'https://ca.api.soyoustart.com/1.0',
        'runabove-ca'   => 'https://api.runabove.com/1.0',
    ];

    /**
     * Contain endpoint selected to choose API
     *
     * @var string
     */
    private $endpoint = null;

    /**
     * Contain key of the current application
     *
     * @var string
     */
    private $application_key = null;

    /**
     * Contain secret of the current application
     *
     * @var string
     */
    private $application_secret = null;

    /**
     * Contain consumer key of the current application
     *
     * @var string
     */
    private $consumer_key = null;

    /**
     * Contain delta between local timestamp and api server timestamp
     *
     * @var string
     */
    private $time_delta = null;

    /**
     * Contain http client connection
     *
     * @var Client
     */
    private $http_client = null;

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
        if (!isset($application_key)) {
            throw new Exceptions\InvalidParameterException("Application key parameter is empty");
        }

        if (!isset($application_secret)) {
            throw new Exceptions\InvalidParameterException("Application secret parameter is empty");
        }

        if (!isset($api_endpoint)) {
            throw new Exceptions\InvalidParameterException("Endpoint parameter is empty");
        }

        if (!array_key_exists($api_endpoint, $this->endpoints)) {
            throw new Exceptions\InvalidParameterException("Unknown provided endpoint");
        }

        if (!isset($http_client)) {
            $http_client = new Client([
                'timeout'         => 30,
                'connect_timeout' => 5,
            ]);
        }

        $this->application_key    = $application_key;
        $this->endpoint           = $this->endpoints[$api_endpoint];
        $this->application_secret = $application_secret;
        $this->http_client        = $http_client;
        $this->consumer_key       = $consumer_key;
        $this->time_delta         = null;
    }

    /**
     * Calculate time delta between local machine and API's server
     *
     * @throws \GuzzleHttp\Exception\ClientException if http request is an error
     * @return int
     */
    private function calculateTimeDelta()
    {
        if (!isset($this->time_delta)) {
            $response         = $this->http_client->get($this->endpoint . "/auth/time");
            $serverTimestamp  = (int)(String)$response->getBody();
            $this->time_delta = $serverTimestamp - (int)\time();
        }

        return $this->time_delta;
    }

    /**
     * Request a consumer key from the API and the validation link to
     * authorize user to validate this consumer key
     *
     * @param array  $accessRules list of rules your application need.
     * @param string $redirection url to redirect on your website after authentication
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\ClientException if http request is an error
     */
    public function requestCredentials(
        array $accessRules,
        $redirection = null
    ) {
        $parameters              = new \StdClass();
        $parameters->accessRules = $accessRules;
        $parameters->redirection = $redirection;

        //bypass authentication for this call
        $response = $this->rawCall(
            'POST',
            '/auth/credential',
            $parameters,
            false
        );

        $this->consumer_key = $response["consumerKey"];

        return $response;
    }

    /**
     * This is the main method of this wrapper. It will
     * sign a given query and return its result.
     *
     * @param string               $method           HTTP method of request (GET,POST,PUT,DELETE)
     * @param string               $path             relative url of API request
     * @param \stdClass|array|null $content          body of the request
     * @param bool                 $is_authenticated if the request use authentication
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request is an error
     */
    private function rawCall($method, $path, $content = null, $is_authenticated = true)
    {
        $url     = $this->endpoint . $path;
        $request = new Request($method, $url);

        if (isset($content) && $method == 'GET') {

            $query_string = $request->getUri()->getQuery();

            $query = array();
            if (!empty($query_string)) {
                $queries = explode('&', $query_string);
                foreach($queries as $element) {
                    $key_value_query = explode('=', $element, 2);
                    $query[$key_value_query[0]] = $key_value_query[1];
                }
            }

            $query = array_merge($query, (array)$content);

            // rewrite query args to properly dump true/false parameters
            foreach($query as $key => $value)
            {
                if ($value === false)
                {
                    $query[$key] = "false";
                }
                elseif ($value === true)
                {
                    $query[$key] = "true";
                }
            }

            $query = \GuzzleHttp\Psr7\build_query($query);

            $url     = $request->getUri()->withQuery($query);
            $request = $request->withUri($url);
            $body    = "";
        } elseif (isset($content)) {
            $body = json_encode($content);

            $request->getBody()->write($body);
        } else {
            $body = "";
        }

        $headers = [
            'Content-Type'      => 'application/json; charset=utf-8',
            'X-Ovh-Application' => $this->application_key,
        ];

        if ($is_authenticated) {
            if (!isset($this->time_delta)) {
                $this->calculateTimeDelta();
            }
            $now = time() + $this->time_delta;

            $headers['X-Ovh-Timestamp'] = $now;

            if (isset($this->consumer_key)) {
                $toSign                     = $this->application_secret . '+' . $this->consumer_key . '+' . $method
                    . '+' . $url . '+' . $body . '+' . $now;
                $signature                  = '$1$' . sha1($toSign);
                $headers['X-Ovh-Consumer']  = $this->consumer_key;
                $headers['X-Ovh-Signature'] = $signature;
            }
        }

        /** @var Response $response */
        $response = $this->http_client->send($request, ['headers' => $headers]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Wrap call to Ovh APIs for GET requests
     *
     * @param string $path    path ask inside api
     * @param array  $content content to send inside body of request
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request is an error
     */
    public function get($path, $content = null)
    {
        return $this->rawCall("GET", $path, $content);
    }

    /**
     * Wrap call to Ovh APIs for POST requests
     *
     * @param string $path    path ask inside api
     * @param array  $content content to send inside body of request
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request is an error
     */
    public function post($path, $content = null)
    {
        return $this->rawCall("POST", $path, $content);
    }

    /**
     * Wrap call to Ovh APIs for PUT requests
     *
     * @param string $path    path ask inside api
     * @param array  $content content to send inside body of request
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request is an error
     */
    public function put($path, $content)
    {
        return $this->rawCall("PUT", $path, $content);
    }

    /**
     * Wrap call to Ovh APIs for DELETE requests
     *
     * @param string $path    path ask inside api
     * @param array  $content content to send inside body of request
     *
     * @return array
     * @throws \GuzzleHttp\Exception\ClientException if http request is an error
     */
    public function delete($path, $content = null)
    {
        return $this->rawCall("DELETE", $path, $content);
    }

    /**
     * Get the current consumer key
     */
    public function getConsumerKey()
    {
        return $this->consumer_key;
    }

    /**
     * Return instance of http client
     */
    public function getHttpClient()
    {
        return $this->http_client;
    }
}
