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

namespace App\Framework;

class Request {
    public $query;
    public $request;

    public function __construct($query = array(), $request = array()) {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
    }

    /**
     * Returns the data for $key from the query ($_GET) or the request ($_POST), null if not present
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        if ($this !== $result = $this->query->get($key, $this)) {
            return $result;
        }
        if ($this !== $result = $this->request->get($key, $this)) {
            return $result;
        }
        return $default;
    }

    public static function createFromGlobals()
    {
        return new Request($_GET, $_POST);
    }
}