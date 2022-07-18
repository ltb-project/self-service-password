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

require_once("../lib/vendor/autoload.php");
use Gregwar\Captcha\CaptchaBuilder;

# cookie for captcha session
ini_set("session.use_cookies",1);
ini_set("session.use_only_cookies",1);
session_name("captcha");
session_start();

$captcha = new CaptchaBuilder;
$_SESSION['phrase'] = $captcha->getPhrase();

# session is stored and closed now, used only for captcha
session_write_close();

header('Content-Type: image/jpeg');
$captcha
    ->build()
    ->output()
;
?>
