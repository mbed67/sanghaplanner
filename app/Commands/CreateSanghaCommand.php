<?php namespace App\Commands;

use App\Commands\Command;
use App\Events\SanghaCreated;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Sanghas\Sangha;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CreateSanghaCommand extends Command implements SelfHandling
{

    /**
     * @var int $userId
     */
    public $userId;

    /**
     * @var string $sanghaname
     */
    public $sanghaname;

    /**
     * @param int $userId
     * @param string $sanghaname
     */
    public function __construct($userId, $sanghaname)
    {
        $this->userId = $userId;
        $this->sanghaname = $sanghaname;
    }

    /**
     * Execute the command.
     *
     * @param sanghaRepositoryInterface $sanghaRepository
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     * @param Dispatcher $event
     *
     * @return void
     */
    public function handle(
        UserRepositoryInterface $userRepository,
        SanghaRepositoryInterface $sanghaRepository,
        RoleRepositoryInterface $roleRepository,
        Dispatcher $event
    ) {
        $sangha = Sangha::createSangha($this->sanghaname);
        $user = $userRepository->findById($this->userId);
        $role = $roleRepository->getRoleByName('administrator')->id;

        $sanghaRepository->save($sangha);

        $sanghaRepository->createSanghaUser($sangha, $user, $role);

        $event->fire(new SanghaCreated($sangha));

        return $sangha;

    }
}
