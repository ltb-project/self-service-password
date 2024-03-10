.. _config_custompwdfield:

Custom Password Fields
=============

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
   * - 'use_captcha'
     - whether or not a captcha must be filled before changing the custom password
     - same as for the main password
   * - 'label'
     - what name should be used on the website?
     - 'Custom Password X', where 'X' is a number starting with 0
   * - 'who_change_password'
     - does the user or manager change the LDAP-Attribute?
     - same as for the main password
   * - 'msg_changehelpextramessage'
     - An extra message presented to the user, for example "this password is meant for that application"
     - empty
   * - 'notify_on_change'
     - whether or not the user should be notified by email.
     - same as for the main password
   * - 'ldap_use_ppolicy_control'
     - It is possible to set up additional ppolicies on the LDAP Server. If so, you may choose if you want to use them.
     - false
   * - 'pwd_policy_config'
     - This is an array containing additional password policies for each custom password field. see below
     - same as for the main password

.. list-table:: pwd_policy_config array keys
   :widths: 50 50
   :header-rows: 1

   * - Key
     - Description
   * - 'pwd_show_policy'
     - Whether or not to show the policy
   * - 'pwd_no_reuse'
     - whether or not the custom password may be the same as the main password
   * - 'pwd_diff_last_min_chars'
     - how many characters of the custom password may be the same as the main password?
   * - 'pwd_min_length'
     - minimum length
   * - 'pwd_max_length'
     - maximum length
   * - 'pwd_min_lower'
     - minimum lower characters
   * - 'pwd_min_upper'
     - minimum upper characters
   * - 'pwd_min_digit'
     - minimum digits
   * - 'pwd_min_special'
     - minimum of special characters
   * - 'pwd_special_chars'
     - what are special characters?
   * - 'pwd_forbidden_chars'
     - forbidden characters
   * - 'pwd_diff_login'
     - whether or not the custom password may be the same as the login-name
   * - 'pwd_complexity'
     - number of different class of character required
   * - 'use_pwnedpasswords'
     - use pwnedpasswords api v2 to securely check if the password has been on a leak
   * - 'pwd_no_special_at_ends'
     - 
   * - 'pwd_forbidden_words'
     - array of forbidden words
   * - 'pwd_forbidden_ldap_fields'
     - array of attributes which values may not be used in the password
   * - 'pwd_show_policy_pos'
     - where shall the the password be shown? ("above", "below")
