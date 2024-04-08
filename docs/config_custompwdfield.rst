.. _config_custompwdfield:

Custom Password Fields
======================

Background
----------

This Feature enables you to configure individiual Password Fields that are
independent to the actual user password.

For example, you have an old application that needs the password to be stored
with an insecure hash-algorithm, so you want to store it in an extra
LDAP-Attribute. Changing this password is possible with this feature.

Activation
----------

This feature is disabled by default. For enabling it, you have to define how many
custom password fields you want the tool to manage and some additional properties.

A minimal configuration could look like this:

.. code-block:: php

   $change_custompwdfield = array(
      array(
        'attribute' => "customPasswordField",
        'hash' => "MD5",
        'label' => "Custom password"
      )
   )

.. tip:: If you do not set an Arraykey in this configuration, the settings for the
   main password will be applied!

For more information, follow the steps mentioned below.

Main structure of the configuration array
-----------------------------------------

As seen above, the configuration consists of nested arrays. This is due to the
fact that it could be possible that one could need not only one custom password field, but
multiple.

So, if you want this feature to manage two custom password fields, you have to put two
arrays into the array $change_custompwdfield, one for each:

.. code-block:: php

   $change_custompwdfield = array(
      array(
         // everything belonging to password field one
      ),
      array(
         // everything belonging to password field two
      (
   )

Possible configuration keys
---------------------------

.. list-table:: configuration keys
   :widths: 25 50 25
   :header-rows: 1

   * - Key
     - Description
     - default value
   * - ``attribute``
     - LDAP attribute name
     - none
   * - ``hash``
     - hash algorithm. Possible values are the one listed in Ltb\Password library: clear, SSHA, SSHA256, SSHA384, SSHA512, SHA, SHA256, SHA384, SHA512, SMD5, MD5, CRYPT, ARGON2, NTLM
     - none
   * - ``hash_options``
     - array containing prefix and length options for salt when using CRYPT hash
     - same value as the general $hash_options
   * - ``use_captcha``
     - whether or not a captcha must be filled before changing the custom password
     - same as for the main password
   * - ``label``
     - Name of the application or the LDAP attribute to display
     - 'Custom Password X', where 'X' is a number starting with 0
   * - ``who_change_password``
     - who change the LDAP attribute? Possible values are "manager" or "user"
     - same as for the main password
   * - ``msg_changehelpextramessage``
     - An extra message presented to the user, for example "this password is meant for that application"
     - empty
   * - ``notify_on_change``
     - whether or not the user should be notified by email.
     - same as for the main password
   * - ``ldap_use_ppolicy_control``
     - Do you want to change the LDAP attribute by sending a ppolicy control? (true or false) Most of the time useless, as custom password fields are not subject to password policies.
     - false
   * - ``pwd_policy_config``
     - Array containing additional password policies for each custom password field. see below
     - same as for the main password
   * - ``prehook``
     - path to a script called before password change
     - none
   * - ``prehook_password_encodebase64``
     - boolean. Does the password needs to be base64 encoded before sent to prehook script?
     - none
   * - ``posthook``
     - path to a script called after password change
     - none
   * - ``posthook_password_encodebase64``
     - boolean. Does the password needs to be base64 encoded before sent to posthook script?
     - none

.. list-table:: pwd_policy_config array keys
   :widths: 50 50
   :header-rows: 1

   * - Key
     - Description
   * - ``pwd_show_policy``
     - Whether or not to show the policy
   * - ``pwd_no_reuse``
     - whether or not the custom password may be the same as the main password
   * - ``pwd_unique_across_custom_password_fields``
     - boolean. if true, the new password must be different from all other custom password marked as unique
   * - ``pwd_diff_last_min_chars``
     - how many characters of the custom password may be the same as the main password?
   * - ``pwd_min_length``
     - minimum length
   * - ``pwd_max_length``
     - maximum length
   * - ``pwd_min_lower``
     - minimum lower characters
   * - ``pwd_min_upper``
     - minimum upper characters
   * - ``pwd_min_digit``
     - minimum digits
   * - ``pwd_min_special``
     - minimum of special characters
   * - ``pwd_special_chars``
     - what are special characters?
   * - ``pwd_forbidden_chars``
     - forbidden characters
   * - ``pwd_diff_login``
     - whether or not the custom password may be the same as the login-name
   * - ``pwd_complexity``
     - number of different class of character required
   * - ``use_pwnedpasswords``
     - use pwnedpasswords api v2 to securely check if the password has been on a leak
   * - ``pwd_no_special_at_ends``
     - forbid to have a special character (as defined by ``pwd_special_chars``) at the beginning or at the end of the password
   * - ``pwd_forbidden_words``
     - array of forbidden words
   * - ``pwd_forbidden_ldap_fields``
     - array of attributes which values must not be used in the password
   * - ``pwd_show_policy_pos``
     - where shall the password be shown? ("above", "below")
