<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

// Informations about your application
$applicationKey = "your_app_key";
$applicationSecret = "your_app_secret";
$consumer_key = "your_consumer_key";

// Information about API and rights asked
$endpoint = 'ovh-eu';

// Information about your web hosting
$web_hosting = 'my_domain';

// Get servers list
$conn = new Api(    $applicationKey,
                    $applicationSecret,
                    $endpoint,
                    $consumer_key);
$hosting = $conn->get('/hosting/web/' . $web_hosting );

print_r( $conn->get('/hosting/web/offerCapabilities', array( 'offer' => $hosting['offer'] ) ) );

?>
