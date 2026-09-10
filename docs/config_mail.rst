.. _config_mail:

Mail
====

LDAP Attribute
--------------

Set the LDAP attributes where user email may be stored:

.. code-block:: php

   $mail_attributes = array( "mail", "gosaMailAlternateAddress", "proxyAddresses" );

.. tip:: Only the first value of this attribute will be used to get the
  mail address.

Sender name
-----------

You can change the default ``From`` header and add a signature:

.. code-block:: php

   $mail_from = "admin@example.com";
   $mail_from_name = "Self Service Password administrator";
   $mail_signature = "";

Change password notification
----------------------------

Use this option to send a confirmation mail to the user, just after a
successful mail change:

.. code-block:: php

   $notify_on_change = true;

PHPMailer
---------

You can set all parameters for PHPMailer:

.. code-block:: php

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

.. tip:: See https://github.com/PHPMailer/PHPMailer for more
  information

HTML content
------------

Mails are in HTML and text format.

To embed images in HTML content:

.. code-block:: php

   $mail_embedded_images = array( 'logo' => $logo, 'myimage' => 'images/myimage.png');

Text content can be changed by overriding messages in your custom lang file:

.. code-block:: php

   $messages['resetmessage'] = "Hello {login},\n\nClick here to reset your password:\n{url}\n\nIf you didn't request a password reset, please ignore this email.";
   $messages['resetsubject'] = "Reset your password";
   $messages['changemessage'] = "Hello {login},\n\nYour password has been changed.\n\nIf you didn't request a password reset, please contact your administrator immediately.";
   $messages['changesubject'] = "Your password has been changed";
   $messages['changesshkeymessage'] = "Hello {login},\n\nYour SSH Key has been changed.\n\nIf you didn't initiate this change, please contact your administrator immediately.";
   $messages['changesshkeysubject'] = "Your SSH Key has been changed";

HTML templates for mail are in templates/mails/. Included message can be changed in custom lang file, and if HTML template needs to be overriden, you can use a custom skin.
