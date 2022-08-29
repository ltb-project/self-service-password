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

class LtbAttributeValue {
    public $attribute;
    public $value;

    public function __construct($attribute, $value) {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    /** function LtbAttributeValue::ldap_get_first_available_value($ldap, $entry, $attributes)
     * Get from ldap entry first value of first existing attribute within $attributes in order
     * @param $ldap ldap connection object
     * @param $entry ldap entry to parse
     * @param $attributes array of attributes names
     * @return object LtbAttributeValue of found attribute and value, or false if not found
     */
    public static function ldap_get_first_available_value($ldap, $entry, $attributes)
    {
        # loop on attributes, stop on first found
        $entry_attributes = ldap_get_attributes($ldap, $entry);
        for ($i = 0; $i < sizeof($attributes); $i++) {
            $attribute = $attributes[$i];
            if ( in_array($attribute, $entry_attributes) ) {
                $values = ldap_get_values($ldap, $entry, $attribute);
                if ( $values && ( $values['count'] > 0 ) ) {
                    return new LtbAttributeValue($attribute,$values[0]);
                }
            }
        }
        return false;
    }

    /** function LtbAttributeValue::ldap_get_mail_for_notification($ldap, $entry) {
     * Get from ldap entry first value corresponding to $mail_attributes (globally configured)
     * @param $ldap ldap connection object
     * @param $entry ldap entry to parse
     * @return mail to use for notification or empty string if not found
     */
    function ldap_get_mail_for_notification($ldap, $entry) {
        # mail_attibutes are set globally in configuration
        global $mail_attributes;
        $mailValue =  LtbAttributeValue::ldap_get_first_available_value($ldap, $entry, $mail_attributes);
        $mail="";
        if ( $mailValue ) {
            if (strcasecmp($mailValue->attribute, "proxyAddresses") == 0) {
                $mail = str_ireplace("smtp:", "", $mailValue->value);
            } else {
                $mail = $mailValue->value;
            }
        }
        return $mail;
    }
}
