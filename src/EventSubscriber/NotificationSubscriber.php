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

namespace App\EventSubscriber;

use App\Framework\Translator;
use App\Service\MailNotificationService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class NotificationSubscriber implements EventSubscriberInterface {
    /** @var MailNotificationService */
    private $mailNotificationService;

    /** @var Translator */
    private $translator;

    /** @var string */
    private $signature;

    private $notify_on_password_changed;

    private $notify_on_ssh_key_changed;

    /**
     * NotificationSubscriber constructor.
     * @param $mailNotificationService MailNotificationService
     * @param $translator Translator
     * @param $signature string
     * @param $notify_on_password_changed boolean
     * @param $notify_on_ssh_key_changed boolean
     */
    public function __construct($mailNotificationService, $translator, $signature, $notify_on_password_changed, $notify_on_ssh_key_changed)
    {
        $this->mailNotificationService = $mailNotificationService;
        $this->translator = $translator;
        $this->signature = $signature;
        $this->notify_on_password_changed = $notify_on_password_changed;
        $this->notify_on_ssh_key_changed = $notify_on_ssh_key_changed;
    }

    public static function getSubscribedEvents()
    {
        return [
            'password.changed' => 'onPasswordChanged',
            'sshkey.changed' => 'onSshKeyChanged',
        ];
    }

    public function onPasswordChanged(GenericEvent $event)
    {
        if(!$this->notify_on_password_changed) {
            return;
        }

        $context = $event['context'];

        if ($context['user_mail']) {
            $data = ['login' =>  $event['login'], 'mail' => $context['user_mail'], 'password' => $event['new_password']];
            $subject = $this->translator->trans('changesubject');
            $body = $this->translator->trans('changemessage').$this->signature;
            $this->mailNotificationService->send($context['user_mail'], $subject, $body, $data);
        }
        // TODO log when missing email
    }

    public function onSshKeyChanged(GenericEvent $event)
    {
        if(!$this->notify_on_ssh_key_changed) {
            return;
        }

        $context = $event['context'];

        if ($context['user_mail']) {
            $data = ["login" => $event['login'], "mail" => $context['user_mail'], "sshkey" => $event['ssh_key']];
            $subject = $this->translator->trans("changesshkeysubject");
            $body = $this->translator->trans("changesshkeymessage").$this->signature;
            $this->mailNotificationService->send($context['user_mail'], $subject, $body, $data);
        }
        // TODO log when missing email
    }
}
