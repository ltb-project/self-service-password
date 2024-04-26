# LDAP Tool Box Self Service Password

[![CII Best Practices](https://bestpractices.coreinfrastructure.org/projects/372/badge)](https://bestpractices.coreinfrastructure.org/projects/372)
[![Build Status](https://github.com/ltb-project/self-service-password/actions/workflows/ci.yml/badge.svg)](https://github.com/ltb-project/self-service-password/actions/workflows/ci.yml)
[![Documentation Status](https://readthedocs.org/projects/self-service-password/badge/?version=latest)](https://self-service-password.readthedocs.io/en/latest/?badge=latest)

## Presentation

Self Service Password is a PHP application that allows users to change their password in an LDAP directory.

The application can be used on standard LDAPv3 directories (OpenLDAP, OpenDS, ApacheDS, Sun Oracle DSEE, Novell, etc.) and also on Active Directory.

![Screenshot](https://ltb-project.org/documentation/_images/ssp_1_0_change_password.png)

It has the following features:
* Samba mode to change Samba passwords
* Active directory mode
* Password hashing (MD5, SHA, SHA2, Crypt, Argon2)
* Local password policy:
  * Minimum/maximum length
  * Forbidden characters
  * Upper, Lower, Digit or Special characters counters
  * Reuse old password check
  * Password same as login or other LDAP attributes
  * Complexity (different class of characters)
  * Forbidden words
  * Usage of Have I been pawned API
  * Entropy
* Help messages
* Reset by security questions
* Reset by mail challenge (token sent by mail)
* Reset by SMS (trough external Email 2 SMS service or SMS API)
* Change SSH Key in LDAP directory
* Change mail and phone number in LDAP directory
* Captcha (built-in)
* Mail notification after password change
* Hook script before and after password change
* REST API

## Prerequisite

* PHP (>=7.4)
* PHP extensions required:
  * php-curl (haveibeenpwned api)
  * php-gd (captcha)
  * php-filter
  * php-ldap
  * php-mbstring (reset mail)
  * php-openssl (token crypt, probably built-in)
* Smarty >= 3
* strong cryptography functions available (for random_compat, PHP 7 or libsodium or /dev/urandom readable or php-mcrypt extension installed)
* valid PHP mail server configuration
* valid PHP session configuration

## Documentation

Documentation is available on https://self-service-password.readthedocs.io/en/latest/

## Docker

We provide an [official Docker image](https://hub.docker.com/r/ltbproject/self-service-password).

Create a minimal configuration file:
```
vi ssp.conf.php
```
```php
<?php // My SSP configuration
$keyphrase = "mysecret";
$debug = true;
?>
```

And run:
```
docker run -p 80:80 \
    -v $PWD/ssp.conf.php:/var/www/conf/config.inc.local.php \
    -it docker.io/ltbproject/self-service-password:latest
```

## Download

Tarballs and packages for Debian and Red Hat are available on https://ltb-project.org/download.html

Debian and Red Hat repositories are also available, see [installation instructions](https://self-service-password.readthedocs.io/en/latest/installation.html).

## Source code

Source code is available on https://github.com/ltb-project/self-service-password
