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

// Informations about your web hosting and the attached domain (compulsory)
$domain = 'mydomain.ovh'; // Web hosting id (often domain order with it)
$domainToAttach = 'myotherdomaintoattach.ovh';

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

	// This call will create a "task". The task is the status of the attached domain deletion.
	// You can follow the task on /hosting/web/{serviceName}/tasks/{id}
	$task = $conn->delete('/hosting/web/' . $domain . '/attachedDomain/' . $domainToDetach);

	echo "Task #" . $task['id'] . " is created" . PHP_EOL;

	// we check every 5 seconds if task is done
	// When the task disappears, the task is done
	while ( 1 ) {
		try {
			$wait = $conn->get('/hosting/web/' . $domain . '/tasks/' . $task['id']);
			
			if ( strcmp( $wait['status'], 'error' ) === 0 ) {
				// The task is in error state. Please check your parameters, retry or contact support.
				echo "An error has occured during the task" . PHP_EOL;
				break;
			} elseif ( strcmp( $wait['status'], 'cancelled' ) === 0 ) {
				// The task is in cancelled state. Please check your parameters, retry or contact support.
				echo "Task has been cancelled during the task" . PHP_EOL;
				break;
			}

			echo "Status of task #". $wait['id'] . " is '". $wait['status'] ."'" . PHP_EOL;
		} catch ( \GuzzleHttp\Exception\ClientException $ex) {
			$response = $ex->getResponse();
			if ( $response && $response->getStatusCode() === 404 ) {
				echo "Domain detached from the web hosting" . PHP_EOL;
				break;
			}
			throw $ex;
		}

		sleep(5);
	}

} catch ( Exception $ex ) {
	print_r( $ex->getMessage() );
}
?>
