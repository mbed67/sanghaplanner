<?php namespace Sanghaplanner\Users;

use Sanghaplanner\Repositories\DbRepository;

class DbUserRepository extends DbRepository implements UserRepositoryInterface {
	/**
	 *
	 * @var Sanghaplanner\Users\User
	 */
	protected $model;

	/**
	 * @param User $model
	 */
	public function __construct(User $user)
	{
		$this->model = $user;
	}

	/**
	 * Persist a user
	 *
	 * @param User $user
	 * @return mixed
	 */
	public function save(User $user)
	{
		return $user->save();
	}

	/**
	 * Find a user based on input from a search box
	 *
	 * @param $search
	 */
	public function searchUser($search)
	{
		return User::search($search)->get();
	}

	/**
	 * Find a user with all of its sanghas
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findUserWithSanghas($id)
	{
		return User::with('sanghas')->find($id);
	}
}