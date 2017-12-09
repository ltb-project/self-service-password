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

use Pimple\Container;
use Twig_Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class Controller
 *
 * @package App\Framework
 */
class Controller {
    /** @var Twig_Environment */
    private $twig;

    /** @var array */
    protected $config;

    /**
     * @var Container
     */
    protected $container;

    public function __construct(array $config, Container $container) {
        $this->twig = $container['twig'];
        $this->config = $config;
        $this->container = $container;
    }

    /**
     * Returns a response with a template rendered.
     * @param string $template Name of the template to render.
     * @param array $vars
     * @return Response
     */
    protected function render($template, array $vars = []) {
        //TODO move this to a template specific file for better multi themes support
        $vars1 = [
            'lang' => $this->config['lang'],
            'background_image' => $this->config['background_image'],
            'show_menu' => $this->config['show_menu'],
            'logo' => $this->config['logo'],
            'dependency_check_results' => $this->config['dependency_check_results'],
            'use_questions' => $this->config['use_questions'],
            'use_tokens' => $this->config['use_tokens'],
            'use_sms' => $this->config['use_sms'],
            'change_sshkey' => $this->config['change_sshkey'],
            'action' => $this->config['action'],
            'source' => $this->config['source'],
        ];

        return new Response($this->twig->render($template, $vars1 + $vars));
    }

    /**
     * Create a redirect reponse to a specific URL
     * @param $url string URL where the client should be redirected to
     * @return RedirectResponse
     */
    protected function redirect($url) {
        return new RedirectResponse($url);
    }

    /**
     * Shortcut to get something from the dependency injection container
     * @param $id
     * @return mixed
     */
    protected function get($id) {
        return $this->container[$id];
    }
}
