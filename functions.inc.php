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

# Create SSHA password
function make_ssha_password($password){
    mt_srand((double)microtime()*1000000);
    $salt = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
    $hash = "{SSHA}" . base64_encode(pack("H*", sha1($password . $salt)) . $salt);
    return $hash;
}

# Strip slashes added by PHP
# Only if magic_quote_gpc is not set to off in php.ini
function stripslashes_if_gpc_magic_quotes( $string ) {
    if(get_magic_quotes_gpc()) {
        return stripslashes($string);
    } else {
        return $string;
    }
}

?>
