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
# Includes
#==============================================================================
require_once(__DIR__."/../conf/config.inc.php");
require_once(__DIR__."/../lib/vendor/defuse-crypto.phar");
require_once(__DIR__."/../lib/functions.inc.php");

#==============================================================================
# Search all users and encrypt answer
#==============================================================================

# Connect to LDAP
$ldap = ldap_connect($ldap_url);
ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
if ( $ldap_starttls && !ldap_start_tls($ldap) ) {
    fwrite(STDERR, "LDAP - Unable to use StartTLS\n");
    exit(1);
}

# Bind
if ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
    $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
} else {
    $bind = ldap_bind($ldap);
}

if (!$bind) {
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        fwrite(STDERR, "LDAP - Bind error $errno  (".ldap_error($ldap).")\n");
    }
    exit(1);
}

fwrite(STDERR, "Connected to $ldap_url\n");

# Search all users
$ldap_filter = str_replace("{login}", "*", $ldap_filter);
$search = ldap_search($ldap, $ldap_base, $ldap_filter);

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
