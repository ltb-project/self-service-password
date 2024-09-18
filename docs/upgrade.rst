Upgrade
=======

From 1.6 to 1.7
---------------

Cache configuration
~~~~~~~~~~~~~~~~~~~

A new cache system has been introduced in version 1.7 of Self-Service-Password. Your version will be automatically migrated to this new cache system, with a ``File`` adapter. You can also define a ``Redis`` adapter. New cache parameters in ``config.inc.php`` will work as they are, but you can adapt them if needed. See the :ref:`cache configuration<config_cache>` for more information.

If you have configured ``$token_lifetime`` parameter, for example for reset by sms or reset by mail features, you should verify that the duration is coherent with the new :ref:`cache parameters<config_cache>`, and adapt these parameters in your local configuration file if needed:

.. code-block:: php

   # $cache_token_expiration: integer, duration in seconds of cached objects
   # each time a token is involved
   # (for example when sending a token by sms or by mail)
   # it is recommended to set a value >= $token_lifetime
   $cache_token_expiration = 3600;
   # $cache_form_expiration: integer, duration in seconds of cached objects
   # at some steps when a user has to validate a form
   # (for example when validating the email address before we send the mail)
   # it is recommended to set a value high enough for a user to fill a form
   $cache_form_expiration = 120;

New Dependencies
~~~~~~~~~~~~~~~~

New bundled dependencies have been added:

* php-symfony-deprecation-contracts = v2.5.3
* php-symfony-var-exporter = v5.4.40
* php-psr-container = 1.1.2
* php-symfony-service-contracts = v2.5.3
* php-psr-cache = 1.0.1
* php-symfony-cache-contracts = v2.5.3
* php-psr-log = 1.1.4
* php-symfony-cache = v5.4.42
* php-predis-predis = v2.2.2

New ldap parameter
~~~~~~~~~~~~~~~~~~

You can now retrieve users with a paged search, for example if your directory does not allow you to get all entries at once.

You can enable this feature by setting a non-zero value to the page size parameter:

.. code-block:: php

   $ldap_page_size = 100;

From 1.5 to 1.6
---------------

SMS configuration
~~~~~~~~~~~~~~~~~

We now demand by default the telephone number to the user, if you want to ask only the login and to read the telephone number from LDAP:

.. code-block:: php

   $sms_use_ldap = true;

The default notification's behaviour for sms is obscured. To change this behaviour into explicit information for the user ( for example: wrong username, wrong phone number), the following option must be set to false:

.. code-block:: php

   $obscure_notfound_sendsms = false;

Option obscure_failure_messages
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The option obscure_failure_messages has been removed in favor of the specific options for Mail and SMS:

.. code-block:: php

   $obscure_usernotfound_sendtoken = true;
   $obscure_notfound_sendsms = true;

SMS API
~~~~~~~

If you use SMS API, you need to update the smsapi files.

smsapi files describe the connection to a SMS API for password reset.

Currently, three files are bundled in self-service-password:

* ``lib/smsapi-signal-cli.inc.php``
* ``lib/smsapi-twilio.inc.php``
* ``lib/smsovh/smsapi-ovh.inc.php``

The admin can create his own smsapi file, as described in the documentation:

:doc:`config_sms`

Before version 1.6.0, the smsapi file only had to contain a ``send_sms_by_api`` function.

Here are the required adaptations:

* you have to define a namespace as first directive of the file: ``namespace smsapi;``

* you have to transform the file into a class:

.. code-block:: php

   namespace smsapi;

   class smsMyCustomApi
   {
   }

* if you need extra parameters, you should declare them as private properties of the class, and define the corresponding constructor:

.. code-block:: php

   namespace smsapi;

   class smsMyCustomApi
   {
       private $param1;
       private $param2;

       public function __construct($param1, $param2)
       {
            $this->param1 = $param1;
            $this->param2 = $param2;
       }
   }


* you should adapt the parameters configured above in the ``send_sms_by_api`` function, by using ``$this->my-param``:

.. code-block:: php

   function send_sms_by_api($mobile, $message) {
       if (!$this->param1 || !$this->param2 ) {
         error_log('Missing parameter');
         return 0;
       }
       ...
       return 1;
   }

* the configuration keys present in ``config.inc.php`` or ``config.inc.local.php`` will automatically be passed to the smsapi constructor. In the example shown above, you should define two parameters in ``config.inc.local.php``:

.. code-block:: php

   $param1 = "value1";
   $param2 = "value2";


Bundled dependencies
~~~~~~~~~~~~~~~~~~~~

The dependencies are now explicitly listed in the self-service-password package, including the bundled ones.

You can find bundled dependencies list:

* in package description in debian package
* in Provides field in rpm package

The license of self-service-password is still GPL2+, but now the bundled dependencies licenses are also listed:

* in copyright file for deb package
* in License tag in rpm package

Configuration location
~~~~~~~~~~~~~~~~~~~~~~

The configuration files are now in ``/etc/self-service-password`` directory.

During the upgrade process towards 1.6, the previous configuration files present in ``/usr/share/self-service-password/conf`` (all .php files) are migrated to ``/etc/self-service-password/``:

* ``config.inc.php`` is migrated as a ``config.inc.php.bak`` file,
* all other php file names are preserved. (including local conf, domain conf, and customized lang files)

Please take in consideration that ``config.inc.php`` is now replaced systematically by the version in the RPM package. A .rpmsave backup will be done with the current version. The deb package will continue asking which file to use, it is advised to replace the current one with the version in the package.

The very old configuration files, present directly under ``/usr/share/self-service-password/`` are **NOT** migrated during the upgrade process, and must be upgraded manually. These files have been deprecated since version 0.9, released in 2015 of October. If you are migrating from version this old, you must move your configuration files manually. Move your ``config.inc.local.php`` into ``/etc/self-service-password``. If you have modified ``config.inc.php``, just identify the modified parameters and add/replace them into a ``/etc/self-service-password/config.inc.local.php``. Avoid as much as possible editing the ``/etc/self-service-password/config.inc.php`` file.

Reset URL
~~~~~~~~~

To avoid any security issue, the `$reset_url` is now initialized to a default value, that you need to configure.

If you run in a virtual host or behind a reverse proxy virtual host, you can use generic values. For example:

.. code-block:: php

   $reset_url = ($_SERVER['HTTPS'] ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];

Else you need to force the URL according to the DNS of the application:

.. code-block:: php

   $reset_url = "https://reset.acme.com";

Cache cleaning
~~~~~~~~~~~~~~

Now the cache is being cleaned-up during self-service-password upgrade / install.

This is intended to avoid smarty problems due to self-service-password templates upgrade, and possibly smarty upgrade itself.

RPM GPG key
~~~~~~~~~~~

GPG key has changed for EL9, you need to import it before upgrade:

.. prompt:: bash #

    rpm --import https://ltb-project.org/documentation/_static/RPM-GPG-KEY-LTB-PROJECT-SECURITY

Dependencies update
~~~~~~~~~~~~~~~~~~~

Packaged dependencies:

* smarty is now a required package. self-service-password will work with either version 3 or 4.
* php >= 7.4 is now required (previously version 5)
* sed is a now a required package
* php-gd, php-ldap and php-mbstring have been kept as dependencies

Bundled dependencies:

* bjeavons-zxcvbn-php 1.3.1 is a new dependency used for computing password entropy
* defuse-php-encryption has been updated from version 2.0.3 to version 2.4.0
* gregwar-captcha has been updated from version 1.1.9 to version 1.2.1
* guzzlehttp-guzzle has been updated from version 7.4.5 to version 7.8.1
* guzzlehttp-promises has been updated from version 1.5.1 to version 2.0.2
* guzzlehttp-psr7 has been updated from version 2.5.0 to version 2.6.2
* some functions of self-service-password have been externalized in ltb-project-ldap 0.1.0 php library
* mxrxdxn-pwned-passwords has been kept in version 2.1.0
* phpmailer has been updated from version 6.5.3 to version 6.9.1
* psr-http-client has been updated from version 1.0.1 to version 1.0.3
* psr-http-factory has been kept in version 1.0.2
* psr-http-message has been updated from version 1.1 to version 2.0
* ralouphie-getallheaders has been kept in version 3.0.3
* symfony-deprecation-contracts has been updated from version 2.5.1 to version 3.4.0
* symfony-finder has been updated from version 5.3.7 to version 7.0.0
* symfony-polyfill has been updated from version 1.23.1 to version 1.29.0
* bootstrap has been updated from version 3.4.1 to version 5.3.3
* jquery has been updated from version 3.5.1 to version 3.7.1
* jquery-selectunique has been kept in version 0.1.0
* font-awesome has been updated from version 4.7.0 to version 6.5.1

Note that hidden files (.gitignore, ...) from bundled dependencies are now removed from packages.

For developers
~~~~~~~~~~~~~~

During the build process of rpm or deb packages, the unit tests are now run:

* for any version of debian / ubuntu
* for fedora OS

From 1.4 to 1.5
---------------

Multiple attributes for mail and mobile
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can now configure multiple LDAP attributes for mail and mobile. The search will be done in each attribute, the first value found will be used.

The old parameters ``$mail_attribute`` and ``$sms_attribute`` need to be replaced by ``$mail_attributes`` and ``$sms_attributes`` which are now an array of values:

.. code-block:: php

    $mail_attributes = array( "mail", "gosaMailAlternateAddress", "proxyAddresses" );
    $sms_attributes = array( "mobile", "pager", "ipPhone", "homephone" );

Rate limit
~~~~~~~~~~

Now :ref:`rate limit configuration<config_rate_limit>` is applied to all features:

* Password change
* Password reset by questions
* Password reset by tokens (mail or SMS)
* SSH key change

.. tip::

    Before 1.5, it was just used with tokens.

Another improvement is the possibility to adapt rate limit by IP, see ``$ratelimit_filter_by_ip_jsonfile`` parameter.

Argon2
~~~~~~

The password can now be hashed with Argon2. To use it, just set it into ``$hash`` parameter:

.. code-block:: php

    $hash = "ARGON2";

Security
~~~~~~~~

We now hide by default the error "mail not found", this can be reverted by editing the ``$obscure_failure_messages`` parameter. See :ref:`security documentation<security>` for more information.

PHP compatibility
~~~~~~~~~~~~~~~~~

Version 1.5 should now be working with latest PHP version.
