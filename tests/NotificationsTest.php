<?php

require_once __DIR__ . '/../lib/vendor/defuse-crypto.phar';

class NotificationsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test send_http function
     */
    public function testNotifications()
    {
	$http_notifications_address = 'https://cataas.com/api/cats';
	$http_notifications_body = array();
	$http_notifications_headers = array(
		"Content-Type: application/json"
	    );
	$http_notifications_method = 'GET';
	$http_notifications_params = array(
		'limit' => '3',
		'type'  => 'small'
	    );

        # Load functions
        require_once("lib/functions.inc.php");

	$data = array( "login" => "dummy", "password" => "blabla" );
	$messageschangemessage = "Bonjour {login}";
	$httpoptions = array(
		"address"     => $http_notifications_address,
		"body"        => $http_notifications_body,
		"headers"     => $http_notifications_headers,
		"method"      => $http_notifications_method,
		"params"      => $http_notifications_params
	    );
	$this->assertEquals(true, send_http($httpoptions, $messageschangemessage, $data));
    }
}
