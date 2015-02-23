<?php namespace App\Handlers\Events;

use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use App\Commands\MarkNotificationsReadCommand;
use App\Events\MemberApproved;
use App\Events\MemberAlreadyExists;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesCommands;

class MarkNotificationRead
{

    use DispatchesCommands;

    /**
     * @var NotificationRepositoryInterface $notificationRepository
     */
    private $notificationRepository;

    /**
     * @var Collection $input
     */
    private $input;

    public function __construct(
        NotificationRepositoryInterface $notificationRepository,
        Collection $input
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->input = $input;
    }

    /**
     * @hears("MemberApproved")
     */
    public function whenMemberApproved(MemberApproved $event)
    {
        $this->markRead($event);
    }

    /**
     * @hears("MemberAlreadyExists")
     */
    public function whenMemberAlreadyExists(MemberAlreadyExists $event)
    {
        $this->markRead($event);
    }

    /**
     * @param $event
     * @param Collection $input
     */
    private function markRead($event)
    {
        $this->input['senderId'] = $event->user->id;
        $this->input['sanghaId'] = $event->sangha->id;

        $this->dispatchFrom(MarkNotificationsReadCommand::class, $this->input);
    }
}
