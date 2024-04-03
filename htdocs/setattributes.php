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

# This page is called to set value for an LDAP attribute

#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = $presetLogin;
$password = "";
$ldap = "";
$userdata = [];
$userdn = "";
$mail = "";
$phone ="";

if (isset($_POST["mail"]) and $_POST["mail"]) { $mail = strval($_POST["mail"]); }
if (isset($_POST["phone"]) and $_POST["phone"]) { $phone = strval($_POST["phone"]); }
if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = strval($_REQUEST["login"]); }
 else { $result = "loginrequired"; }
if (isset($_POST["password"]) and $_POST["password"]) { $password = strval($_POST["password"]); }
 else { $result = "passwordrequired"; }
if (! isset($_POST["password"]) and ! isset($_REQUEST["login"]))
 { $result = "emptyattributesform"; }

# Check the entered username for characters that our installation doesn't support
if ( $result === "" ) {
    $result = check_username_validity($login,$login_forbidden_chars);
}

#==============================================================================
# Check captcha
#==============================================================================
if ( ( $result === "" ) and $use_captcha) { $result = global_captcha_check();}

#==============================================================================
# Check password
#==============================================================================
if ( $result === "" ) {

    # Connect to LDAP
    $ldap_connection = $ldapInstance->connect();

    $ldap = $ldap_connection[0];
    $result = $ldap_connection[1];

    if ($ldap) {

    # Search for user
    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
    } else {

    # Get user DN
    $entry = ldap_first_entry($ldap, $search);

    if( !$entry ) {
        $result = "badcredentials";
        error_log("LDAP - User $login not found");
    } else {

    $userdn = ldap_get_dn($ldap, $entry);

    # Bind with password
    $bind = ldap_bind($ldap, $userdn, $password);
    if ( !$bind ) {
        $result = "badcredentials";
        $errno = ldap_errno($ldap);
        if ( $errno ) {
            error_log("LDAP - Bind user error $errno (".ldap_error($ldap).")");
        }
}}}}}

#==============================================================================
# Register attributes
#==============================================================================
if ( !$result ) {

    # Rebind as Manager if needed
    if ( $who_change_attributes == "manager" ) {
        $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    }

    if ($attribute_mail and $mail) {
        $userdata[$attribute_mail][0] = $mail;
    }

    if ($attribute_phone and $phone) {
        $userdata[$attribute_phone][0] = $phone;
    }

    $replace = ldap_mod_replace($ldap, $userdn , $userdata);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "attributesmoderror";
        error_log("LDAP - Modify attributes (error $errno (".ldap_error($ldap).")");
    } else {
        $result = "attributeschanged";
    }

}
