<?php

namespace Sanghaplanner\Registration\Events;

use Sanghaplanner\Users\User;

class UserRegistered {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}
}