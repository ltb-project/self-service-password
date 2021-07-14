.. _config_sshkey:

SSH Public Keys
===============

Activation
----------

By default, SSP would not deal with SSH Public Keys. You can enable or disable this feature with ``$change_sshkey``:

.. code:: php

   $change_sshkey = true;

.. tip:: Note that whenever posting SSH public keys using SSP,
  any prior existing key would be replaced. If you mean to add
  public keys, instead of replacing them all, then make sure to
  post an exhaustive list.

LDAP Attribute
--------------

Set the LDAP attribute that should be used storing SSH public keys - defaults to ``sshPublicKey``:

.. code:: php

   $change_sshkey_attribute = "sshPublicKey";

Valid SSH Key Types
-------------------

You can change the list of key types that would be allowed:

.. code:: php

    $ssh_valid_key_types = array('ssh-rsa', 'ssh-dss', 'ecdsa-sha2-nistp256', 'ssh-ed25519');

Who changes SSH Public Key
--------------------------

By default, new SSH Public Keys would be written by the user requesting that modification.

If you want the LDAP manager account to edit that attribute, we may instead set the following:

.. code:: php

    $who_change_sshkey = "manager"

SSH Public Key changes notification
-----------------------------------

Use this option to send a confirmation mail to the user, just after a successful SSH Public Key change - see <config_mail.html#phpmailer> setting up PHPMailer:

.. code:: php

   $mail_notify_on_sshkey_change = true;

Or that one, to send HTTP notifications instead - see :ref:`config_httpnotifications` integrating with some third-party web service:

.. code:: php

   $http_notify_on_sshkey_change = true;
