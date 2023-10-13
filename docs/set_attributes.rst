.. _set_attributes:

Attributes update
=================

You can allow user to update their mail or phone in the LDAP directory.

Users need of course to authenticate to change these information.

When enabling this feature, a note will be added in help messages to advertise users they can change their mail or their phone. You can also access directly to the page with ``?action=setattributes``.

Activation
----------

Enable the feature:

.. code-block:: php

   $use_attributes = true;

Mail attribute
--------------

Define which attribute contains the mail address:

.. code-block:: php

   $attribute_mail = "mail";

.. tip:: If attribute is not defined, the mail is not displayed in set attributes page.

Phone attribute
---------------

Define which attribute contains the phone number:

.. code-block:: php

   $attribute_phone = "mobile";

.. tip:: If attribute is not defined, the phone is not displayed in set attributes page.

Who change attributes
----------------------

By default the change is done in LDAP directory with the user account. You can change this behavior to let the SSP service account do the change:

.. code-block:: php

   $who_change_attributes = "manager";
