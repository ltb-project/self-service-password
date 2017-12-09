<?php
/*
 * LTB Self Service Password
 *
 * Copyright (C) 2009 Clement OUDOT
 * Copyright (C) 2009 LTB-project.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * GPL License: http://www.gnu.org/licenses/gpl.txt
 */

namespace App\Service;

use ReCaptcha\ReCaptcha;

/**
 * Class RecaptchaService
 */
class RecaptchaService
{
    /**
     * @var string shared secret with reCAPTCHA server
     */
    private $privatekey;

    /**
     * @var null|string FQCN of request method, null for default
     */
    private $requestMethod;

    /**
     * RecaptchaService constructor.
     * @param string $privatekey
     * @param string $requestMethod
     */
    public function __construct($privatekey, $requestMethod)
    {
        $this->privatekey = $privatekey;
        $this->requestMethod = $requestMethod;
    }

    /**
     * Check if $response verifies the reCAPTCHA by asking the recaptcha server, logs if errors
     *
     * @param string $response response provided by user
     * @param string $login    for logging purposes only
     *
     * @return string empty string if the response is verified successfully, else string 'badcaptcha'
     */
    public function verify($response, $login)
    {
        $recaptcha = new ReCaptcha($this->privatekey, is_null($this->requestMethod) ? null : new $this->requestMethod());
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
