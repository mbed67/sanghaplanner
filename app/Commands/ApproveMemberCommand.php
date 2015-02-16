<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use App\Events\MemberApproved;
use App\Events\MemberAlreadyExists;
use Laracasts\Flash\Flash;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ApproveMemberCommand extends Command implements SelfHandling
{

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $sanghaId;

    /**
     * @param int $user_id
     * @param int $sangha_id
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
     * @param RoleRepositoryInterface $roleRepository
     * @param Dispatcher $event
     * @return void
     */
    public function handle(
        SanghaRepositoryInterface $sanghaRepository,
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository,
        Dispatcher $event
    ) {
        $sangha = $sanghaRepository->findById($this->sanghaId);
        $user = $userRepository->findById($this->userId);
        $role = $roleRepository->getRoleByName('lid');

        if ($sanghaRepository->createSanghaUser($sangha, $user, $role->id)) {
            Flash::success('Deze persoon is nu lid van sangha ' . $sangha->sanghaname);

            $event->fire(new MemberApproved($user, $sangha));

        } else {
            Flash::error('Deze persoon is reeds lid van sangha ' . $sangha->sanghaname);

            $event->fire(new MemberAlreadyExists($user, $sangha));

        }
    }
}
