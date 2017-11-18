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

class RecaptchaService {
    /**
     * @var string shared secret with reCAPTCHA server
     */
    private $privatekey;

    /**
     * @var null|string FQCN of request method, null for default
     */
    private $request_method;

    public function __construct($privatekey, $request_method)
    {
        $this->privatekey = $privatekey;
        $this->request_method = $request_method;
    }

    /**
     * Check if $response verifies the reCAPTCHA by asking the recaptcha server, logs if errors
     * @param $response string response provided by user
     * @param $login string for logging purposes only
     * @return string empty string if the response is verified successfully, else string 'badcaptcha'
     */
    public function verify($response, $login) {
        $recaptcha = new ReCaptcha($this->privatekey, is_null($this->request_method) ? null : new $this->request_method());
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
}