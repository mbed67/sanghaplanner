<?php namespace Sanghaplanner\Memberships;

use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Memberships\Events\MembershipRequested;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class JoinSanghaCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * @var SanghaRepositoryInterface
	 */
	protected $sanghaRepository;

	/**
	 * @var UserRepositoryInterface
	 */
	protected $userRepository;

	/**
	 * @var RoleRepositoryInterface
	 */
	protected $roleRepository;

	/**
	 * @param sanghaRepositoryInterface $sanghaRepository
	 * @param UserRepositoryInterface $userRepository
	 * @param RoleRepositoryInterface $roleRepository
	 */
	public function __construct(
		SanghaRepositoryInterface $sanghaRepository,
		UserRepositoryInterface $userRepository,
		RoleRepositoryInterface $roleRepository
	) {
		$this->sanghaRepository = $sanghaRepository;
		$this->userRepository = $userRepository;
		$this->roleRepository = $roleRepository;
	}

	/**
	 * Handle the command.
	 *
	 * @todo decouple the handle method from the Notification model
	 *
	 * @param object $command
	 * @return void
	 */
	public function handle($command)
	{
		$sangha = $this->sanghaRepository->findById($command->sanghaIdToJoin);
		$user = $this->userRepository->findById($command->userId);
		$role = $this->roleRepository->getRoleByName('administrator');
		$admins = $this->sanghaRepository->findUsersByRoleForSangha($sangha->id, $role->id);

		foreach ($admins as $admin)
		{
			$this->userRepository->newNotification($admin)
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

		$sangha->raise(new MembershipRequested($sangha, $user));

		$this->dispatchEventsFor($sangha);

	}
}