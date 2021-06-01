# PwnedPasswords
A library to query Troy Hunt's Pwned Passwords service to see whether or not a password has been included in a public breach.

# Requirements

 - PHP >= 7.2

# Installation
Installing PwnedPasswords is made easy via Composer. Just require the package using the command below, and you are ready to go.

    composer require mxrxdxn/pwned-passwords
    
# Usage
To use the library, you can do something along the lines of the following.
```php
require_once('vendor/autoload.php');

$pp = new PwnedPasswords\PwnedPasswords;

$password = '123456789';

$insecure = $pp->isPwned($password); //returns true or false
```
The `isInsecure` method will return true if the password has been found in the PwnedPasswords API, and false if not.

If you want to build your own thresholds (Ex. display a warning if the password has been found more than once and an error if more than 5x) you can call the `isPwned` method like below.
```php
$pp = new PwnedPasswords\PwnedPasswords;

$password = '123456789';

$insecure = $pp->isPwned($password, true);

if ($insecure) {
    echo 'Oh no — pwned!' . "\n";
    echo sprintf('This password has been seen %d time%s before.', $insecure, ($insecure > 1 ? 's' : ''));
} else {
    echo 'All good!';
}
```

# Issues
Please feel free to use the Github issue tracker to post any issues you have with this library.
