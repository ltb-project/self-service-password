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

#==============================================================================
# Includes
#==============================================================================
require_once(__DIR__."/../conf/config.inc.php");
require_once(__DIR__."/../lib/functions.inc.php");
require_once(__DIR__."/../vendor/autoload.php");

#==============================================================================
# Search all users and encrypt answer
#==============================================================================

# Connect to LDAP
$ldap_connection = $ldapInstance->connect();

$ldap = $ldap_connection[0];
$result = $ldap_connection[1];

if (!$ldap) {
    fwrite(STDERR, "Error code: $result");
    exit(1);
}

fwrite(STDERR, "Connected to $ldap_url\n");

# Search all users
$ldap_filter = str_replace("{login}", "*", $ldap_filter);
$search = $ldapInstance->search_with_scope($ldap_scope, $ldap_base, $ldap_filter);

if (!$search) {
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        fwrite(STDERR, "LDAP - Search error $errno (".ldap_error($ldap).")\n");
    }
    exit(1);
}

# Get search results
$nb_entries = ldap_count_entries($ldap, $search);

fwrite(STDERR, "$nb_entries user entries found\n");

$entries = ldap_get_entries($ldap, $search);
unset($entries["count"]);

$mod_count = 0;

foreach($entries as $entry) {

    unset($entry["count"]);

    # Find answer attribute
    if (isset($entry[$answer_attribute])) {

        $questionValues = $entry[$answer_attribute];
        unset($questionValues["count"]);

        foreach ($questionValues as $questionValue) {
            if (preg_match("/^\{.*\}.*$/",$questionValue)) {
                fwrite(STDERR, "Encrypt answer value for ".$entry['dn']."\n");
                $crypted_answer = encrypt( $questionValue, $keyphrase);
                $modifs = [
                    [ "attrib" => $answer_attribute, "modtype" => LDAP_MODIFY_BATCH_REMOVE, "values" => [ $questionValue ] ],
                    [ "attrib" => $answer_attribute, "modtype" => LDAP_MODIFY_BATCH_ADD, "values" => [ $crypted_answer ] ]
                ];
                $modification = ldap_modify_batch($ldap, $entry["dn"], $modifs);
                if ( !$modification ) {
                    $errno = ldap_errno($ldap);
                    if ( $errno ) {
                        fwrite(STDERR, "LDAP - Modify error $errno (".ldap_error($ldap).")\n");
                    }
                } else {
                    fwrite(STDERR, "Answer updated in LDAP directory\n");
                    $mod_count++;
                }
            }
        }
    }
}

fwrite(STDERR, "$mod_count modifications done\n");

exit(0);
