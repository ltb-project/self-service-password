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

#==============================================================================
# Configuration
#==============================================================================
# LDAP
$ldap_url = "ldap://localhost";
$ldap_binddn = "cn=manager,dc=example,dc=com";
$ldap_bindpw = "secret";
$ldap_base = "dc=example,dc=com";
$ldap_filter = "(&(objectClass=person)(uid={login}))";

# Active Directory mode
# true: use unicodePwd as password field
# false: LDAPv3 standard behavior
$ad_mode = false;

# Samba mode
# true: update sambaNTpassword and sambaPwdLastSet attributes too
# false: just update the password
# Warning: this require mhash() to be installed on your system
$samba_mode = false;

# Hash mechanism for password:
# SSHA
# SHA
# SMD5
# MD5
# CRYPT
# clear (the default)
# This option is not used with ad_mode = true
$hash = "clear";

# Local password policy
# This is applied before directory password policy
# Minimal length
$pwd_min_length = 0;
# Maximal length
$pwd_max_length = 0;
# Minimal lower characters
$pwd_min_lower = 0;
# Minimal upper characters
$pwd_min_upper = 0;
# Minimal digit characters
$pwd_min_digit = 0;
# Minimal special characters
$pwd_min_special = 0;
# Definition of special characters
$pwd_special_chars = "^a-zA-Z0-9";
# Forbidden characters
#$pwd_forbidden_chars = "@%";
# Show policy constraints message
$pwd_show_policy = false;

# Who changes the password?
# user: the user itself
# manager: the above binddn
$who_change_password = "user";

# Language
$lang ="en";

# Logo
$logo = "style/ltb-logo.png";

# Debug mode
$debug = false;
?>
