<?php namespace Sanghaplanner\Notifications;

use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class MarkNotificationsReadCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * @var NotificationRepositoryInterface
	 */
	protected $notificationRepository;

	/**
	 * @param NotificationRepositoryInterface $notificationRepository
	 */
	public function __construct(NotificationRepositoryInterface $notificationRepository)
	{
		$this->notificationRepository = $notificationRepository;
	}

	/**
	 * Handle the command.
	 *
	 * @param object $command
	 * @return void
	 */
	public function handle($command)
	{
		$notifications = $this->notificationRepository
							->findMembershipRequestsForSenderWithObject($command->senderId, $command->sanghaId);

		foreach ($notifications as $notification)
		{
			$this->notificationRepository->markNotificationRead($notification->id);
		}
	}
}
