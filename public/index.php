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

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Kernel.php';

$debug = false;
$env = 'prod';

$app = new \App\Kernel($env, $debug);

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$response = $app->handle($request);
$response->send();

$app->terminate($request, $response);
