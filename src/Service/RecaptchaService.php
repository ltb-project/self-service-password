<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
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

namespace App\Service;

use ReCaptcha\ReCaptcha;

/* @function string check_recaptcha(string $recaptcha_privatekey, null|string $recaptcha_request_method, string $response, string $login)
 * Check if $response verifies the reCAPTCHA by asking the recaptcha server, logs if errors
 * @param $recaptcha_privatekey string shared secret with reCAPTCHA server
 * @param $recaptcha_request_method null|string FQCN of request method, null for default
 * @param $response string response provided by user
 * @param $login string for logging purposes only
 * @return string empty string if the response is verified successfully, else string 'badcaptcha'
 */
function check_recaptcha($recaptcha_privatekey, $recaptcha_request_method, $response, $login) {
    $recaptcha = new ReCaptcha($recaptcha_privatekey, is_null($recaptcha_request_method) ? null : new $recaptcha_request_method());
    $resp = $recaptcha->verify($response, $_SERVER['REMOTE_ADDR']);

    if (!$resp->isSuccess()) {
        error_log("Bad reCAPTCHA attempt with user $login");
        foreach ($resp->getErrorCodes() as $code) {
            error_log("reCAPTCHA error: $code");
        }
        return 'badcaptcha';
    }

    return '';
}

class RecaptchaService {
    private $privatekey;
    private $request_method;

    public function __construct($privatekey, $request_method)
    {
        $this->privatekey = $privatekey;
        $this->request_method = $request_method;
    }

    public function verify($response, $login) {
        return $result = check_recaptcha($this->privatekey, $this->request_method, $response, $login);
    }
}