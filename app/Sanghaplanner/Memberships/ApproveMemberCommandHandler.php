<?php namespace Sanghaplanner\Memberships;

use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Memberships\Events\MemberApproved;
use Sanghaplanner\Memberships\Events\MemberAlreadyExists;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Flash\Flash;

class ApproveMemberCommandHandler implements CommandHandler {

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
		$sangha = $this->sanghaRepository->findById($command->sanghaId);
		$user = $this->userRepository->findById($command->userId);
		$role = $this->roleRepository->getRoleByName('lid');

		if ($this->sanghaRepository->createSanghaUser($sangha, $user, $role->id))
		{
			Flash::success('Deze persoon is nu lid van sangha ' . $sangha->sanghaname);

			$sangha->raise(new MemberApproved($user, $sangha));

		} else
		{
			Flash::error('Deze persoon is reeds lid van sangha ' . $sangha->sanghaname);

			$sangha->raise(new MemberAlreadyExists($user, $sangha));

		}

		$this->dispatchEventsFor($sangha);
	}
}
