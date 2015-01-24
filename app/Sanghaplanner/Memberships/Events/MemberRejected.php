<?php namespace Sanghaplanner\Memberships\Events;

use Sanghaplanner\Users\User;
use Sanghaplanner\Sanghas\Sangha;

class MemberRejected {

	/**
	 * @var User $user
	 */
	public $user;

	/**
	 * @var Sangha $sangha
	 */
	public $sangha;

	/**
	 * @param User $user
	 * @param Sangha $sangha
	 */
	public function __construct($user, $sangha)
	{
		$this->user = $user;
		$this->sangha = $sangha;
	}
}