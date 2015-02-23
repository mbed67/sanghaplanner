<?php namespace App\Handlers\Events;

use App\Events\UserRegistered;
use App\Events\MemberApproved;
use App\Events\MemberRejected;
use App\Events\MembershipRequested;
use Sanghaplanner\Mailers\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailNotifier
{

    /**
     * @var Usermailer
     */
    private $mailer;

    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @hears("UserRegistered")
     */
    public function whenUserRegistered(UserRegistered $event)
    {
        $this->mailer->sendWelcomeToSanghaplannerMessageTo($event->user);
    }

    /**
     * @hears("MemberApproved")
     */
    public function whenMemberApproved(MemberApproved $event)
    {
        $this->mailer->sendWelcomeToSanghaMessageTo($event->user, $event->sangha);
    }

    /**
     * @hears("MemberRejected")
     */
    public function whenMemberRejected(MemberRejected $event)
    {
        $this->mailer->sendSorryMessageTo($event->user, $event->sangha);
    }

    /**
     * @hears("MembershipRequested")
     */
    public function whenMembershipRequested(MembershipRequested $event)
    {
        $this->mailer->sendMembershipRequestPendingMessageTo($event->user, $event->sangha);
    }
}
