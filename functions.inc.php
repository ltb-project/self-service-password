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
function make_ssha_password($password) {
    mt_srand((double)microtime()*1000000);
    $salt = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
    $hash = "{SSHA}" . base64_encode(pack("H*", sha1($password . $salt)) . $salt);
    return $hash;
}

# Create SHA password
function make_sha_password($password) {
    $hash = "{SHA}" . base64_encode(pack("H*", sha1($password)));
    return $hash;
}

# Create SMD5 password
function make_smd5_password($password) {
    mt_srand((double)microtime()*1000000);
    $salt = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
    $hash = "{SMD5}" . base64_encode(pack("H*", md5($password . $salt)) . $salt);
    return $hash;
}

# Create MD5 password
function make_md5_password($password) {
    $hash = "{MD5}" . base64_encode(pack("H*", md5($password)));
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

# Get message criticity
function get_criticity( $msg ) {
	
	if ( ereg( "nophpldap|ldaperror|nomatch|badcredentials|passworderror" , $msg ) ) {
		return "critical";
	}
	
	if ( ereg( "(login|oldpassword|newpassword|confirmpassword)required" , $msg ) ) {
		return "warning";
	}

	return "ok";
}

?>
