<?php namespace App\Commands;

use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use App\Events\MemberRejected;
use App\Commands\MarkNotificationsReadCommand;
use Laracasts\Flash\Flash;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Contracts\Events\Dispatcher;

class RejectMemberCommand extends Command implements SelfHandling
{

    use DispatchesCommands;

    /**
     * @var int $userId
     */
    protected $userId;

    /**
     * @var int $sanghaId
     */
    protected $sanghaId;

    /**
     * @param int $userId
     * @param int $sanghaId
     */
    public function __construct($userId, $sanghaId)
    {
        $this->userId = $userId;
        $this->sanghaId = $sanghaId;
    }

    /**
     * Execute the command.
     *
     * @param sanghaRepositoryInterface $sanghaRepository
     * @param UserRepositoryInterface $userRepository
     * @param Dispatcher $event
     * @param Collection $input
     * @return void
     */
    public function handle(
        SanghaRepositoryInterface $sanghaRepository,
        UserRepositoryInterface $userRepository,
        Dispatcher $event,
        Collection $input
    ) {
        $sangha = $sanghaRepository->findById($this->sanghaId);
        $user = $userRepository->findById($this->userId);

        $input['senderId'] = $user->id;
        $input['sanghaId'] = $sangha->id;
        $this->dispatchFrom(MarkNotificationsReadCommand::class, $input);

        Flash::success('Deze persoon is geweigerd als lid van sangha ' . $sangha->sanghaname);

        $event->fire(new MemberRejected($user, $sangha));

    }
}
