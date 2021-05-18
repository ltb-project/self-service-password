<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2024 LTB-project.org
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# GPL License: http://www.gnu.org/licenses/gpl.txt
#
#==============================================================================

/*
 * Add to your config.inc.local.php
 * Credentials are on the main page of the dashboard - https://www.twilio.com/console
 * Phone numbers can be purchased and managed from the phone number dashboard
 * - https://www.twilio.com/console/phone-numbers/search
 *
 * $twilio_sid = '<sid>';
 * $twilio_auth_token = '<authtoken>';
 * $twilio_outgoing_number = '+18881234567';
 * true if you want to ask twilio if the number is valid, and reformat it
 * false otherwise
 * $twilio_lookup_first = true / false
 */

/* @function boolean send_sms_by_api(string $mobile, string $message)
 * Send SMS trough an API
 * @param mobile mobile number
 * @param message text to send
 * @return 1 if message sent, 0 if not
 */
function send_sms_by_api($mobile, $message) {
    global $twilio_sid, $twilio_auth_token, $twilio_outgoing_number, $twilio_lookup_first;
    if (!$twilio_sid || !$twilio_auth_token) {
      error_log('Trying to access twilio without credentials. Set twilio_sid and twilio_auth_token in your config.inc.local.php with values from https://www.twilio.com/console');
      return 0;
    }

    if (!$twilio_outgoing_number) {
      error_log('No outgoing twilio number, set twilio_outgoing_number in config.inc.local.php with values from https://www.twilio.com/console/phone-numbers/search');
      return 0;
    }

    if ($twilio_lookup_first) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://lookups.twilio.com/v1/PhoneNumbers/' . rawurlencode($mobile));
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, $twilio_sid . ":" . $twilio_auth_token);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
      curl_close($ch);
      if ($http_code != "200") {
        error_log("Error code $http_code from twilio: $response");
        return 0;
      }
      $json = json_decode($response, true);
      if (@$json['code'] || @$json['message']) {
        error_log("Error from twilio: $response");
        return 0;
      }

      $mobile = $json['phone_number'];
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.twilio.com/2010-04-01/Accounts/' . rawurlencode($twilio_sid) . '/Messages.json');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, $twilio_sid . ":" . $twilio_auth_token);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
      'Body' => $message,
      'From' => $twilio_outgoing_number,
      'To' => $mobile
    )));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    if ($http_code != "200" && $http_code != "201") {
      error_log("Error code $http_code from twilio: $response");
      return 0;
    }
    $json = json_decode($response, true);
    if (@$json['code'] || @$json['message']) {
      error_log("Error from twilio: $response");
      return 0;
    }

    return 1;
}

