<?php namespace smsapi;
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2024 LTB-project.org
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

/*
 * Add to your config.inc.local.php
 *
 * $signal_user= '+18881234567';
 * $signal_config = '<path to config folder>';
 * $signal_cli = '<path to signal-cli>';
 */

class smsSignal
{

    public $signal_user;
    public $signal_config;
    public $signal_cli;

    public function __construct($signal_user, $signal_config, $signal_cli)
    {
         $this->signal_user = $signal_user;
         $this->signal_config = $signal_config;
         $this->signal_cli = $signal_cli;
    }

    /* @function boolean send_sms_by_api(string $mobile, string $message)
     * Send SMS trough an API
     * @param mobile mobile number
     * @param message text to send
     * @return 1 if message sent, 0 if not
     */
    function send_sms_by_api($mobile, $message) {
        if (!$this->signal_user || !$this->signal_config || !$this->signal_cli) {
          error_log('Trying to access signal without credentials. Set signal_user, signal_config and signal_cli in your config.inc.local.php');
          return 0;
        }

        $command = escapeshellcmd($this->signal_cli).' -u '.escapeshellarg($this->signal_user).' --config '.escapeshellarg($this->signal_config).' send -m '.escapeshellarg($message).' '.escapeshellarg($mobile);

        $v = '';
        $o = '';
        exec($command." 2>&1", $o, $v);

        if ($v !== 0) {
          error_log('Error sending message: ');
          $o_size = count($o);
          for ($x = 0; $x < $o_size; $x++) {
            error_log(' ' . $o[$x]);
          }

          return 0;

        }
        return 1;
    }

}
