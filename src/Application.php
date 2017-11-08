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

namespace App;

use App\Framework\Request;
use App\Framework\Response;
use App\Utils\LanguageSelector;

class Application {
    private $config;
    private $container;

    public function __construct($configPath, $containerPath = null, $containerOverridePath = null)
    {
        $this->config = $this->loadConfig($configPath);

        error_reporting($this->config['debug'] ? E_ALL : 0);

        $this->config['messages'] = $this->loadLanguages($this->config['lang'], $this->config['allowed_lang'], $this->config['messages'] );

        $this->container = $this->loadContainer($containerPath, $containerOverridePath);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request) {
        $action = $request->query->get("action", $this->config['default_action']);

        # Ensure requested action is available, or fall back to default
        if ( ! $this->isActionAllowed($action) ) {
            $action = $this->config['default_action'];
        }

        # Get source for menu
        $source = $request->get("source", false);

        // TODO fix, not idempotent
        $this->config['source'] = $source;
        $this->config['action'] = $action;
        $this->container['config'] = $this->config;

        $controller = $this->container[$action . '.controller'];

        return $controller->indexAction($request);
    }

    private function isActionAllowed($action) {
        # Available actions
        $available_actions = array();
        if ( $this->config['use_change'] ) { array_push( $available_actions, "change"); }
        if ( $this->config['change_sshkey'] ) { array_push( $available_actions, "changesshkey"); }
        if ( $this->config['use_questions'] ) { array_push( $available_actions, "resetbyquestions", "setquestions"); }
        if ( $this->config['use_tokens'] ) { array_push( $available_actions, "resetbytoken", "sendtoken"); }
        if ( $this->config['use_sms'] ) { array_push( $available_actions, "resetbytoken", "sendsms"); }

        return in_array($action, $available_actions);
    }

    public function loadConfig($configPath) {
        require $configPath;
        require __DIR__ . '/config_compat.php';
        return get_defined_vars();
    }

    public function loadLanguages($lang, $allowed_lang, &$old_messages) {
        $languageSelector = new LanguageSelector();

        // will be modified by lang files
        $messages = array();

        # Available languages
        $languages = $languageSelector->findAvailableLanguages(__DIR__ . '/../lang', $lang, $allowed_lang);
        $lang = $languageSelector->detectLanguage($lang, $languages);
        require __DIR__ . "/../lang/$lang.inc.php";
        if (file_exists(__DIR__ . "/../conf/$lang.inc.php")) {
            require __DIR__ . "/../conf/$lang.inc.php";
        }

        return array_merge($old_messages, $messages);
    }

    public function loadContainer($containerPath, $containerOverridePath) {
        $container = require $containerPath ? $containerPath : __DIR__ . '/container.php';

        # Override container for fun and profit
        if($containerOverridePath) {
            include $containerOverridePath;
        }

        return $container;
    }

    public function getContainer()
    {
        return $this->container;
    }
}