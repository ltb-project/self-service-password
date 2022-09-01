Webservices (REST API)
======================

Configuration
-------------

REST API access is forbidden by default in web server configuration. You must allow and protect access (for example with htaccess).

You must also enable it in configuration:

.. code-block:: php

   $use_restapi = true;

API
---

Here are available services:

.. openapi:: ../rest/v1/doc/openapi-spec.yaml

Examples
--------

Check the strength of a password:

.. prompt:: bash $

   curl -X POST \
     -H 'Content-Type: application/x-www-form-urlencoded' \
     -d 'newpassword=Wer123456' \
     -u 'authuser:authpwd' \
     http://ssp.example.com/rest/v1/checkpassword.php

.. tip::

   Provide also login and oldpassword if you configured the password policy to
   check if new password is not the same as old password, not the same as login,
   or does not contain values from the LDAP entry.

Update password for a user checking the current password first:

.. prompt:: bash $

   curl -X POST \
     -H 'Content-Type: application/x-www-form-urlencoded' \
     -d 'login=user1&oldpassword=W1WAf1234567&newpassword=Wer123456' \
     -u 'authuser:authpwd' \
     http://ssp.example.com/rest/v1/changepassword.php

Force a new password for a user:

.. prompt:: bash $

   curl -X POST \
     -H 'Content-Type: application/x-www-form-urlencoded' \
     -d 'login=user1&newpassword=Wer123456' \
     -u 'authuser:authpwd' \
     http://ssp.example.com/rest/v1/adminchangepassword.php
