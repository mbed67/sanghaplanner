<?php namespace Sanghaplanner\Registration;

use Laracasts\Commander\CommandHandler;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Users\User;
use Laracasts\Commander\Events\DispatchableTrait;

class RegisterUserCommandHandler implements CommandHandler {

	use DispatchableTrait;
	/**
	 * @var UserRepositoryInterface
	 */
	protected $repository;

	/**
	 * @param UserRepositoryInterface $repository
	 */
	public function __construct(UserRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return Sanghaplanner\Users\User
	 */
	public function handle($command)
	{
		$user = User::register(
			$command->email,
			$command->password,
			$command->firstname,
			$command->middlename,
			$command->lastname,
			$command->address,
			$command->zipcode,
			$command->place,
			$command->phone,
			$command->gsm
		);

		$this->repository->save($user);

		$this->dispatchEventsFor($user);

		return $user;
	}
}
