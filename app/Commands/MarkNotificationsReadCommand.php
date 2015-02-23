<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class MarkNotificationsReadCommand extends Command implements SelfHandling
{

    /**
     * @var int $senderId
     */
    protected $senderId;

    /**
     * @var int $sanghaId
     */
    protected $sanghaId;

    /**
     * @param int $senderId
     * @param int $sanghaId
     */
    public function __construct($senderId, $sanghaId)
    {
        $this->senderId = $senderId;
        $this->sanghaId = $sanghaId;
    }

    /**
     * Execute the command.
     *
     * @param NotificationRepositoryInterface $notificationRepository
     *
     * @return void
     */
    public function handle(NotificationRepositoryInterface $notificationRepository)
    {
            $notifications = $notificationRepository
                            ->findMembershipRequestsForSenderWithObject($this->senderId, $this->sanghaId);

        foreach ($notifications as $notification) {
            $notificationRepository->markNotificationRead($notification->id);
        }
    }
}
