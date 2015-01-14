<?php namespace Sanghaplanner\Roles;

use Laracasts\Commander\CommandHandler;

class CreateRoleCommandHandler implements CommandHandler {

	/**
	 * @var RoleRepositoryInterface
	 */
	protected $repository;

	/**
	 * @param RoleRepositoryInterface $repository
	 */
	public function __construct(RoleRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}
	/**
	 * Handle the command.
	 *
	 * @param object $command
	 * @return void
	 */
	public function handle($command)
	{
		$role = Role::createRole($command->rolename);

		$this->repository->save($role);

		return $role;
	}
}