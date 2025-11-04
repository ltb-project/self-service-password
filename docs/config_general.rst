General parameters
==================

Configuration files
-------------------

To configure Self Service Password, you need to create a *local*
configuration file named ``config.inc.local.php`` in
``self-service-password/conf``. For example :

.. code-block:: php

   <?php
   // Override config.inc.php parameters below

   ?>

Self Service Password default configuration file is
``/etc/self-service-password/config.inc.php``. It includes
``config.inc.local.php``. Consequently, you should override all parameters
in a dedicated file ``config.inc.local.php``. This prevents you to be disturbed
by an upgrade.

Multi tenancy
-------------

You can load a specific configuration file by passing a HTTP header.
This feature is disable by default. To enable it:

.. code-block:: php

   $header_name_extra_config = "SSP-Extra-Config";

Then if you send the header ``SSP-Extra-Config: domain1``, the file
``config.inc.domain1.php`` will be loaded.

Using Apache, we may set such header using the following:

.. code-block:: apache

    <VirtualHost *:80>
       ServerName ssp.domain1.com
       RequestHeader setIfEmpty SSP-Extra-Config domain1
       [...]
    </VirtualHost>

Using Nginx, we could use instead:

.. code-block:: nginx

   server {
       [...]
       location ~ \.php {
           fastcgi_param SSP-Extra-Config domain1;
           [...]
       }

Language
--------

Available languages are:

-  |image24| Arabic (ar)
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
-  |flag_ko| Korean (ko)
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

.. code-block:: php

   $lang = "en";

Language is picked according to browser choice among the available ones. All languages
are allowed by default, to restrict them add ``$allowed_lang`` array:

.. code-block:: php

   $allowed_lang = array("en");

Menu
----

To display a top menu, activate the option:

.. code-block:: php

   $show_menu = true;

If menu is not shown, the default application title will be displayed.

Messages
--------

Help messages provide information to users on how use the interface.
They can be disabled with ``$show_help``:

.. code-block:: php

   $show_help = false;

You can add extra messages by setting values in these parameters:

.. code-block:: php

   $messages['passwordchangedextramessage'] = "Congratulations!";
   $messages['changehelpextramessage'] = "Contact us if you are lost...";

Graphics
--------

Logo
^^^^

You change the default logo with your own. Set the path to your logo in
``$logo``:

.. code-block:: php

   $logo = "images/ltb-logo.png";

.. tip:: Comment this parameter to hide logo

Background
^^^^^^^^^^

You change the background image with your own. Set the path to image in
``$background_image``:

.. code-block:: php

   $background_image = "images/unsplash-space.jpeg";

.. tip:: Comment this parameter to falll back to default background color

Custom CSS
^^^^^^^^^^

To easily customize CSS, you can use a separate CSS file:

.. code-block:: php

    $custom_css = "css/custom.css";

Footer
^^^^^^

You can hide the footer bar:

.. code-block:: php

    $display_footer = false;

Custom templates
^^^^^^^^^^^^^^^^

If you need to do more changes on the interface, you can create a custom templates directory
and override any of template file by copying it from ``templates/`` into the custom directory
and adapt it to your needs:

.. code-block:: php

    $custom_tpl_dir = "templates_custom/";

    To define a custom template paramter, create a config parameter with ``tpl_`` prefix:

.. code-block:: php

    $tpl_mycustomparam = true;

And then use it in template:

.. code-block:: html

   <div>
   {if $mycustomparam}
   <p>Display this</p>
   {else}
   <p>Display that</p>
   {/if}

Debug
-----

You can turn on debug mode with ``$debug``:

.. code-block:: php

   $debug = true;

.. tip:: Debug messages will be printed in server logs.

This is also possible to enable Smarty debug, for web interface issues:

.. code-block:: php

   $smarty_debug = true;

.. tip:: Debug messages will appear on web interface as a popup.
   You will also have many more messages in error logs.

.. _security:

Security
--------

You need a key phrase if you use ciphered tokens (see :ref:`config_tokens`)

.. code-block:: php

   $keyphrase = "secret";

There is also a protection on login to avoid LDAP injections. Some
characters are forbidden, you can change the list of forbidden
characters in login with ``$login_forbidden_chars``:

.. code-block:: php

   $login_forbidden_chars = "*()&|";

.. tip:: If no characters are configured in ``$login_forbidden_chars``,
   only alphanumeric characters are allowed.

For the reset process via mail token and send sms token, errors are hidden
by default, to avoid account disclosure:

.. code-block:: php

   $obscure_usernotfound_sendtoken = true;
   $obscure_notfound_sendsms = true;

Set these parameter to ``false`` if you want to show an error if the information of the account
entered by the user do not exist in the directory.

Default action
--------------

By default, the password change page is displayed. You can configure
which page should be displayed when no action is defined:

.. code-block:: php

   $default_action = "change";

Possibles values are:

-  ``change``
-  ``sendtoken``
-  ``sendsms``
-  ``changecustompwdfield`` (to specify which custom password field, set ``$default_custompwdindex`` to the desired number, i.e. ``$default_custompwdindex = 1;``)

You can disable the standard password change if you don't need it:

.. code-block:: php

   $use_change = false;

In this case, be sure to also remove "change" from default action, else
the change page will still be displayed.

Prefill user login
------------------

If Self Service Password is called from another application, you can
prefill the login by sending an HTTP header.

To enable this feature, configure the name of the HTTP header:

.. code-block:: php

   $header_name_preset_login = "Auth-User";

It is also possible to prefill the login by using the ``login_hint``
GET or POST parameter. This method does not require any configuration.

Example: ``https://ssp.example.com/?actionresetbyquestions&login_hint=spiderman``

.. _config_captcha:

Captcha
-------

To enable captcha, set ``$use_captcha`` to ``true``.

You should also define the captcha module to use.
(By default, ``InternalCaptcha`` is defined in config.inc.php)

.. code-block:: php

   $use_captcha = true;
   $captcha_class = "InternalCaptcha";

.. tip:: The captcha is used on every form in Self Service Password
  (password change, token, questions,...)

For ``$captcha_class``, you can select another captcha module. For now, only ``InternalCaptcha``, ``FriendlyCaptcha`` and ``ReCaptcha`` are supported.

If you want to set up ``ReCaptcha``, you must also configure additional parameters:

.. code-block:: php

   $use_captcha = true;
   $captcha_class = "ReCaptcha";
   $recaptcha_url       = "https://www.google.com/recaptcha/api/siteverify";
   $recaptcha_sitekey   = "sitekey";
   $recaptcha_secretkey = "secretkey";
   $recaptcha_minscore  = 0.5;

See `ReCaptcha documentation <https://developers.google.com/recaptcha/docs/v3>`_ for more information

If you want to set up ``FriendlyCaptcha``, you must also configure additional parameters:

.. code-block:: php

   $use_captcha = true;
   $captcha_class = "FriendlyCaptcha";
   $friendlycaptcha_apiurl  = "https://api.friendlycaptcha.com/api/v1/siteverify";
   $friendlycaptcha_sitekey = "FC123456789";
   $friendlycaptcha_secret  = "secret";

See `FriendlyCaptcha documentation <https://docs.friendlycaptcha.com/>`_ for more information

You can also integrate any other Captcha module by developping the corresponding plugin. (see :doc:`developpers` )

.. _config_cache:

Cache
-----

self-service-password relies on Symfony cache libraries.

First you must choose your cache adapter: File or Redis.

Here are the parameters for File:

.. code-block:: php

   # cache type: File or Redis
   $cache_type = "File";

   # cache namespace: cache entries are grouped in this directory
   $cache_namespace = "sspCache";

   # cache directory: cache entries would be created in this extra
   # directory inside namespace
   $cache_directory = null;

   # default lifetime for all cached entries
   # not really usefull for now as each cache entry has a defined expiration
   # (see cache_token_expiration and cache_form_expiration)
   $cache_default_lifetime = 0;

Here are the parameters for Redis:

.. code-block:: php

   # cache type: File or Redis
   $cache_type = "Redis";

   # Data Source Name (DSN) for accessing to Redis server
   # See https://symfony.com/doc/current/components/cache/adapters/redis_adapter.html
   $cache_redis_url = "redis:user:password@?host[redis1:6379]&timeout=5&dbindex=0";

   # cache namespace: cache entries are prefixed by this namespace
   $cache_namespace = "sspCache";

   # default lifetime for all cached entries
   # not really usefull for now as each cache entry has a defined expiration
   # (see cache_token_expiration and cache_form_expiration)
   $cache_default_lifetime = 0;

You can then define the general parameters for any cache:

.. code-block:: php

   $cache_token_expiration = 3600;

``$cache_token_expiration`` (integer) is the duration in seconds of cached objects each time a token is involved.

For example when sending a token by sms or by mail, it is the time granted to the user for entering the sms code or for clicking on the link in the mail.

it is recommended to set a value >= ``$token_lifetime``

.. code-block:: php

   $cache_form_expiration = 120;

``$cache_form_expiration`` (integer) is the duration in seconds of cached objects at some steps when a user has to validate a form.

For example it is the time granted to a user for validating the email address before sending the mail. It is used mainly for avoiding form replay (by user mistake or by a hacker).

it is recommended to set a value high enough for a user to fill a form.

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
.. |image24| image:: images/ar.png
.. |flag_ko| image:: images/kr.png
