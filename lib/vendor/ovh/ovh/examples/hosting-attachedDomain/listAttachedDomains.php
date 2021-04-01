<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;
use GuzzleHttp\Client;

// Informations about your application
$applicationKey = "your_app_key";
$applicationSecret = "your_app_secret";
$consumer_key = "your_consumer_key";

// Information about API and rights asked
$endpoint = 'ovh-eu';

// Information about your web hosting(compulsory)
$domain = 'mydomain.ovh'; // Web hosting id (often domain order with it)

$http_client = new Client([
	'timeout'         => 30,
	'connect_timeout' => 5,
]);

// Create a new attached domain
$conn = new Api(    $applicationKey,
                    $applicationSecret,
                    $endpoint,
                    $consumer_key,
		    $http_client);

try {

	$attachedDomainsIds = $conn->get('/hosting/web/' . $domain . '/attachedDomain');

	foreach( $attachedDomainsIds as $attachedDomainsId) {
		$attachedDomain = $conn->get('/hosting/web/' . $domain . '/attachedDomain/' . $attachedDomainsId );
		print_r( $attachedDomain );
	}

} catch ( Exception $ex ) {
	print_r( $ex->getMessage() );
}
?>
