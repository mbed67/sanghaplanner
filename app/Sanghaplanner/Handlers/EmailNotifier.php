<?php namespace Sanghaplanner\Handlers;

use Sanghaplanner\Registration\Events\UserRegistered;
use Sanghaplanner\Memberships\Events\MemberApproved;
use Sanghaplanner\Memberships\Events\MemberRejected;
use Sanghaplanner\Memberships\Events\MembershipRequested;
use Sanghaplanner\Mailers\UserMailer;
use Laracasts\Commander\Events\EventListener;

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
		$this->mailer->sendWelcomeToSanghaplannerMessageTo($event->user);
	}


	/**
	 * @param MemberApproved
	 */
	public function whenMemberApproved(MemberApproved $event)
	{
		$this->mailer->sendWelcomeToSanghaMessageTo($event->user, $event->sangha);
	}

	/**
	 * @param MemberRejected
	 */
	public function whenMemberRejected(MemberRejected $event)
	{
		$this->mailer->sendSorryMessageTo($event->user, $event->sangha);
	}

	/**
	 * @param MembershipRequested
	 */
	public function whenMembershipRequested(MembershipRequested $event)
	{
		$this->mailer->sendMembershipRequestPendingMessageTo($event->user, $event->sangha);
	}
}
