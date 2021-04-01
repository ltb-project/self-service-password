# PHP OVH SMS

Send SMS directly from your code using OVH SMS offer.

```php
<?php
/**
 * # Instantiate. Visit https://api.ovh.com/createToken/index.cgi?GET=/sms&GET=/sms/*&PUT=/sms/*&DELETE=/sms/*&POST=/sms/*
 * to get your credentials
 */
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Sms\SmsApi;

$Sms = new SmsApi( $applicationKey,
                $applicationSecret,
                $endpoint,
                $consumer_key);
print_r($Sms->getAccounts());
?>
```

Install
-------

To download this SDK and integrate it inside your PHP application, you can use [Composer](https://getcomposer.org).

Add the repository in your **composer.json** file or, if you don't already have
this file, create it at the root of your project with this content:

```json
{
    "name": "Example Application",
    "description": "This is an example of OVH SMS APIs SDK usage",
    "require": {
        "ovh/php-ovh-sms": "dev-master"
    }
}

```

Then, you can install OVH SMS APIs SDK and dependencies with:

    php composer.phar install

This will install ``ovh/php-ovh-sms`` to ``./vendor``, along with other dependencies
including ``autoload.php``.

Configure
---------

To use this SDK, you'll need API credentials. API credentials allows you to log in and
manage OVH products without ever storing your password.

Even better, the credentials can be configured to only allow access on some specific
features. In this case, we only want the script to access the SMS features.

To generate credentials to access all the SMS features, you can simply visit
https://api.ovh.com/createToken/index.cgi?GET=/sms&GET=/sms/*&PUT=/sms/*&DELETE=/sms/*&POST=/sms/*

And then use the generated credentials in you application.

For more advanced use cases, please consult the [php-ovh](https://github.com/ovh/php-ovh) or
[python-ovh](https://github.com/ovh/python-ovh) wrappers.

Send a test message without specifying a sender using php-ovh-sdk
-------------------------------------

This example will create a new SDK instance, configure it to send a message
to a french number without declaring a sender (a random shortcode will be used).
It will then use this instance to plan a message in the future using the first 
account it finds.

To avoid consuming any credit accidentally, it will delete the message before
actually sending it.

```php
<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Sms\SmsApi;

// Informations about your application
// You may set them to 'NULL' if you are using
// a configuraton file
$applicationKey = "your_app_key";
$applicationSecret = "your_app_secret";
$consumerKey = "your_consumer_key";
$endpoint = 'ovh-eu';

// Init SmsApi object
$Sms = new SmsApi( $applicationKey, $applicationSecret, $endpoint, $consumerKey );

// Get available SMS accounts
$accounts = $Sms->getAccounts();

// Set the account you will use
$Sms->setAccount($accounts[0]);

// Create a new message that will allow the recipient to answer (to FR receipients only)
$Message = $Sms->createMessage(true);
$Message->addReceiver("+33601020304");
$Message->setIsMarketing(false);

// Plan to send it in the future
$Message->setDeliveryDate(new DateTime("2018-02-25 18:40:00"));
$Message->send("Hello world!");

// Get all planned messages
$plannedMessages = $Sms->getPlannedMessages();

// Delete all planned messages
foreach ($plannedMessages as $planned) {
    $planned->delete();
}
?>https://api.ovh.com/createToken/index.cgi
```

Send a test message by using a beforehand declared sender
-------------------------------------

This example will create a new SDK instance, configure it to send a message.
It will then use this instance to plan a message in the future using the first
account it finds and the first sender it finds in the account as the message sender.

To avoid consuming any credit accidentally, it will delete the message before
actually sending it.

```php
<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Sms\SmsApi;

// Informations about your application
// You may set them to 'NULL' if you are using
// a configuraton file
$applicationKey = "your_app_key";
$applicationSecret = "your_app_secret";
$consumerKey = "your_consumer_key";
$endpoint = 'ovh-eu';

// Init SmsApi object
$Sms = new SmsApi( $applicationKey, $applicationSecret, $endpoint, $consumerKey );

// Get available SMS accounts
$accounts = $Sms->getAccounts();

// Set the account you will use
$Sms->setAccount($accounts[0]);

// Get declared senders
$senders = $Sms->getSenders();

// Create a new message
$Message = $Sms->createMessage();
$Message->setSender($senders[0]);
$Message->addReceiver("+33601020304");
$Message->setIsMarketing(false);

// Plan to send it in the future
$Message->setDeliveryDate(new DateTime("2018-02-25 18:40:00"));
$Message->send("Hello world!");

// Get all planned messages
$plannedMessages = $Sms->getPlannedMessages();

// Delete all planned messages
foreach ($plannedMessages as $planned) {
    $planned->delete();
}
?>https://api.ovh.com/createToken/index.cgi
```

## Hacking

**Get the code**:

```
$ git clone https://github.com/ovh/php-ovh-sms.git
$ cd php-ovh-sms
```

**Submit your changes**:

```
$ git commit -sam "change some feature because it makes my life easier"
$ git push
```

And visit Github to submit your change! https://github.com/ovh/php-ovh-sms/pulls

## Related links

- **Order SMS credit**: https://www.ovhtelecom.fr/sms/
- **Get API credentials**: https://api.ovh.com/createToken/index.cgi
- **Contribute**: https://github.com/ovh/php-ovh-sms
- **Report bugs**: https://github.com/ovh/php-ovh-sms/issues
- **Official OVH PHP wrapper**: https://github.com/ovh/php-ovh

## Licence

[3-Clause BSD](https://github.com/ovh/php-ovh-sms/blob/master/LICENSE)

