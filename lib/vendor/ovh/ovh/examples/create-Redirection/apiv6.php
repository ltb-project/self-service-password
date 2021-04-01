<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

// Informations about your application
$applicationKey 	= "your_app_key";
$applicationSecret 	= "your_app_secret";
$consumer_key 		= "your_consumer_key";

// Information about API endpoint used
$endpoint 		= 'ovh-eu';

// Information about your domain and redirection
$domain 		= 'yourdomain.ovh';
$subDomain 		= 'www'; // Here, the redirection will come from www.yourdomain.com
$targetDomain 		= 'my_target.ovh';
$type 			= 'visible'; // can be "visible", "invisible", "visiblePermanent"

// Field to set in case of invisible redirection
$title  		= '';
$keywords 		= '';
$description 		= '';

// Get servers list
$conn = new Api(    $applicationKey,
                    $applicationSecret,
                    $endpoint,
                    $consumer_key);

try {

	// check if dns record are available
	$recordIds = $conn->get('/domain/zone/' . $domain . '/record?subDomain='. $subDomain );

	// If subdomain is not defined, we don't want to delete all A, AAAA and CNAME records
	if ( isset($subDomain) ) {
		foreach ($recordIds as $recordId) {
			$record = $conn->get('/domain/zone/' . $domain . '/record/' . $recordId);

			// If record include A, AAAA or CNAME for subdomain asked, we delete it
			if ( in_array( $record['fieldType'], array( 'A', 'AAAA', 'CNAME' ) ) ) {

				echo "We will delete field " . $record['fieldType'] . " for " . $record['subDomain'] . $record['zone'] . PHP_EOL;
				$conn->delete('/domain/zone/' . $domain . '/record/' . $recordId);
			}
		}
	}

	// Now, we are ready to create our new redirection
	$redirection = $conn->post('/domain/zone/' . $domain . '/redirection', array(
		'subDomain' 	=> $subDomain,
		'target' 	=> $targetDomain,
		'type'		=> $type,
		'title'		=> $title,
		'description'	=> $description,
		'keywords'	=> $keywords,
	));

	// We apply zone changes
	$conn->post('/domain/zone/' . $domain . '/refresh');

	print_r( $redirection );

} catch ( Exception $ex ) {
	print_r( $ex->getMessage() );
}
?>
