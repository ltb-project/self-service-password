.. _sms_api:

SMS API
=======

This page presents some code samples to send SMS trough API of SMS
providers.

LinkMobility (pswin)
--------------------

Provider website: https://www.linkmobility.com/

.. code-block:: php

   <?php namespace smsapi;
   /*
    * Add to your config.inc.local.php
    *
    * $signal_user= '+18881234567';
    * $signal_config = '<path to config folder>';
    * $signal_cli = '<path to signal-cli>';
    */

   class smsLink
   {

        public $api_username;
        public $api_password;
        public $SenderName;

        public function __construct($api_username, $api_password, $SenderName)
        {
             $this->api_username = $api_username;
             $this->api_password = $api_password;
             $this->SenderName = $SenderName;
        }

       function send_sms_by_api($mobile, $message) {
           $post = [
             'USER'  => $this->api_username,
             'PW'    => $this->api_password,
             'SND'   => $this->SenderName,
             'RCV'   => $mobile,
             'TXT'   => $message,
           ];
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, 'https://simple.pswin.com');
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
           $response = curl_exec($ch);

           return 1;
       }
   }

Twilio
------

Provider website: https://www.twilio.com/

Code sample provided in SSP sources:
https://raw.githubusercontent.com/ltb-project/self-service-password/master/lib/smsapi-twilio.inc.php

You can enable it in configuration:

.. code-block:: php

   $sms_api_lib = "lib/smsapi-twilio.inc.php";
   $twilio_sid = '<sid>';
   $twilio_auth_token = '<authtoken>';
   $twilio_outgoing_number = '+18881234567';
   $twilio_lookup_first = true;

OVH
---

Provider website: https://www.ovh.com/

Code sample provided in SSP sources:
https://raw.githubusercontent.com/ltb-project/self-service-password/master/lib/smsapi-ovh.inc.php

Get credentials here:
`<https://api.ovh.com/createToken/index.cgi?GET=/sms&GET=/sms/*&PUT=/sms/*&DELETE=/sms/*&POST=/sms/*>`_

Go to lib/ovhsms and type:

.. prompt:: bash $

   composer install

Then you can enable it in configuration:

.. code-block:: php

   $sms_api_lib = "lib/ovhsms/smsapi-ovh.inc.php";
   $ovh_appkey="KKK";
   $ovh_appsecret="SSS";
   $ovh_consumerkey="CCC";
   $ovh_smssender="MYSENDER";

Signal
------

Provider website: https://www.signal.org

This provider uses the instant messanger signal to send tokens.

Install signal-cli:
https://github.com/AsamK/signal-cli

You've to configure / register signal-cli:
https://github.com/AsamK/signal-cli#readme

.. code-block:: php

   $sms_api_lib = "lib/smsapi-signal-cli.inc.php";
   $signal_user = '+18881234567';
   $signal_config = '<path to signal-cli config folder>';
   $signal_cli = '<path to signal-cli binaray>';
