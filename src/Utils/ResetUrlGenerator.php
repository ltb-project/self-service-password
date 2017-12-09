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
 * Class ResetUrlGenerator
 */
class ResetUrlGenerator
{
    private $resetUrl;

    /**
     * ResetUrlGenerator constructor.
     * @param string|null $resetUrl
     */
    public function __construct($resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function generateResetUrl($params)
    {
        if (empty($this->resetUrl)) {
            // Build reset by token URL
            $method = "http";
            if (!empty($_SERVER['HTTPS'])) {
                $method .= "s";
            }
            $serverName = $_SERVER['SERVER_NAME'];
            $serverPort = $_SERVER['SERVER_PORT'];
            $scriptName = $_SERVER['SCRIPT_NAME'];

            // Force server port if non standard port
            if (   ( $method === "http"  and $serverPort != "80"  )
                or ( $method === "https" and $serverPort != "443" )
            ) {
                $serverName .= ":".$serverPort;
            }

            $this->resetUrl = $method."://".$serverName.$scriptName;
        }

        return $this->resetUrl.'?'.http_build_query(['action' => 'resetbytoken'] + $params);
    }

}