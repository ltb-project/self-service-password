.. _audit:

Audit
=====

You can enable audit to log all actions done through Self Service Password.

The items provided in the audit log are:

* Date
* IP of connected user
* DN of account being updated (user DN, can be empty if error occurs before finding the DN)
* Who has done the action (user login)
* Action
* Result of the action

Example:

.. code-block:: json

   {
    "date":"Wed, 21 Jun 2023 15:58:11",
    "ip":"127.0.0.1",
    "user_dn":"uid=donald,ou=users,dc=example,dc=com",
    "done_by":"donald",
    "action":"change",
    "result":"nomatch"
   }

Audit log file
--------------

Set the file where actions are logged:

.. code-block:: php

   $audit_log_file = "/var/log/self-service-password/audit.log";

.. tip:: The file must be writable by the PHP or WebServer process
