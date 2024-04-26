Password policy
===============

Hashing
-------

You can use these schemes to hash the password before sending it to LDAP
directory:

-  SHA, SHA256, SHA384, SHA512
-  SSHA, SSHA256, SSHA384, SSHA512
-  MD5
-  SMD5
-  CRYPT
-  ARGON2
-  clear
-  auto

Set one of them in ``$hash``:

.. code-block:: php

   $hash = "clear";

.. warning:: This option is ignored with Active Directory
  mode.

.. tip:: Use ``auto`` to get the current password value and find the
  hash. This requires a read access to the password.

You can configure the crypt salt prefix to choose the algorithm (see
`crypt documentation <http://php.net/manual/en/function.crypt.php>`__):

.. code-block:: php

   $hash_options['crypt_salt_prefix'] = "$6$";

Size
----

Set minimal and maximal length in ``$pwd_min_length`` and
``$pwd_max_length``:

.. code-block:: php

   $pwd_min_length = 4;
   $pwd_max_length = 8;

.. tip:: Set ``0`` in ``$pwd_max_length`` to disable maximal length
  checking.

Characters
----------

You can set the minimal number of lower, upper, digit and special
characters:

.. code-block:: php

   $pwd_min_lower = 3;
   $pwd_min_upper = 1;
   $pwd_min_digit = 1;
   $pwd_min_special = 1;

Special characters are defined with a regular expression, by default:

.. code-block:: php

   $pwd_special_chars = "^a-zA-Z0-9";

This means special characters are all characters except alphabetical
letters and digits.

You can check that these special characters are not at beginning or end
of the password:

.. code-block:: php

   $pwd_no_special_at_ends = true;

You can also disallow characters from being in password, with
``$pwd_forbidden_chars``:

.. code-block:: php

   $pwd_forbidden_chars = "@%";

This means that ``@`` and ``%`` could not be present in a password.

You can define how many different class of characters (lower, upper,
digit, special) are needed in the password:

.. code-block:: php

   $pwd_complexity = 2;

Pwned Passwords
---------------

Allows to check if the password was already compromised, using
https://haveibeenpwned.com/ database:

.. code-block:: php

   $use_pwnedpasswords = true;

Reuse
-----

You can prevent a user from using his old password as a new password if
this check is not done by the directory:

.. code-block:: php

   $pwd_no_reuse = true;

You may also want to check for partial password reuses, ensuring the
new password includes at least N distinct new characters:

.. code-block:: php

   $pwd_diff_last_min_chars = 3;

Forbidden words
---------------

Give a list of forbidden words that the password should not contain:

.. code-block:: php

   $pwd_forbidden_words = array("azerty", "qwerty", "password");

Forbidden LDAP fields
---------------------

Give a list of LDAP fields which values should not be present in the password:

.. code-block:: php

   $pwd_forbidden_ldap_fields = array('cn', 'givenName', 'sn', 'mail');

Show policy
-----------

Password policy can be displayed to user by configuring
``$pwd_show_policy``. Three values are accepted:

-  ``always``: policy is always displayed
-  ``never``: policy is never displayed
-  ``onerror``: policy is only displayed if password is rejected because
   of it, and the user provided his old password correctly.

.. code-block:: php

   $pwd_show_policy = "never";

You can also configure if the policy will be displayed above or below
the form:

.. code-block:: php

   $pwd_show_policy_pos = "above";

Extended error
--------------

You can display the error message returned by the directory when
password is refused. The message content depends on your LDAP server
software:

.. code-block:: php

   $show_extended_error = true;

