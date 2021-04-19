.. _sms_api:

SMS API
=======

This page presents some code samples to send SMS trough API of SMS
providers.

LinkMobility (pswin)
--------------------

Provider website: https://www.linkmobility.com/

.. code:: php

   function send_sms_by_api($mobile, $message) {
       $post = [
         'USER'  => 'api_username',
         'PW'    => 'api_password',
         'SND'   => 'SenderName',
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

Twilio
------

Provider website: https://www.twilio.com/

Code sample provided in SSP sources:
https://raw.githubusercontent.com/ltb-project/self-service-password/master/lib/smsapi-twilio.inc.php

You can enable it in configuration:

.. code:: php

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
https://api.ovh.com/createToken/index.cgi?GET=/sms&GET=/sms/*&PUT=/sms/*&DELETE=/sms/*&POST=/sms/*

Go to lib/ovhsms and type

.. code:: sh
   composer install

Then you can enable it in configuration:

.. code:: php

   $sms_api_lib = "lib/ovhsms/smsapi-ovh.inc.php";
   $ovh_appkey="KKK";
   $ovh_appsecret="SSS";
   $ovh_consumerkey="CCC";
   $ovh_smssender="MYSENDER";

