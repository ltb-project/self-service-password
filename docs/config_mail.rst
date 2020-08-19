.. _config_mail:

Mail
====

LDAP Attribute
--------------

Set the LDAP attribute where user email is stored:

.. code:: php

   $mail_attribute = "mail";

.. tip:: Only the first value of this attribute will be used to get the
  mail address.

Sender name
-----------

You can change the default ``From`` header and add a signature:

.. code:: php

   $mail_from = "admin@example.com";
   $mail_from_name = "Self Service Password administrator";
   $mail_signature = "";

Change password notification
----------------------------

Use this option to send a confirmation mail to the user, just after a
successful mail change:

.. code:: php

   $notify_on_change = true;

PHPMailer
---------

You can set all parameters for PHPMailer:

.. code:: php

   $mail_sendmailpath = '/usr/sbin/sendmail';
   $mail_protocol = 'smtp';
   $mail_smtp_debug = 0;
   $mail_debug_format = 'html';
   $mail_smtp_host = 'localhost';
   $mail_smtp_auth = false;
   $mail_smtp_user = '';
   $mail_smtp_pass = '';
   $mail_smtp_port = 25;
   $mail_smtp_timeout = 30;
   $mail_smtp_keepalive = false;
   $mail_smtp_secure = 'tls';
   $mail_smtp_autotls = true;
   $mail_smtp_options = array();
   $mail_contenttype = 'text/plain';
   $mail_wordwrap = 0;
   $mail_charset = 'utf-8';
   $mail_priority = 3;
   $mail_newline = PHP_EOL;

.. tip:: See https://github.com/PHPMailer/PHPMailer for more
  information
