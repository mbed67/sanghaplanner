<?php namespace Sanghaplanner\Memberships;

use Laracasts\Commander\CommandHandler;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use \Auth;

class CreateMembershipCommandHandler implements CommandHandler {

	/**
	 * @var SanghaRepositoryInterface
	 */
	protected $sanghaRepository;

	/**
	 * @var RoleRepositoryInterface
	 */
	protected $roleRepository;

	/**
	 * @param SanghaRepositoryInterface $sanghaRepository
	 * @param RoleRepositoryInterface $roleRepository
	 */
	public function __construct(
		SanghaRepositoryInterface $sanghaRepository,
		RoleRepositoryInterface $roleRepository
	) {
		$this->sanghaRepository = $sanghaRepository;
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
		$user = Auth::user();
		$role = $this->roleRepository->getRoleByName('lid')->id;

		$this->sanghaRepository->createSanghaUser($sangha, $user, $role);
	}
}