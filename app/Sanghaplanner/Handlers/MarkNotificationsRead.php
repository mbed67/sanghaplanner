<?php namespace Sanghaplanner\Handlers;

use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Sanghaplanner\Memberships\Events\MemberApproved;
use Sanghaplanner\Memberships\Events\MemberAlreadyExists;
use Sanghaplanner\Notifications\MarkNotificationsReadCommand;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\Events\EventListener;

class MarkNotificationsRead extends EventListener {

	use CommanderTrait;

	/**
	 * @var NotificationRepositoryInterface $notificationRepository
	 */
	private $notificationRepository;

	public function __construct(NotificationRepositoryInterface $notificationRepository)
	{
		$this->notificationRepository = $notificationRepository;
	}

	/**
	 * @param MemberApproved
	 */
	public function whenMemberApproved(MemberApproved $event)
	{
		$this->markRead($event);
	}

	/**
	 * @param MemberAlreadyExists
	 */
	public function whenMemberAlreadyExists(MemberAlreadyExists $event)
	{
		$this->markRead($event);
	}

	/**
	 * @param $event
	 */
	private function markRead($event)
	{
		$input = ['senderId' => $event->user->id, 'sanghaId' => $event->sangha->id];
		$this->execute(MarkNotificationsReadCommand::class, $input);
	}
}
