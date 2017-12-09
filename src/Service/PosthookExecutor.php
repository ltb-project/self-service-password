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

/**
 * Class PosthookExecutor
 */
class PosthookExecutor
{
    private $command;

    /**
     * PosthookExecutor constructor.
     *
     * @param string $command
     */
    public function __construct($command)
    {
        $this->command = $command;
    }

    /**
     * @param string      $login
     * @param string      $newpassword
     * @param string|null $oldpassword
     *
     * @return array
     */
    public function execute($login, $newpassword, $oldpassword = null)
    {
        $command = escapeshellcmd($this->command).' '.escapeshellarg($login).' '.escapeshellarg($newpassword);
        if (null !== $oldpassword) {
            $command .= ' '.escapeshellarg($oldpassword);
        }

        $output = '';
        $returnVar = null;
        exec($command, $output, $returnVar);

        return ['output' => $output, 'return_var' => $returnVar];
    }
}
