LDAP connection
===============

Server address
--------------

Use an LDAP URI to configure the location of your LDAP server in
``$ldap_url``:

.. code:: php

   $ldap_url = "ldap://localhost:389";

You can set several URI, so that next server will be tried if the
previous is down:

.. code:: php

   $ldap_url = "ldap://server1 ldap://server2";

To use SSL, set ``ldaps`` in the URI:

.. code:: php

   $ldap_url = "ldaps://localhost";

To use StartTLS, set ``true`` in ``$ldap_starttls``:

.. code:: php

   $ldap_starttls = true;

.. warning::  LDAP certificate management in PHP relies on LDAP
  system libraries. Under Linux, you can configure ``/etc/ldap.conf`` (or
  ``/etc/ldap/ldap.conf`` on Debian/Ubuntu, or
  ``C:\OpenLDAP\sysconf\ldap.conf`` for Windows).

-  Provide the certificate from the certificate authority that issued
   your LDAP server's certificate:

::

   TLS_CACERT /etc/ssl/ca.crt

-  Or, disable server certificate checking:

::

   TLS_REQCERT allow

If you face issues with non matching TLS versions between SSP and your
LDAP server, you can try to set this option:

::

   TLS_CIPHER_SUITE TLSv1+RSA


Credentials
-----------

Configure DN and password in ``$ldap_bindn`` and ``$ldap_bindpw`` for example a user named SSP:

.. code:: php

   $ldap_binddn = "cn=SSP,dc=example,dc=com";
   $ldap_bindpw = "secret";

.. tip:: You can leave these parameters empty to bind anonymously. In
  this case, the password modification must be done with user's
  credentials.

If you want an SSP account to do this on behalf of the user set the value of ``$who_change_password`` to ``manager``. 

To instead use user's credentials when writing in LDAP directory, replace ``manager`` with ``user`` in ``$who_change_password``:

.. code:: php

   $who_change_password = "user";

.. warning:: The user account can only be used for standard password
  change, when user is giving its old password. For other password changes
  (token, questions, ...), manager account will always be used, whatever
  value is set in ``$who_change_password``.

Search parameters
-----------------

You can set the base of the search in ``$ldap_base``:

.. code:: php

   $ldap_base = "dc=example,dc=com";

The filter can be set in ``$ldap_filter``:

.. code:: php

   $ldap_filter = "(&(objectClass=person)(uid={login}))";

.. tip:: The string ``{login}`` is replaced by submitted login.

Extensions
----------

You can use LDAP password modify extended operation with
``$ldap_use_exop_passwd``:

.. code:: php

   $ldap_use_exop_passwd = true;

You can also enable LDAP password policy control with ``$ldap_use_ppolicy_control``:

.. code:: php

   $ldap_use_ppolicy_control = true;

Special modes
-------------

Active Directory
~~~~~~~~~~~~~~~~

Password in Active Directory is not managed like in other LDAP
directories. Use option ``$ad_mode`` to use ``unicodePwd`` as password
field:

.. code:: php

   $ad_mode = true;

You must also use SSL on LDAP connection because AD refuses to change a
password on a clear connection. See this
`documentation </documentation/general/active_directory_certificates>`__
to manage Active Directory certificates.

Adapt the search filter too:

.. code:: php

   $ldap_filter = "(&(objectClass=user)(sAMAccountName={login})(!(userAccountControl:1.2.840.113556.1.4.803:=2)))";

You can tune some options:

-  Force unlock: will unlock a locked account when password is changed

.. code:: php

   $ad_options['force_unlock'] = true;

-  Force user to change password at next login:

.. code:: php

   $ad_options['force_pwd_change'] = true;

-  Allow user to change password if password is expired:

.. code:: php

   $ad_options['change_expired_password'] = true;

You need to have an account on Active Directory with rights to change
password of users. To set the minimum rights for this account, do the
following:

-  Create a basic domain account without any additional privileges
-  Use Delegate control wizard within "User and computers", then

   -  User Object
   -  Reset Password
   -  Write lockoutTime (if unlock is enabled)
   -  Write shadowlastchange

If you enabled the reset by questions feature (see :ref:`config_questions`),
you also need to give rights on the question attribute:

-  Right click the OU where you want delegation of permissions to
   propagate down from and select "Delegate Control…"
-  Add the account to delegate to, click Next
-  Create a custom task to delegate
-  Select the radio button for "Only the following objects in the
   folder", then select "User objects" at the bottom of the list, click
   Next
-  Select the "Property-specific" checkbox only, then locate the
   attribute you are using to store the "Reset by questions" answer in.

Samba
~~~~~

To manage compatibility with Windows world, Samba stores a specific hash
of the password in a second attribute (``sambaNTpassword``). It also
store modification date in ``sambaPwdLastSet``. Use ``$samba_mode`` to
manage these attributes:

.. code:: php

   $samba_mode = true;

You can also update ``sambaPwdCanChange`` and ``sambaPwdMustChange``
attributes by settings minimal and maximal age, in days:

.. code:: php

   $samba_options['min_age'] = 5;
   $samba_options['max_age'] = 45;

To set an expiration date for a Samba account (attribute
``sambaKickofftime``), configure a maximal age, in days:

.. code:: php

   $samba_options['expire_days'] = 90;

.. tip:: Samba modifications will only be done on entries of class
  ``sambaSamAccount``

Shadow
~~~~~~

If using ``shadowAccount`` object class for users, you can update the
``shadowLastChange`` attribute when changing password:

.. code:: php

   $shadow_options['update_shadowLastChange'] = true;

You can also update the ``shadowExpire`` attribute to define when the
password will expire. Use ``-1`` to never expire, else configure the
number of days:

.. code:: php

   $shadow_options['update_shadowExpire'] = true;
   $shadow_options['shadow_expire_days'] = 365;

.. tip:: Shadow modifications will only be done on entries of class
  ``shadowAccount``
