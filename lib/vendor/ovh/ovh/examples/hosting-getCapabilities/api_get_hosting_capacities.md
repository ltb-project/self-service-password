How to get web hosting capabilities using php wrapper?
----------------------------------------------------

This documentation will help you to get informations about your web hosting offer: limits, features availables... This documentation is the equivalent of [hostingGetCapabilities SoAPI](https://www.ovh.com/soapi/fr/?method=hostingGetCapabilities)

## Requirements

- Having PHP 5.2+
- Having an hosting account

## Download PHP wrapper

- Download the latest release **with dependencies** on github: https://github.com/ovh/php-ovh/releases

```bash
# When this article is written, latest version is 2.0.0
wget https://github.com/ovh/php-ovh/releases/download/v2.0.0/php-ovh-2.0.0-with-dependencies.tar.gz
```

- Extract it into a folder

```bash
tar xzvf php-ovh-2.0.0-with-dependencies.tar.gz 
```

- Create a new token
You can create a new token using this url: [https://api.ovh.com/createToken/?GET=/hosting/web/my_domain&GET=/hosting/web/offerCapabilities](https://api.ovh.com/createToken/?GET=/hosting/web/my_domain&GET=/hosting/web/offerCapabilities). Keep application key, application secret and consumer key to complete the script.

Be warn, this token is only validated for this script and for hosting called **my_domain**. Please replace **my_domain** by your web hosting reference!
If you need a more generic token, you had to change right field.

- Create php file to get capabilities in the folder. You can download [this file](https://github.com/ovh/php-ovh/blob/master/examples/hosting-getCapabilities/apiv6.php)

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
```

## Run php file

```bash
php getCapabilities.php
```

For instance, for pro2014 account, the answer is
```
Array
(
    [traffic] => 
    [moduleOneClick] => 1
    [privateDatabases] => Array
        (
        )

    [extraUsers] => 1000
    [databases] => Array
        (
            [0] => Array
                (
                    [quota] => Array
                        (
                            [unit] => MB
                            [value] => 400
                        )

                    [type] => sqlPerso
                    [available] => 3
                )

            [1] => Array
                (
                    [quota] => Array
                        (
                            [unit] => MB
                            [value] => 2000
                        )

                    [type] => sqlPro
                    [available] => 1
                )

        )

    [ssh] => 1
    [sitesRecommended] => 10
    [attachedDomains] => 2000
    [crontab] => 1
)
```

## What's more?

You can discover all hosting possibilities by using API console to show all available endpoints: [https://api.ovh.com/console](https://api.ovh.com/console)

