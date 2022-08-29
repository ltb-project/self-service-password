Upgrade
=======

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

PHP compatibility
~~~~~~~~~~~~~~~~~

Version 1.5 should now be working with latest PHP version.
