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

class PasswordStrengthChecker {
    private $pwd_policy_config;

    public function __construct($pwd_policy_config) {
        $this->pwd_policy_config = $pwd_policy_config;
    }

    public function evaluate($newpassword, $oldpassword, $login) {
        extract( $this->pwd_policy_config );

        $result = "";

        $length = strlen(utf8_decode($newpassword));
        preg_match_all("/[a-z]/", $newpassword, $lower_res);
        $lower = count( $lower_res[0] );
        preg_match_all("/[A-Z]/", $newpassword, $upper_res);
        $upper = count( $upper_res[0] );
        preg_match_all("/[0-9]/", $newpassword, $digit_res);
        $digit = count( $digit_res[0] );

        $special = 0;
        if ( isset($pwd_special_chars) && !empty($pwd_special_chars) ) {
            preg_match_all("/[$pwd_special_chars]/", $newpassword, $special_res);
            $special = count( $special_res[0] );
        }

        $forbidden = 0;
        if ( isset($pwd_forbidden_chars) && !empty($pwd_forbidden_chars) ) {
            preg_match_all("/[$pwd_forbidden_chars]/", $newpassword, $forbidden_res);
            $forbidden = count( $forbidden_res[0] );
        }

        # Complexity: checks for lower, upper, special, digits
        if ( $pwd_complexity ) {
            $complex = 0;
            if ( $special > 0 ) { $complex++; }
            if ( $digit > 0 ) { $complex++; }
            if ( $lower > 0 ) { $complex++; }
            if ( $upper > 0 ) { $complex++; }
            if ( $complex < $pwd_complexity ) { $result="notcomplex"; }
        }

        # Minimal lenght
        if ( $pwd_min_length and $length < $pwd_min_length ) { $result="tooshort"; }

        # Maximal lenght
        if ( $pwd_max_length and $length > $pwd_max_length ) { $result="toobig"; }

        # Minimal lower chars
        if ( $pwd_min_lower and $lower < $pwd_min_lower ) { $result="minlower"; }

        # Minimal upper chars
        if ( $pwd_min_upper and $upper < $pwd_min_upper ) { $result="minupper"; }

        # Minimal digit chars
        if ( $pwd_min_digit and $digit < $pwd_min_digit ) { $result="mindigit"; }

        # Minimal special chars
        if ( $pwd_min_special and $special < $pwd_min_special ) { $result="minspecial"; }

        # Forbidden chars
        if ( $forbidden > 0 ) { $result="forbiddenchars"; }

        # Same as old password?
        if ( $pwd_no_reuse and $newpassword === $oldpassword ) { $result="sameasold"; }

        # Same as login?
        if ( $pwd_diff_login and $newpassword === $login ) { $result="sameaslogin"; }

        return $result;
    }
}
