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

class ResetUrlGenerator {
    private $reset_url;

    public function __construct($reset_url)
    {
        $this->reset_url = $reset_url;
    }

    public function generate_reset_url($params) {
        if ( empty($this->reset_url) ) {

            // Build reset by token URL
            $method = "http";
            if ( !empty($_SERVER['HTTPS']) ) { $method .= "s"; }
            $server_name = $_SERVER['SERVER_NAME'];
            $server_port = $_SERVER['SERVER_PORT'];
            $script_name = $_SERVER['SCRIPT_NAME'];

            // Force server port if non standard port
            if (   ( $method === "http"  and $server_port != "80"  )
                or ( $method === "https" and $server_port != "443" )
            ) {
                $server_name .= ":".$server_port;
            }

            $this->reset_url = $method."://".$server_name.$script_name;
        }

        return $this->reset_url . '?' . http_build_query(array ('action' => 'resetbytoken') + $params);
    }

}