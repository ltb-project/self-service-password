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

# health endpoint to check the health of the application

#==============================================================================
# Configuration
#==============================================================================
require_once("../conf/config.inc.php");

#==============================================================================
# Includes
#==============================================================================
require_once("../vendor/autoload.php");
require_once("../lib/functions.inc.php");

#==============================================================================
# Health summary
#==============================================================================
$response = array();

#==============================================================================
# LDAP Health
#==============================================================================
$ldapInstance = new \Ltb\Ldap(
                                 $ldap_url,
                                 $ldap_starttls,
                                 isset($ldap_binddn) ? $ldap_binddn : null,
                                 isset($ldap_bindpw) ? $ldap_bindpw : null,
                                 isset($ldap_network_timeout) ? $ldap_network_timeout : null,
                                 $ldap_base,
                                 null,
                                 isset($ldap_krb5ccname) ? $ldap_krb5ccname : null,
                                 isset($ldap_page_size) ? $ldap_page_size : 0
                             );

try{
    list($ldapConn, $ldapErr) = $ldapInstance->connect();

    if ($ldapConn === false) {
        $response["ldap"] = $ldapErr;
    } else {
        ldap_close($ldapConn);
        $response["ldap"] = "ok";
    }
}
catch(Exception $e) {
    $response["ldap"] = $e->getMessage();
}

#==============================================================================
# Cache Health
#==============================================================================
$cache_class = '\\Ltb\\Cache\\'.$cache_type.'Cache';
switch($cache_type)
{
    case "File":
        $cacheInstance = new $cache_class( $cache_namespace,
                                      $cache_default_lifetime,
                                      $cache_directory
                                    );
        break;

    case "Redis":
        $cacheInstance = new $cache_class( $cache_redis_url,
                                      $cache_namespace,
                                      $cache_default_lifetime
                                    );
        break;

    default:
        $cacheInstance = null;
}

if($cacheInstance === null) {
    $response["cache"] = "unknown cache type: $cache_type";
} else {
    try{
        // create a short-lived (10s) token to test the availability
        $cacheToken = $cacheInstance->generate_form_token(10);
        $response["cache"] = empty($cacheToken)
                              ? "token generator is not working properly"
                              : "ok";
    }
    catch(Exception $e) {
        $response["cache"] = $e->getMessage();
    }
}

#==============================================================================
# Health summary
#==============================================================================
$summary = array_all($response, "array_callback_value_is_ok");

if($summary === true) {
    $response["status"] = "ok";
    $statusCode = 200;
} else {
    $response["status"] = "fail";
    $statusCode = 503;
}

#==============================================================================
# Health response
#==============================================================================
render_api_response($response, $statusCode);
