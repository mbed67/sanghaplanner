<?php namespace Sanghaplanner\Sanghas;

use Sanghaplanner\Roles\RoleRepositoryInterface;
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
	 * @return Sanghaplanner\Sanghas\Sangha
	 */
	public function handle($command)
	{
		$sangha = Sangha::createSangha($command->sanghaname);
		$user = Auth::user();
		$role = $this->roleRepository->getRoleByName('administrator')->id;

		$this->sanghaRepository->save($sangha);

		$this->sanghaRepository->createSanghaUser($sangha, $user, $role);

		$this->dispatchEventsFor($sangha);

		return $sangha;

	}
}