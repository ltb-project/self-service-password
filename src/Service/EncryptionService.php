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

namespace App\Service;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\CryptoException;

class EncryptionService {
    private $keyphrase;

    /**
     * EncryptionService constructor.
     * @param $keyphrase @param string $keyphrase Password for encryption
     */
    public function __construct($keyphrase) {
        $this->keyphrase = $keyphrase;
    }

    /* @function encrypt(string $data)
     * Encrypt a data
     * @param string $data Data to encrypt
     * @return string Encrypted data, base64 encoded
     */
    public function encrypt($data) {
        return base64_encode(Crypto::encryptWithPassword($data, $this->keyphrase, true));
    }

    /* @function decrypt(string $data)
     * Decrypt a data
     * @param string $data Encrypted data, base64 encoded
     * @return string Decrypted data
     */
    public function decrypt($data) {
        try {
            return Crypto::decryptWithPassword(base64_decode($data), $this->keyphrase, true);
        } catch (CryptoException $e) {
            error_log("crypto: decryption error " . $e->getMessage());
            return '';
        }
    }
}
