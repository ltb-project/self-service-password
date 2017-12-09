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

namespace App\Utils;

/**
 * Class SmsTokenGenerator
 */
class SmsTokenGenerator
{
    private $smsTokenLength;

    /**
     * SmsTokenGenerator constructor.
     * @param int $smsTokenLength
     */
    public function __construct($smsTokenLength)
    {
        $this->smsTokenLength = $smsTokenLength;
    }

    /**
     * Generate SMS token
     *
     * @return string
     */
    public function generateSmsCode()
    {
        //TODO remove unnecessary complexity
        $range = explode(',', '48-57');
        $numRanges = count($range);
        $smstoken = '';
        for ($i = 1; $i <= $this->smsTokenLength; ++$i) {
            $r = random_int(0, $numRanges-1);
            list ($min, $max) = explode('-', $range[$r]);
            $smstoken .= chr(random_int($min, $max));
        }

        return $smstoken;
    }
}
