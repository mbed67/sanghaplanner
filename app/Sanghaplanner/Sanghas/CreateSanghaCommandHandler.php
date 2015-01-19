<?php namespace Sanghaplanner\Sanghas;

use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use \Auth;

class CreateSanghaCommandHandler implements CommandHandler {

	use DispatchableTrait;

	/**
	 * @var RoleRepositoryInterface
	 */
	protected $roleRepository;

	/**
	 * @var SanghaRepositoryInterface
	 */
	protected $sanghaRepository;

	/**
	 * @var UserRepositoryInterface
	 */
	protected $userRepository;

	/**
	 * @param SanghaRepositoryInterface $sanghaRepository
	 * @param RoleRepositoryInterface $roleRepository
	 * @param UserRepositoryInterface $userRepository
	 */
	public function __construct(
		SanghaRepositoryInterface $sanghaRepository,
		RoleRepositoryInterface $roleRepository,
		UserRepositoryInterface $userRepository
	) {
		$this->sanghaRepository = $sanghaRepository;
		$this->roleRepository = $roleRepository;
		$this->userRepository = $userRepository;
	}
	/**
	 * Handle the command.
	 *
	 * @param object $command
	 * @return Sanghaplanner\Sanghas\Sangha
	 */
	public function handle($command)
	{
		$sangha = Sangha::createSangha($command->sanghaname);
		$user = $this->userRepository->findById($command->userId);
		$role = $this->roleRepository->getRoleByName('administrator')->id;

		$this->sanghaRepository->save($sangha);

		$this->sanghaRepository->createSanghaUser($sangha, $user, $role);

		$this->dispatchEventsFor($sangha);

		return $sangha;

	}
}