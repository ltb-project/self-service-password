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

use App\Exception\TokenExpiredException;
use App\Exception\TokenNotFound;

class TokenManagerService {
    /**
     * @var EncryptionService
     */
    private $encryptionService;

    /**
     * @var boolean
     */
    private $use_encryption;

    private $token_lifetime;

    /**
     * TokenManagerService constructor.
     * @param $use_encryption boolean
     * @param $encryptionService EncryptionService
     * @param $token_lifetime int|null
     */
    public function __construct($use_encryption, $encryptionService, $token_lifetime)
    {
        $this->use_encryption = $use_encryption;
        $this->encryptionService = $encryptionService;
        $this->token_lifetime = $token_lifetime;
    }

    public function createToken($login) {
        // Build and store token

        // Use PHP session to register token
        // We do not generate cookie
        ini_set('session.use_cookies',0);
        ini_set('session.use_only_cookies',1);

        session_name('token');
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['time']  = time();

        if ( $this->use_encryption ) {
            $token = $this->encryptionService->encrypt(session_id());
        } else {
            $token = session_id();
        }

        return $token;
    }

    /**
     * @param $token
     * @return string
     * @throws TokenExpiredException
     * @throws TokenNotFound
     */
    public function openToken($token) {
        // Open session with the token
        if ( $this->use_encryption ) {
            $tokenid = $this->encryptionService->decrypt($token);
        } else {
            $tokenid = $token;
        }

        ini_set('session.use_cookies',0);
        ini_set('session.use_only_cookies',1);

        // Manage lifetime with sessions properties
        if ($this->token_lifetime != null) {
            ini_set('session.gc_maxlifetime', $this->token_lifetime);
            ini_set('session.gc_probability',1);
            ini_set('session.gc_divisor',1);
        }

        session_id($tokenid);
        session_name('token');
        session_start();
        $login = !empty($_SESSION['login']) ? $_SESSION['login'] : false;

        if ( !$login ) {
            error_log("Unable to open session $tokenid");
            throw new TokenNotFound();
        }

        if ($this->token_lifetime != null) {
            // Manage lifetime with session content
            $tokentime = $_SESSION['time'];
            if ( time() - $tokentime > $this->token_lifetime ) {
                error_log('Token lifetime expired');
                throw new TokenExpiredException();
            }
        }

        return $login;
    }

    public function destroyToken() {
        $_SESSION = [];
        session_destroy();
    }
}
