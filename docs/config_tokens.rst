.. _config_tokens:

Reset by mail tokens
====================

How it works?
-------------

First, the user will enter his login and his mail address. A mail is
sent to him.

Then, the user click on the link in the mail, an can set a new password.

.. tip:: PHP sessions are used to store and retrieve token on server
  side.

.. tip:: You can enable :ref:`set_attributes` feature to allow users to
   update their mail address in the LDAP directory.

Activation
----------

You can enable or disable this feature with ``$use_tokens``:

.. code-block:: php

   $use_tokens = true;

Mail configuration
------------------

See :ref:`config_mail`.

You can also avoid to request the mail to the user, only the login will
be asked, and the mail will be read in LDAP:

.. code-block:: php

   $mail_address_use_ldap = true;

Security
--------

You can crypt tokens, to protect the session identifier:

.. code-block:: php

   $crypt_tokens = true;

.. warning:: If you enable this option, you must change the default
  value of the security keyphrase.

You should set a token lifetime, so they are deleted if unused. The
value is in seconds:

.. code-block:: php

   $token_lifetime = "3600";

.. warning:: Token deletion is managed by PHP session garbage
  collector.

Log
---

By default, generated URLs are logged in the default Apache error log.
This behavior can be changed, to log in a specific file:

.. code-block:: php

   $reset_request_log = "/var/log/self-service-password";

.. warning:: Apache user must have write permission on this
  file.

Reset URL
---------

By default, reset URL is computed using server name and port, but these
values can be wrong if the application is behind a reverse proxy. In
this case you can set yourself the reset URL:

.. code-block:: php

   $reset_url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . "://" . $_SERVER['HTTP_X_FORWARDED_HOST'] . $_SERVER['SCRIPT_NAME'];

.. warning:: Make sure your webserver/reverse-proxy hosting self-service-password is only answering to a dedicated Full Qualified Domain Name. Else you should define a hard-coded ``$reset_url`` parameter for preventing self-service-password to forge urls based on arbitrary host headers.
