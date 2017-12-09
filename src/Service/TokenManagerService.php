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

use App\Exception\TokenExpiredException;
use App\Exception\TokenNotFoundException;

/**
 * Class TokenManagerService
 */
class TokenManagerService
{
    /**
     * @var EncryptionService
     */
    private $encryptionService;

    /**
     * @var bool
     */
    private $useEncryption;

    private $tokenLifetime;

    /**
     * TokenManagerService constructor.
     *
     * @param bool              $useEncryption
     * @param EncryptionService $encryptionService
     * @param int|null          $tokenLifetime
     */
    public function __construct($useEncryption, $encryptionService, $tokenLifetime)
    {
        $this->useEncryption = $useEncryption;
        $this->encryptionService = $encryptionService;
        $this->tokenLifetime = $tokenLifetime;
    }

    /**
     * @param string $login
     *
     * @return string
     */
    public function createToken($login)
    {
        // Build and store token

        // Use PHP session to register token
        // We do not generate cookie
        ini_set('session.use_cookies', 0);
        ini_set('session.use_only_cookies', 1);

        session_name('token');
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['time']  = time();

        if ($this->useEncryption) {
            $token = $this->encryptionService->encrypt(session_id());
        } else {
            $token = session_id();
        }

        return $token;
    }

    /**
     * @param string $token
     *
     * @return string
     *
     * @throws TokenExpiredException
     * @throws TokenNotFoundException
     */
    public function openToken($token)
    {
        // Open session with the token
        if ($this->useEncryption) {
            $tokenid = $this->encryptionService->decrypt($token);
        } else {
            $tokenid = $token;
        }

        ini_set('session.use_cookies', 0);
        ini_set('session.use_only_cookies', 1);

        // Manage lifetime with sessions properties
        if ($this->tokenLifetime !== null) {
            ini_set('session.gc_maxlifetime', $this->tokenLifetime);
            ini_set('session.gc_probability', 1);
            ini_set('session.gc_divisor', 1);
        }

        session_id($tokenid);
        session_name('token');
        session_start();
        $login = !empty($_SESSION['login']) ? $_SESSION['login'] : false;

        if (!$login) {
            error_log("Unable to open session $tokenid");
            throw new TokenNotFoundException();
        }

        if ($this->tokenLifetime !== null) {
            // Manage lifetime with session content
            $tokentime = $_SESSION['time'];
            if (time() - $tokentime > $this->tokenLifetime) {
                error_log('Token lifetime expired');
                throw new TokenExpiredException();
            }
        }

        return $login;
    }

    public function destroyToken()
    {
        $_SESSION = [];
        session_destroy();
    }
}
