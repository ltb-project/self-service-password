reCAPTCHA
=========

Presentation
------------

reCAPTCHA is a `CAPTCHA <http://en.wikipedia.org/wiki/CAPTCHA>`__
service provided by `Google <http://www.google.com>`__.

.. warning:: reCAPTCHA require an internet connection bewteen the
  server hosting Self Service Password and Google.

Google provide a PHP library and an API that will validate the CAPTCHA,
see `reCAPTCHA website <http://www.google.com/recaptcha>`__ to know
more.

.. tip:: The reCAPTCHA is used on every form in Self Service Password
  (password change, token, questions, etc.)

Configuration
-------------

Activation
~~~~~~~~~~

Set this to activate reCAPTCHA feature:

.. code:: php

   $use_recaptcha = true;

API keys
~~~~~~~~

You need to get your own API keys from `reCAPTCHA
website <http://www.google.com/recaptcha>`__. Then configure them in
SSP:

.. code:: php

   $recaptcha_publickey = "xxxx";
   $recaptcha_privatekey = "xxxx";

Display
~~~~~~~

You can customize the widget (see
https://developers.google.com/recaptcha/docs/display):

.. code:: php

   $recaptcha_theme = "light"; # dark / light
   $recaptcha_type = "image"; # audio / image
   $recaptcha_size = "normal"; # compact / normal

Request method
~~~~~~~~~~~~~~

When ``allow_url_fopen`` is disallowed for security reason, you can
force the request method:

.. code:: php

   $recaptcha_request_method = '\ReCaptcha\RequestMethod\CurlPost';

