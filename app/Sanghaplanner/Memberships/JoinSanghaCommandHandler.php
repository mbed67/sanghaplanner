<?php namespace Sanghaplanner\Memberships;

use Laracasts\Commander\CommandHandler;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Laracasts\Commander\Events\DispatchableTrait;
use Sanghaplanner\Memberships\Events\MembershipRequested;

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
	 * @param object $command
	 * @return void
	 */
	public function handle($command)
	{
		$sangha = $this->sanghaRepository->findById($command->sanghaIdToJoin);
		$user = $this->userRepository->findById($command->userId);
		$role = $this->roleRepository->getRoleByName('administrator');
		$admins = $this->sanghaRepository->findUsersByRoleForSangha($sangha->id, $role->id)->get();

		foreach ($admins as $admin)
		{
			$this->userRepository->newNotification($admin)
				->withSubject('Iemand wil lid worden van de sangha')
				->withBody($user->firstname . ' wil lid worden van sangha ' . $sangha->sanghaname)
				->save();
		}

		$sangha->raise(new MembershipRequested($sangha, $user));

		$this->dispatchEventsFor($sangha);

	}
}