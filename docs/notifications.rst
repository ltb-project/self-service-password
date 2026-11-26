Notifications
=============

Self Service Password can send notifications to user:

* When password is changed
* When password is about to expire

See :ref:`config_mail` to configure mail settings.

Change password notification
----------------------------

Use this option to send a confirmation mail to the user, just after a
successful mail change: 
   
.. code-block:: php

   $notify_on_change = true;

Password expiration notification
--------------------------------

Allow this feature:
   
.. code-block:: php

   $notify_password_expiration = true;

Use will be warned a couple of days before the password expiration, you can configure these intervals:

.. code-block:: php

   $notify_password_expiration_days = array(1, 5, 10, 30);

The script is now able to run:

.. prompt:: bash $

   /usr/share/self-service-password/script/notify_password_expiration.php -h -n -v

Command line options:

* -h: help message
* -n: dry-run (do not send mails)
* -v: verbose mode

You then need to run this script with cron, systemd timer or any other schedular, one time per day.
