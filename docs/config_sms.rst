Reset by SMS
============

How it works?
-------------

First, the user will enter his login. With this login, SSP will try to
get information, like name and mobile phone number.

If information is found, the user can check it and confirm the sent of
reset code trough SMS.

A message is sent either to an Email to SMS gateway, either trough an
API (called with PHP code or by script).

SMS provider
------------

You first have to choose SMS provider. Search the web to find one, many
have a free trial so you can test the feature.

Some known providers:

-  Email 2 SMS:

   -  `SMS Global <https://www.smsglobal.com/>`__

-  API:

   -  `SMS Global <https://www.smsglobal.com/>`__
   -  `Smart Focus <https://help-developer.smartfocus.com/>`__

Activation
----------

You can enable or disable this feature with $use_sms:

.. code:: php

   $use_sms = true;

Method
------

Choose which method to use, ``mail`` or ``api``:

.. code:: php

   $sms_method = "mail";

Mail
^^^^

If you choose the mail method, the mail will be sent to SMS provider
trough mail configuration (see :ref:`config_mail`).

You can adjust some settings here, depending on provider guidelines:

.. code:: php

   # Send SMS mail to address
   $smsmailto = "{sms_attribute}@service.provider.com";
   # Subject when sending email to SMTP to SMS provider
   $smsmail_subject = "Provider code";

API
^^^

If you choose API, you need to define which library will be called:

.. code:: php

   $sms_api_lib = "lib/smsapi.inc.php";

In this library, you must define the ``send_sms_by_api`` function:

.. code:: php

   function send_sms_by_api($mobile, $message) {

       # PHP code
       # ...

       # Or call to external script
       # $command = escapeshellcmd(/path/to/script).' '.escapeshellarg($mobile).' '.escapeshellarg($message);
       # exec($command);

       return 1;
   }

Read the provider guidelines to know how to access its API.

.. tip:: An example is given in lib/smsapi-example.inc.php. Copy this
  file to lib/smsapi.inc.php and start coding!
  
See also :ref:`sms_api`.

Mobile attribute
~~~~~~~~~~~~~~~~

Set here which LDAP attribute hold the user mobile phone:

.. code:: php

   $sms_attribute = "mobile";

You can also partially hide the value when it is displayed on the
confirmation page:

.. code:: php

   $sms_partially_hide_number = true;

To remove any non digit character from SMS number;

.. code:: php

   $sms_sanitize_number = true;

To truncate SMS number:

.. code:: php

   $sms_truncate_number = true;
   $sms_truncate_number_length = 10;

Message
~~~~~~~

Set the message here, it uses by default the ``smsresetmessage`` message
defined in lang files and the ``smstoken`` parameter:

.. code:: php

   # Message
   $sms_message = "{smsresetmessage} {smstoken}";

Token
~~~~~

You can set the token length:

.. code:: php

   $sms_token_length = 6;

You can also configure the allowed attempts:

.. code:: php

   $max_attempts = 3;

After these attempts, the sent token is no more valid.
