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

namespace App\Service;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\CryptoException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class EncryptionService
 */
class EncryptionService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $keyphrase;
    private $defuseCrypto;

    /**
     * EncryptionService constructor.
     *
     * @param string $keyphrase Password for encryption
     */
    public function __construct($keyphrase)
    {
        $this->keyphrase = $keyphrase;
        $this->defuseCrypto = new Crypto();
    }

    /**
     * Encrypt a data
     *
     * @param string $data Data to encrypt
     *
     * @return string Encrypted data, base64 encoded
     */
    public function encrypt($data)
    {
        return base64_encode($this->defuseCrypto->encryptWithPassword($data, $this->keyphrase, true));
    }

    /**
     * Decrypt a data
     *
     * @param string $data Encrypted data, base64 encoded
     *
     * @return string Decrypted data
     */
    public function decrypt($data)
    {
        try {
            return $this->defuseCrypto->decryptWithPassword(base64_decode($data), $this->keyphrase, true);
        } catch (CryptoException $e) {
            $this->logger->notice("crypto: decryption error ".$e->getMessage());

            return '';
        }
    }
}
