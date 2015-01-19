<?php

namespace Sanghaplanner\Handlers;

use Laracasts\Commander\Events\EventListener;
use Sanghaplanner\Registration\Events\UserRegistered;
use Sanghaplanner\Mailers\UserMailer;

class EmailNotifier extends EventListener {

    /**
     * @var Usermailer
     */
    private $mailer;

    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param UserRegistered
     */
    public function whenUserRegistered(UserRegistered $event)
    {
        $this->mailer->sendWelcomeMessageTo($event->user);
    }
}