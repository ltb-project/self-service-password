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

namespace App\Utils;

class SmsTokenGenerator {
    private $sms_token_length;

    public function __construct($sms_token_length)
    {
        $this->sms_token_length = $sms_token_length;
    }

    /**
     * Generate SMS token
     */
    public function generate_sms_code() {
        $Range=explode(',','48-57');
        $NumRanges=count($Range);
        $smstoken='';
        for ($i = 1; $i <= $this->sms_token_length; $i++){
            $r=random_int(0,$NumRanges-1);
            list($min,$max)=explode('-',$Range[$r]);
            $smstoken.=chr(random_int($min,$max));
        }
        return $smstoken;
    }
}
