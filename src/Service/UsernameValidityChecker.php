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

/**
 * Class UsernameValidityChecker
 */
class UsernameValidityChecker
{
    /**
     * @var string invalid characters
     */
    private $loginForbiddenChars;

    /**
     * UsernameValidityChecker constructor.
     * @param string $forbiddenChars
     */
    public function __construct($forbiddenChars)
    {
        $this->loginForbiddenChars = $forbiddenChars;
    }

    /**
     * Check the user name against a regex or internal ctype_alnum() call to make sure the username doesn't contain
     * predetermined bad values, like an '*' can allow an attacker to 'test' to find valid usernames.
     *
     * @param string $username the user name to test against
     *
     * @return string
     */
    public function evaluate($username)
    {
        // If no forbidden chars are configured, we will check that the username is alphanumeric
        if (!$this->loginForbiddenChars) {
            if (!ctype_alnum($username)) {
                error_log("Non alphanumeric characters in username $username");

                return 'badcredentials';
            }

            return '';
        }

        preg_match_all("/[$this->loginForbiddenChars]/", $username, $forbiddenRest);
        if (count($forbiddenRest[0])) {
            error_log("Illegal characters in username $username (list of forbidden characters: $this->loginForbiddenChars)");

            return 'badcredentials';
        }

        return '';
    }
}
