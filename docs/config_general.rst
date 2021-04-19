General parameters
==================

Configuration files
-------------------

To configure Self Service Password, you need to create a *local*
configuration file named ``config.inc.local.php`` in
``self-service-password/conf``. For example :

.. code:: php

   <?php
   // Override config.inc.php parameters below

   ?>

Self Service Password default configuration file is
``self-service-password/conf/config.inc.php``. It includes
``config.inc.local.php``. Consequently, you can override all parameters
in ``config.inc.local.php``. This prevents you to be disturbed by an
upgrade.

.. warning::
  Do not copy ``config.inc.php`` into ``config.inc.local.php``, as the first one includes the second.
  You would then create an infinite loop and crash your application.

Multi tenancy
-------------

You can load a specific configuration file by passing a HTTP header.
This feature is disable by default. To enable it:

.. code:: php

   $header_name_extra_config = "SSP-Extra-Config";

Then if you send the header ``SSP-Extra-Config: mydomain``, the file
``conf/config.inc.mydomain.php`` will be loaded.

Language
--------

Available languages are:

-  Basque (eu)
-  |image0| Brazilian (pt-BR)
-  |image1| Catalonia (ca)
-  |image2| Chinese (cn, zh-CN, zh-TW)
-  |image3| Czech (cs)
-  |image4| Dutch (nl)
-  |image5| English (en)
-  |image6| Estonian (ee)
-  |image7| French (fr)
-  |image8| German (de)
-  |image9| Greek (el)
-  |image10| Hungarian (hu)
-  |image11| Italian (it)
-  |image12| Japanese (ja)
-  |image13| Norwegian bokmål (nb-NO)
-  |image14| Polish (pl)
-  |image15| Portuguese (pt-PT)
-  |image16| Russian (ru)
-  |image23| Serbian (rs)
-  |image17| Slovak (sk)
-  |image18| Slovenian (sl)
-  |image19| Spanish (es)
-  |image20| Swedish (sv)
-  |image21| Turkish (tr)
-  |image22| Ukranian (uk)

Set one of them in ``$lang``:

.. code:: php

   $lang = "en";

Menu
----

To display a top menu, activate the option:

.. code:: php

   $show_menu = true;

If menu is not shown, the default application title will be displayed.

Messages
--------

Help messages provide information to users on how use the interface.
They can be disabled with ``$show_help``:

.. code:: php

   $show_help = false;

You can add extra messages by setting values in these parameters:

.. code:: php

   $messages['passwordchangedextramessage'] = "Congratulations!";
   $messages['changehelpextramessage'] = "Contact us if you are lost...";

Logo
----

You change the default logo with your own. Set the path to your logo in
``$logo``:

.. code:: php

   $logo = "images/ltb-logo.png";

.. tip:: Comment this parameter to hide logo

Background
----------

You change the background image with your own. Set the path to image in
``$background_image``:

.. code:: php

   $background_image = "images/unsplash-space.jpeg";

.. tip:: Comment this parameter to falll back to default background color

Debug
-----

You can turn on debug mode with ``$debug``:

.. code:: php

   $debug = true;

Security
--------

You need a key phrase if you use ciphered tokens (see :ref:`config_tokens`)

.. code:: php

   $keyphrase = "secret";

There is also a protection on login to avoid LDAP injections. Some
characters are forbidden, you can change the list of forbidden
characters in login with ``$login_forbidden_chars``:

.. code:: php

   $login_forbidden_chars = "*()&|";

.. tip:: If no characters are configured in ``$login_forbidden_chars``,
   only alphanumeric characters are allowed.

You can configure "obscure" messages, so that some errors are not
displayed and replaced by a generic "bad credentials" error:

.. code:: php

   $obscure_failure_messages = array("mailnomatch");

You may want to limit number of tries per user/ip in a short time 
(especially with sms option). If you enable this defaults are 2 tries
per login and per hour, and same for ip address:

.. code:: php

   $enable_ratelimit = true;

Default action
--------------

By default, the password change page is displayed. You can configure
which page should be displayed when no action is defined:

.. code:: php

   $default_action = "change";

Possibles values are:

-  ``change``
-  ``sendtoken``
-  ``sendsms``

You can disable the standard password change if you don't need it:

.. code:: php

   $use_change = false;

In this case, be sure to also remove "change" from default action, else
the change page will still be displayed.

Prefill user login
------------------

If Self Service Password is called from another application, you can
prefill the login but sending an HTTP header.

To enable this feature:

.. code:: php

   $header_name_preset_login = "Auth-User";

Captcha
-------

To require a captcha, set ``$use_captcha``:

.. code:: php

   $use_captcha = true;

.. tip:: The captcha is used on every form in Self Service Password
  (password change, token, questions, etc.)

.. |image0| image:: images/br.png
.. |image1| image:: images/catalonia.png
.. |image2| image:: images/cn.png
.. |image3| image:: images/cz.png
.. |image4| image:: images/nl.png
.. |image5| image:: images/us.png
.. |image6| image:: images/ee.png
.. |image7| image:: images/fr.png
.. |image8| image:: images/de.png
.. |image9| image:: images/gr.png
.. |image10| image:: images/hu.png
.. |image11| image:: images/it.png
.. |image12| image:: images/jp.png
.. |image13| image:: images/no.png
.. |image14| image:: images/pl.png
.. |image15| image:: images/pt.png
.. |image16| image:: images/ru.png
.. |image17| image:: images/sk.png
.. |image18| image:: images/sl.png
.. |image19| image:: images/es.png
.. |image20| image:: images/se.png
.. |image21| image:: images/tr.png
.. |image22| image:: images/ua.png
.. |image23| image:: images/rs.png

