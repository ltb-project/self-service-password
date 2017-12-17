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

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class LocaleSubscriber
 */
class LocaleSubscriber implements EventSubscriberInterface
{
    private $defaultLocale;

    /** @var TranslatorInterface */
    private $translator;
    private $supportedLocales;

    /**
     * LocaleSubscriber constructor.
     *
     * @param $defaultLocale
     * @param TranslatorInterface $translator
     * @param string $supportedLocales
     */
    public function __construct($defaultLocale, TranslatorInterface $translator, $supportedLocales)
    {
        $this->defaultLocale = $defaultLocale;
        $this->translator = $translator;
        $this->supportedLocales = $supportedLocales;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 16]],
        ];
    }

    /**
     * @param GetResponseEvent  $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $request->setDefaultLocale($this->defaultLocale);

        $preferredLanguage = $request->getPreferredLanguage(explode(',', $this->supportedLocales));

        $request->setLocale($preferredLanguage);
        $this->translator->setLocale($preferredLanguage);
    }
}
