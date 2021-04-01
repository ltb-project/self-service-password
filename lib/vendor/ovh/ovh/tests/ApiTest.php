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

namespace Ovh\tests;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use Ovh\Api;

/**
 * Test Api class
 *
 * @package  Ovh
 * @category Ovh
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $application_key;

    /**
     * @var string
     */
    private $consumer_key;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $application_secret;

    /**
     * Define id to create object
     */
    protected function setUp()
    {
        $this->application_key    = 'app_key';
        $this->application_secret = 'app_secret';
        $this->consumer_key       = 'consumer';
        $this->endpoint           = 'ovh-eu';

        $this->client = new Client();
    }

    /**
     * Get private and protected method to unit test it
     *
     * @param string $name
     *
     * @return \ReflectionMethod
     */
    protected static function getPrivateMethod($name)
    {
        $class  = new \ReflectionClass('Ovh\Api');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * Get private and protected property to unit test it
     *
     * @param string $name
     *
     * @return \ReflectionProperty
     */
    protected static function getPrivateProperty($name)
    {
        $class    = new \ReflectionClass('Ovh\Api');
        $property = $class->getProperty($name);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * Test missing $application_key
     */
    public function testMissingApplicationKey()
    {
        $this->setExpectedException('\\Ovh\\Exceptions\\InvalidParameterException', 'Application key');
        new Api(null, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
    }

    /**
     * Test missing $application_secret
     */
    public function testMissingApplicationSecret()
    {
        $this->setExpectedException('\\Ovh\\Exceptions\\InvalidParameterException', 'Application secret');
        new Api($this->application_key, null, $this->endpoint, $this->consumer_key, $this->client);
    }

    /**
     * Test missing $api_endpoint
     */
    public function testMissingApiEndpoint()
    {
        $this->setExpectedException('\\Ovh\\Exceptions\\InvalidParameterException', 'Endpoint');
        new Api($this->application_key, $this->application_secret, null, $this->consumer_key, $this->client);
    }

    /**
     * Test bad $api_endpoint
     */
    public function testBadApiEndpoint()
    {
        $this->setExpectedException('\\Ovh\\Exceptions\\InvalidParameterException', 'Unknown');
        new Api($this->application_key, $this->application_secret, 'i_am_invalid', $this->consumer_key, $this->client);
    }

    /**
     * Test creating Client if none is provided
     */
    public function testClientCreation()
    {
        $api = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key);

        $this->assertInstanceOf('\\GuzzleHttp\\Client', $api->getHttpClient());
    }

    /**
     * Test the compute of time delta
     */
    public function testTimeDeltaCompute()
    {
        $delay = 10;

        $handlerStack = $this->client->getConfig('handler');
        $handlerStack->push(Middleware::mapResponse(function (Response $response) {

            $body = $response->getBody();
            $body->write(time() - 10);

            return $response
                ->withStatus(200)
                ->withBody($body);
        }));

        $invoker  = self::getPrivateMethod('calculateTimeDelta');
        $property = self::getPrivateProperty('time_delta');

        $api = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
        $invoker->invokeArgs($api, []);

        $time_delta = $property->getValue($api);
        $this->assertNotNull($time_delta);
        $this->assertEquals($time_delta, $delay * -1);
    }

    /**
     * Test if consumer key is replaced
     */
    public function testIfConsumerKeyIsReplace()
    {
        $handlerStack = $this->client->getConfig('handler');
        $handlerStack->push(Middleware::mapResponse(function (Response $response) {

            $body = $response->getBody();
            $body->write('{"validationUrl":"https://api.ovh.com/login/?credentialToken=token","consumerKey":"consumer_remote","state":"pendingValidation"}');

            return $response
                ->withStatus(200)
                ->withBody($body);
        }));

        $property = self::getPrivateProperty('consumer_key');

        $api         = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
        $accessRules = [json_decode(' { "method": "GET", "path": "/*" } ')];

        $credentials = $api->requestCredentials($accessRules);

        $consumer_key = $property->getValue($api);

        $this->assertEquals($consumer_key, $credentials["consumerKey"]);
        $this->assertNotEquals($consumer_key, $this->consumer_key);
    }

    /**
     * Test invalid applicationKey
     */
    public function testInvalidApplicationKey()
    {
        $this->setExpectedException(
            '\GuzzleHttp\Exception\ClientException'
        );

        $handlerStack = $this->client->getConfig('handler');
        $handlerStack->push(Middleware::mapResponse(function (Response $response) {

            $body = $response->getBody();
            $body->write('{\"message\":\"Invalid application key\"}');

            return $response
                ->withStatus(401, 'POUET')
                ->withHeader('Content-Type', 'application/json; charset=utf-8')
                ->withHeader('Content-Length', 37)
                ->withBody($body);
        }));

        $property    = self::getPrivateProperty('consumer_key');
        $api         = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
        $accessRules = [json_decode(' { "method": "GET", "path": "/*" } ')];

        $credentials  = $api->requestCredentials($accessRules);
        $consumer_key = $property->getValue($api);

        $this->assertEquals($consumer_key, $credentials["consumerKey"]);
        $this->assertNotEquals($consumer_key, $this->consumer_key);
    }

    /**
     * Test invalid rights
     */
    public function testInvalidRight()
    {
        $this->setExpectedException(
            '\GuzzleHttp\Exception\ClientException'
        );

        $handlerStack = $this->client->getConfig('handler');
        $handlerStack->push(Middleware::mapResponse(function (Response $response) {

            $body = $response->getBody();
            $body->write('{\"message\":\"Invalid credentials\"}');

            return $response
                ->withStatus(403)
                ->withHeader('Content-Type', 'application/json; charset=utf-8')
                ->withHeader('Content-Length', 37)
                ->withBody($body);
        }));

        $api = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);

        $invoker = self::getPrivateMethod('rawCall');
        $invoker->invokeArgs($api, ['GET', '/me']);
    }

    public function testGetConsumerKey()
    {
        $api = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
        $this->assertEquals($this->consumer_key, $api->getConsumerKey());
    }


    /**
     * Test GET query args
     */
    public function testGetQueryArgs()
    {
        $handlerStack = $this->client->getConfig('handler');
        $handlerStack->push(Middleware::mapRequest(function (Request $request) {
            if($request->getUri()->getPath() == "/1.0/auth/time") {
                return $request;
            }

            $query_string = $request->getUri()->getQuery();
            $this->assertEquals($query_string, 'applicationId=49&status=pendingValidation');

            $request = $request->withUri($request->getUri()
                ->withHost('httpbin.org')
                ->withPath('/')
                ->withQuery(''));
            return $request;
        }));
        //$handlerStack->push(Middleware::mapResponse(function (Response $response) {
        //    return $response;
        //}));

        $api = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
        $api->get('/me/api/credential?applicationId=49', ['status' => 'pendingValidation']);
    }

    /**
     * Test GET overlapping query args
     */
    public function testGetOverlappingQueryArgs()
    {
        $handlerStack = $this->client->getConfig('handler');
        $handlerStack->push(Middleware::mapRequest(function (Request $request) {
            if($request->getUri()->getPath() == "/1.0/auth/time") {
                return $request;
            }

            $query_string = $request->getUri()->getQuery();
            $this->assertEquals($query_string, 'applicationId=49&status=expired&test=success');

            $request = $request->withUri($request->getUri()
                ->withHost('httpbin.org')
                ->withPath('/')
                ->withQuery(''));
            return $request;
        }));
        //$handlerStack->push(Middleware::mapResponse(function (Response $response) {
        //    return $response;
        //}));

        $api = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
        $api->get('/me/api/credential?applicationId=49&status=pendingValidation', ['status' => 'expired', 'test' => "success"]);
    }

    /**
     * Test GET boolean query args
     */
    public function testGetBooleanQueryArgs()
    {
        $handlerStack = $this->client->getConfig('handler');
        $handlerStack->push(Middleware::mapRequest(function (Request $request) {
            if($request->getUri()->getPath() == "/1.0/auth/time") {
                return $request;
            }

            $query_string = $request->getUri()->getQuery();
            $this->assertEquals($query_string, 'dryRun=true&notDryRun=false');

            $request = $request->withUri($request->getUri()
                ->withHost('httpbin.org')
                ->withPath('/')
                ->withQuery(''));
            return $request;
        }));
        //$handlerStack->push(Middleware::mapResponse(function (Response $response) {
        //    return $response;
        //}));

        $api = new Api($this->application_key, $this->application_secret, $this->endpoint, $this->consumer_key, $this->client);
        $api->get('/me/api/credential', ['dryRun' => true, 'notDryRun' => false]);
    }

}
