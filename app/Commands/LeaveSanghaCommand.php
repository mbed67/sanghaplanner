<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use App\Events\LeftASangha;
use Laracasts\Flash\Flash;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class LeaveSanghaCommand extends Command implements SelfHandling
{

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $sanghaIdToUnjoin;

    /**
     * @param int $userId
     * @param int $sanghaIdToUnjoin
     */
    public function __construct($userId, $sanghaIdToUnjoin)
    {
        $this->userId = $userId;
        $this->sanghaId = $sanghaIdToUnjoin;
    }

    /**
     * Execute the command.
     *
     * @param sanghaRepositoryInterface $sanghaRepository
     * @param UserRepositoryInterface $userRepository
     * @param Dispatcher $event
     * @return void
     */
    public function handle(
        SanghaRepositoryInterface $sanghaRepository,
        UserRepositoryInterface $userRepository,
        Dispatcher $event
    ) {
        $sangha = $sanghaRepository->findById($this->sanghaId);
        $user = $userRepository->findById($this->userId);

        if ($sanghaRepository->deleteSanghaUser($sangha, $user)) {
            $event->fire(new LeftASangha($user, $sangha));

        }
    }
}
