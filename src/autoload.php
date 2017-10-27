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

require_once __DIR__ . "/../vendor/defuse-crypto.phar";
require_once __DIR__ . "/../vendor/Psr/Container/ContainerInterface.php";
require_once __DIR__ . "/../vendor/Psr/Container/ContainerExceptionInterface.php";
require_once __DIR__ . "/../vendor/Psr/Container/NotFoundExceptionInterface.php";

require_once __DIR__ . "/../vendor/autoload.php"; // recaptcha autoload
require_once 'phar://'. __DIR__ . '/../vendor/twig.phar/Twig/Autoloader.php';
// no autoloaded required, everything is preincluded in the phar
Twig_Autoloader::register();
require_once __DIR__ . "/../vendor/PHPMailer/PHPMailerAutoload.php";
// no autoloaded required, everything is preincluded in the phar
require_once __DIR__ . "/../vendor/pimple.phar";

spl_autoload_register(function ($class) {
    if (substr($class, 0, 4) !== 'App\\') {
        /* If the class does not lie under the "App" namespace,
         * then we can exit immediately.
         */
        return;
    }

    $class = substr($class, 4); // Remove "App\" prefix

    /* All of the classes have names like "App\Foo", so we need
     * to replace the backslashes with frontslashes if we want the
     * name to map directly to a location in the filesystem.
     */
    $class = str_replace('\\', '/', $class);

    $path = dirname(__FILE__).'/'.$class.'.php';

    if (is_readable($path)) {
        require_once $path;
    }

});