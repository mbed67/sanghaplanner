<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use App\Events\MembershipRequested;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class JoinSanghaCommand extends Command implements SelfHandling
{

    /**
     * @var int $userId
     */
    protected $userId;

    /**
     * @var int $sanghaIdToJoin
     */
    protected $sanghaIdToJoin;

    /**
     * @param integer userId
     * @param integer sanghaIdToJoin
     */
    public function __construct($userId, $sanghaIdToJoin)
    {
        $this->userId = $userId;
        $this->sanghaIdToJoin = $sanghaIdToJoin;
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
        SanghaRepositoryInterface $sanghaRepository,
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository,
        Dispatcher $event
    ) {
        $sangha = $sanghaRepository->findById($this->sanghaIdToJoin);
        $user = $userRepository->findById($this->userId);
        $role = $roleRepository->getRoleByName('administrator');
        $admins = $sanghaRepository->findUsersByRoleForSangha($sangha->id, $role->id);

        foreach ($admins as $admin) {
            $userRepository->newNotification($admin)
                ->from($user)
                ->withType('MembershipRequest')
                ->withSubject('Iemand wil lid worden van de sangha')
                ->withBody(
                    $user->firstname
                    . ' '
                    . $user->middlename
                    . ' '
                    . $user->lastname
                    . ' wil lid worden van sangha '
                    . $sangha->sanghaname
                )
                ->regarding($sangha)
                ->deliver();
        }

        $event->fire(new MembershipRequested($sangha, $user));
    }
}
