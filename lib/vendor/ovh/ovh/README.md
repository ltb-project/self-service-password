[![PHP Wrapper for OVH APIs](https://github.com/ovh/php-ovh/blob/master/img/logo.png)](https://packagist.org/packages/ovh/ovh)

This PHP package is a lightweight wrapper for OVH APIs. That's the easiest way to use OVH.com APIs in your PHP applications.

[![Build Status](https://travis-ci.org/ovh/php-ovh.svg)](https://travis-ci.org/ovh/php-ovh)
[![HHVM Status](https://img.shields.io/hhvm/ovh/ovh.svg)](http://hhvm.h4cc.de/package/ovh/ovh)

```php
<?php
/**
 * # Instantiate. Visit https://api.ovh.com/createToken/index.cgi?GET=/me
 * to get your credentials
 */
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

$ovh = new Api( $applicationKey,
                $applicationSecret,
                $endpoint,
                $consumer_key);
echo "Welcome " . $ovh->get('/me')['firstname'];
?>
```

Quickstart
----------

To download this wrapper and integrate it inside your PHP application, you can use [Composer](https://getcomposer.org).

Add the repository in your **composer.json** file or, if you don't already have 
this file, create it at the root of your project with this content:

```json
{
    "name": "Example Application",
    "description": "This is an example of OVH APIs wrapper usage",
    "require": {
        "ovh/ovh": "dev-master"
    }
}

```

Then, you can install OVH APIs wrapper and dependencies with:

    php composer.phar install

This will install ``ovh/ovh`` to ``./vendor``, along with other dependencies
including ``autoload.php``.

OVH cookbook
------------

Do you want to use OVH APIs? Maybe the script you want is already written in the [example part](examples/README.md) of this repository!

How to login as a user?
-----------------------

To communicate with APIs, the SDK uses a token on each request to identify the
user. This token is called *Consumer Key*. To have a validated *Consumer Key*,
you need to redirect your user on specific authentication page. Once the user has 
logged in, the token is validated and user will be redirected on __$redirection__ url.

```php
<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

session_start();

// Informations about your application
$applicationKey = "your_app_key";
$applicationSecret = "your_app_secret";
$redirection = "http://your_url.ovh";

// Information about API and rights asked
$endpoint = 'ovh-eu';
$rights = array( (object) [
    'method'    => 'GET',
    'path'      => '/me*'
]);

// Get credentials
$conn = new Api($applicationKey, $applicationSecret, $endpoint);
$credentials = $conn->requestCredentials($rights, $redirection);

// Save consumer key and redirect to authentication page
$_SESSION['consumer_key'] = $credentials["consumerKey"];
header('location: '. $credentials["validationUrl"]);
...
?>
```

How to use OVH API to enable network burst on SBG1 servers?
-----------------------------------------------------------

```php
<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

// Informations about your application
$applicationKey = "your_app_key";
$applicationSecret = "your_app_secret";
$consumer_key = "your_consumer_key";

// Information about API and rights asked
$endpoint = 'ovh-eu';

// Get servers list
$conn = new Api(    $applicationKey,
                    $applicationSecret,
                    $endpoint,
                    $consumer_key);
$servers = $conn->get('/dedicated/server/');

foreach ($servers as $server) {

    // Search servers inside SBG1
    $details = $conn->get('/dedicated/server/'. $server);
    if ($details['datacenter'] == 'sbg1') {

        // Activate burst on server
        $content = (object) array('status' => "active");
        $conn->put('/dedicated/server/'. $server . '/burst', $content);
        echo "We burst " . $server;
    }
}

?>
```
How to customize HTTP client configuration?
-------------------------------------------

You can inject your own HTTP client with your specific configuration. For instance, you can edit user-agent and timeout for all your requests

```php
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

$client = new Client();
$client->setDefaultOption('timeout', 1);
$client->setDefaultOption('headers', array('User-Agent' => 'api_client') );

// Get servers list
$conn = new Api(    $applicationKey,
                    $applicationSecret,
                    $endpoint,
                    $consumer_key,
                    $client);
$webHosting = $conn->get('/hosting/web/');

foreach ($webHosting as $webHosting) {
        echo "One of our web hosting: " . $webHosting . "\n";
```

How to build the documentation?
-------------------------------

Documentation is based on phpdocumentor. To install it with other quality tools,
you can install local npm project in a clone a project

    git clone https://github.com/ovh/php-ovh.git
    cd php-ovh
    php composer.phar install
    npm install

To generate documentation, it's possible to use directly:

    grunt default

Documentation is available in docs/ directory.

How to run tests?
-----------------

Tests are based on phpunit. To install it with other quality tools, you can install
local npm project in a clone a project

    git https://github.com/ovh/php-ovh.git
    cd php-ovh
    php composer.phar install
    npm install

Edit **phpunit.xml** file with your credentials to pass functionals tests. Then,
you can run directly unit and functionals tests with grunt.

    grunt

Supported APIs
--------------

## OVH Europe

 * ```$endpoint = 'ovh-eu';```
 * Documentation: https://eu.api.ovh.com/
 * Community support: api-subscribe@ml.ovh.net
 * Console: https://eu.api.ovh.com/console
 * Create application credentials: https://eu.api.ovh.com/createApp/
 * Create script credentials (all keys at once): https://eu.api.ovh.com/createToken/

## OVH North America

 * ```$endpoint = 'ovh-ca';```
 * Documentation: https://ca.api.ovh.com/
 * Community support: api-subscribe@ml.ovh.net
 * Console: https://ca.api.ovh.com/console
 * Create application credentials: https://ca.api.ovh.com/createApp/
 * Create script credentials (all keys at once): https://ca.api.ovh.com/createToken/

## So you Start Europe

 * ```$endpoint = 'soyoustart-eu';```
 * Documentation: https://eu.api.soyoustart.com/
 * Community support: api-subscribe@ml.ovh.net
 * Console: https://eu.api.soyoustart.com/console/
 * Create application credentials: https://eu.api.soyoustart.com/createApp/
 * Create script credentials (all keys at once): https://eu.api.soyoustart.com/createToken/

## So you Start North America

 * ```$endpoint = 'soyoustart-ca';```
 * Documentation: https://ca.api.soyoustart.com/
 * Community support: api-subscribe@ml.ovh.net
 * Console: https://ca.api.soyoustart.com/console/
 * Create application credentials: https://ca.api.soyoustart.com/createApp/
 * Create script credentials (all keys at once): https://ca.api.soyoustart.com/createToken/

## Kimsufi Europe

 * ```$endpoint = 'kimsufi-eu';```
 * Documentation: https://eu.api.kimsufi.com/
 * Community support: api-subscribe@ml.ovh.net
 * Console: https://eu.api.kimsufi.com/console/
 * Create application credentials: https://eu.api.kimsufi.com/createApp/
 * Create script credentials (all keys at once): https://eu.api.kimsufi.com/createToken/

## Kimsufi North America

 * ```$endpoint = 'kimsufi-ca';```
 * Documentation: https://ca.api.kimsufi.com/
 * Community support: api-subscribe@ml.ovh.net
 * Console: https://ca.api.kimsufi.com/console/
 * Create application credentials: https://ca.api.kimsufi.com/createApp/
 * Create script credentials (all keys at once): https://ca.api.kimsufi.com/createToken/

## Runabove

 * ```$endpoint = 'runabove-ca';```
 * Documentation: https://community.runabove.com/kb/en/instances/how-to-use-runabove-api.html
 * Community support: https://community.runabove.com
 * Console: https://api.runabove.com/console/
 * Create application credentials: https://api.runabove.com/createApp/

## Related links

 * Contribute: https://github.com/ovh/php-ovh
 * Report bugs: https://github.com/ovh/php-ovh/issues

