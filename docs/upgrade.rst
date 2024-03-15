Upgrade
=======

From 1.5 to 1.6
---------------

bundled dependencies
~~~~~~~~~~~~~~~~~~~~

The dependencies are now explicitly listed in the self-service-password package, including the bundled ones.

You can find bundled dependencies list:

* in package description in debian package
* in Provides field in rpm package

The license of self-service-password is still GPL2+, but now the bundled dependencies licenses are also listed:

* in copyright file for deb package
* in License tag in rpm package

configuration
~~~~~~~~~~~~~

The configuration files are now in ``/etc/self-service-password`` directory.

During the upgrade process towards 1.6, the previous configuration files present in ``/usr/share/self-service-password/conf`` (all .php files) are migrated to ``/etc/self-service-password/``:

* ``config.inc.php`` is migrated as a ``config.inc.php.bak`` file,
* all other php file names are preserved. (including local conf, domain conf, and customized lang files)

Please take in consideration that ``config.inc.php`` is now replaced systematically by the version in the RPM package. A .rpmsave backup will be done with the current version. The deb package will continue asking which file to use, it is advised to replace the current one with the version in the package.

The very old configuration files, present directly under ``/usr/share/self-service-password/`` are **NOT** migrated during the upgrade process, and must be upgraded manually. These files have been deprecated since version 0.9, released in 2015 of October. If you are migrating from version this old, you must move your configuration files manually. Move your ``config.inc.local.php`` into ``/etc/self-service-password``. If you have modified ``config.inc.php``, just identify the modified parameters and add/replace them into a ``/etc/self-service-password/config.inc.local.php``. Avoid as much as possible editing the ``/etc/self-service-password/config.inc.php`` file.

cache cleaning
~~~~~~~~~~~~~~

Now the cache is being cleaned-up during self-service-password upgrade / install.

This is intended to avoid smarty problems due to self-service-password templates upgrade, and possibly smarty upgrade itself.


dependencies update
~~~~~~~~~~~~~~~~~~~

Packaged dependencies:

* smarty is now a required package. self-service-password will work with either version 3 or 4.
* php >= 7.3 is now required (previously version 5)
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

Note that hidden files (.gitignore,...) from bundled dependencies are now removed from packages.


for developers
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
