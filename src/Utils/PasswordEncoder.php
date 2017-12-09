<?php
/*
 * LTB Self Service Password
 *
 * Copyright (C) 2009 Clement OUDOT
 * Copyright (C) 2009 LTB-project.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * GPL License: http://www.gnu.org/licenses/gpl.txt
 */

namespace App\Utils;

/**
 * Class PasswordEncoder
 */
class PasswordEncoder
{
    private $hashOptions;

    /**
     * PasswordEncoder constructor.
     *
     * @param array $hashOptions
     */
    public function __construct($hashOptions)
    {
        $this->hashOptions = $hashOptions;
    }

    /**
     * @param string $scheme
     * @param string $password
     *
     * @return string
     */
    public function hash($scheme, $password)
    {
        $scheme = strtoupper($scheme);

        if ("SSHA" === $scheme) {
            return $this->makeSshaPassword($password);
        }
        if ("SSHA256" === $scheme) {
            return $this->makeSsha256Password($password);
        }
        if ("SSHA384" === $scheme) {
            return $this->makeSsha384Password($password);
        }
        if ("SSHA512" === $scheme) {
            return $this->makeSsha512Password($password);
        }
        if ("SHA" === $scheme) {
            return $this->makeShaPassword($password);
        }
        if ("SHA256" === $scheme) {
            return $this->makeSha256Password($password);
        }
        if ("SHA384" === $scheme) {
            return $this->makeSha384Password($password);
        }
        if ("SHA512" === $scheme) {
            return $this->makeSha512Password($password);
        }
        if ("SMD5" === $scheme) {
            return $this->makeSmd5Password($password);
        }
        if ("MD5" === $scheme) {
            return $this->makeMd5Password($password);
        }
        if ("CRYPT" === $scheme) {
            return $this->makeCryptPassword($password, $this->hashOptions);
        }

        // TODO log algo not found
        return $password;
    }

    /**
     * @param string $format
     * @param string $password
     *
     * @return string
     */
    public function format($format, $password)
    {
        $format = strtoupper($format);

        if ('ad' === $format) {
            return $this->makeAdPassword($password);
        }

        if ('nt' === $format) {
            return $this->makeMd4Password($password);
        }

        return $password;
    }

    /**
     * Create SSHA password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSshaPassword($password)
    {
        $salt = random_bytes(4);
        $hash = "{SSHA}".base64_encode(pack("H*", sha1($password.$salt)).$salt);

        return $hash;
    }

    /**
     * Create SSHA256 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSsha256Password($password)
    {
        $salt = random_bytes(4);
        $hash = "{SSHA256}".base64_encode(pack("H*", hash('sha256', $password.$salt)).$salt);

        return $hash;
    }

    /**
     * Create SSHA384 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSsha384Password($password)
    {
        $salt = random_bytes(4);
        $hash = "{SSHA384}".base64_encode(pack("H*", hash('sha384', $password.$salt)).$salt);

        return $hash;
    }

    /**
     * Create SSHA512 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSsha512Password($password)
    {
        $salt = random_bytes(4);
        $hash = "{SSHA512}".base64_encode(pack("H*", hash('sha512', $password.$salt)).$salt);

        return $hash;
    }

    /**
     * Create SHA password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeShaPassword($password)
    {
        $hash = "{SHA}".base64_encode(pack("H*", sha1($password)));

        return $hash;
    }

    /**
     * Create SHA256 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSha256Password($password)
    {
        $hash = "{SHA256}".base64_encode(pack("H*", hash('sha256', $password)));

        return $hash;
    }

    /**
     * Create SHA384 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSha384Password($password)
    {
        $hash = "{SHA384}".base64_encode(pack("H*", hash('sha384', $password)));

        return $hash;
    }

    /**
     * Create SHA512 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSha512Password($password)
    {
        $hash = "{SHA512}".base64_encode(pack("H*", hash('sha512', $password)));

        return $hash;
    }

    /**
     * Create SMD5 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeSmd5Password($password)
    {
        $salt = random_bytes(4);
        $hash = "{SMD5}".base64_encode(pack("H*", md5($password.$salt)).$salt);

        return $hash;
    }

    /**
     * Create MD5 password
     *
     * @param string $password
     *
     * @return string
     */
    private function makeMd5Password($password)
    {
        $hash = "{MD5}".base64_encode(pack("H*", md5($password)));

        return $hash;
    }

    /**
     * Create CRYPT password
     *
     * @param string $password
     * @param array  $hashOptions
     *
     * @return string
     */
    private function makeCryptPassword($password, $hashOptions)
    {

        $saltLength = 2;
        if (isset($hashOptions['crypt_salt_length'])) {
            $saltLength = $hashOptions['crypt_salt_length'];
        }

        // Generate salt
        $possible = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ./';
        $salt = '';

        while (strlen($salt) < $saltLength) {
            $salt .= substr($possible, random_int(0, strlen($possible) - 1), 1);
        }

        if (isset($hashOptions['crypt_salt_prefix'])) {
            $salt = $hashOptions['crypt_salt_prefix'].$salt;
        }

        $hash = '{CRYPT}'.crypt($password, $salt);

        return $hash;
    }

    /**
     * Create MD4 password (Microsoft NT password format)
     *
     * @param string $password
     *
     * @return string
     */
    private function makeMd4Password($password)
    {
        if (function_exists('hash')) {
            // better function available, we use it
            return strtoupper(hash("md4", iconv("UTF-8", "UTF-16LE", $password)));
        }

        return strtoupper(bin2hex(mhash(MHASH_MD4, iconv("UTF-8", "UTF-16LE", $password))));
    }

    /**
     * Create AD password (Microsoft Active Directory password format)
     *
     * @param string $password
     *
     * @return string
     */
    private function makeAdPassword($password)
    {
        $password = '"'.$password.'"';
        $adPassword = mb_convert_encoding($password, 'UTF-16LE', 'UTF-8');

        return $adPassword;
    }
}
