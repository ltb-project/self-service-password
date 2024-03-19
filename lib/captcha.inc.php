<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2024 Clement OUDOT
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

require_once(__DIR__."/../vendor/autoload.php");

use Gregwar\Captcha\PhraseBuilder;

function check_captcha( $captcha_value, $user_value ) {
    return PhraseBuilder::comparePhrases($captcha_value,$user_value);
}

# see ../htdocs/captcha.php where captcha cookie and $_SESSION['phrase'] are set.
function global_captcha_check() {
    $result="";
    if (isset($_POST["captchaphrase"]) and $_POST["captchaphrase"]) {
        # captcha cookie for session
        ini_set("session.use_cookies",1);
        ini_set("session.use_only_cookies",1);
        setcookie("captcha", '', time()-1000);
        session_name("captcha");
        session_start();
        $captchaphrase = strval($_POST["captchaphrase"]);
        if (!isset($_SESSION['phrase']) or !check_captcha($_SESSION['phrase'], $captchaphrase)) {
            $result = "badcaptcha";
        }
        unset($_SESSION['phrase']);
        # write session to make sure captcha phrase is no more included in session.
        session_write_close();
    }
    else {
        $result = "captcharequired";
    }
    return $result;
}
