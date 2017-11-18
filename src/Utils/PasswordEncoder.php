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

namespace App\Utils;

class PasswordEncoder {
    private $hash_options;

    public function __construct($hash_options)
    {
        $this->hash_options = $hash_options;
    }

    public function hash($scheme, $password) {
        $scheme = strtoupper($scheme);

        if ( $scheme == "SSHA" ) {
            return $this->make_ssha_password($password);
        }
        if ( $scheme == "SSHA256" ) {
            return $this->make_ssha256_password($password);
        }
        if ( $scheme == "SSHA384" ) {
            return $this->make_ssha384_password($password);
        }
        if ( $scheme == "SSHA512" ) {
            return $this->make_ssha512_password($password);
        }
        if ( $scheme == "SHA" ) {
            return $this->make_sha_password($password);
        }
        if ( $scheme == "SHA256" ) {
            return $this->make_sha256_password($password);
        }
        if ( $scheme == "SHA384" ) {
            return $this->make_sha384_password($password);
        }
        if ( $scheme == "SHA512" ) {
            return $this->make_sha512_password($password);
        }
        if ( $scheme == "SMD5" ) {
            return $this->make_smd5_password($password);
        }
        if ( $scheme == "MD5" ) {
            return $this->make_md5_password($password);
        }
        if ( $scheme == "CRYPT" ) {
            return $this->make_crypt_password($password, $this->hash_options);
        }

        // TODO log algo not found
        return $password;
    }

    public function format($format, $password) {
        $format = strtoupper($format);

        if($format == 'ad') {
            return $this->make_ad_password($password);
        }

        if($format == 'nt') {
            return $this->make_md4_password($password);
        }

        return $password;
    }

    /**
     * Create SSHA password
     * @param $password
     * @return string
     */
    private function make_ssha_password($password) {
        $salt = random_bytes(4);
        $hash = "{SSHA}" . base64_encode(pack("H*", sha1($password . $salt)) . $salt);
        return $hash;
    }

    /**
     * Create SSHA256 password
     * @param $password
     * @return string
     */
    private function make_ssha256_password($password) {
        $salt = random_bytes(4);
        $hash = "{SSHA256}" . base64_encode(pack("H*", hash('sha256', $password . $salt)) . $salt);
        return $hash;
    }

    /**
     * Create SSHA384 password
     * @param $password
     * @return string
     */
    private function make_ssha384_password($password) {
        $salt = random_bytes(4);
        $hash = "{SSHA384}" . base64_encode(pack("H*", hash('sha384', $password . $salt)) . $salt);
        return $hash;
    }

    /**
     * Create SSHA512 password
     * @param $password
     * @return string
     */
    private function make_ssha512_password($password) {
        $salt = random_bytes(4);
        $hash = "{SSHA512}" . base64_encode(pack("H*", hash('sha512', $password . $salt)) . $salt);
        return $hash;
    }

    /**
     * Create SHA password
     * @param $password
     * @return string
     */
    private function make_sha_password($password) {
        $hash = "{SHA}" . base64_encode(pack("H*", sha1($password)));
        return $hash;
    }

    /**
     * Create SHA256 password
     * @param $password
     * @return string
     */
    private function make_sha256_password($password) {
        $hash = "{SHA256}" . base64_encode(pack("H*", hash('sha256', $password)));
        return $hash;
    }

    /**
     * Create SHA384 password
     * @param $password
     * @return string
     */
    private function make_sha384_password($password) {
        $hash = "{SHA384}" . base64_encode(pack("H*", hash('sha384', $password)));
        return $hash;
    }

    /**
     * Create SHA512 password
     * @param $password
     * @return string
     */
    private function make_sha512_password($password) {
        $hash = "{SHA512}" . base64_encode(pack("H*", hash('sha512', $password)));
        return $hash;
    }

    /**
     * Create SMD5 password
     * @param $password
     * @return string
     */
    private function make_smd5_password($password) {
        $salt = random_bytes(4);
        $hash = "{SMD5}" . base64_encode(pack("H*", md5($password . $salt)) . $salt);
        return $hash;
    }

    /**
     * Create MD5 password
     * @param $password
     * @return string
     */
    private function make_md5_password($password) {
        $hash = "{MD5}" . base64_encode(pack("H*", md5($password)));
        return $hash;
    }

    /**
     * Create CRYPT password
     * @param $password
     * @param $hash_options
     * @return string
     */
    private function make_crypt_password($password, $hash_options) {

        $salt_length = 2;
        if ( isset($hash_options['crypt_salt_length']) ) {
            $salt_length = $hash_options['crypt_salt_length'];
        }

        // Generate salt
        $possible = '0123456789'.
            'abcdefghijklmnopqrstuvwxyz'.
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.
            './';
        $salt = "";

        while( strlen( $salt ) < $salt_length ) {
            $salt .= substr( $possible, random_int( 0, strlen( $possible ) - 1 ), 1 );
        }

        if ( isset($hash_options['crypt_salt_prefix']) ) {
            $salt = $hash_options['crypt_salt_prefix'] . $salt;
        }

        $hash = '{CRYPT}' . crypt( $password,  $salt);
        return $hash;
    }

    /**
     * Create MD4 password (Microsoft NT password format)
     * @param $password
     * @return string
     */
    private function make_md4_password($password) {
        if (function_exists('hash')) {
            // better function available, we use it
            return strtoupper( hash( "md4", iconv( "UTF-8", "UTF-16LE", $password ) ) );
        }

        return strtoupper( bin2hex( mhash( MHASH_MD4, iconv( "UTF-8", "UTF-16LE", $password ) ) ) );
    }

    /**
     * Create AD password (Microsoft Active Directory password format)
     * @param $password
     * @return string
     */
    private function make_ad_password($password) {
        $password = "\"" . $password . "\"";
        $adpassword = mb_convert_encoding($password, "UTF-16LE", "UTF-8");
        return $adpassword;
    }
}
