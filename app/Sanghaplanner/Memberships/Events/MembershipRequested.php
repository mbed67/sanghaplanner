<?php namespace Sanghaplanner\Memberships\Events;

use Sanghaplanner\Sanghas\Sangha;
use Sanghaplanner\Users\User;

class MembershipRequested {

	/**
	 * @var Sangha $sangha
	 */
	public $sangha;

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @param Sangha $sangha
	 * @param User $user
	 */
	public function __construct(Sangha $sangha, User $user)
	{
		$this->sangha = $sangha;
		$this->user = $user;
	}
}