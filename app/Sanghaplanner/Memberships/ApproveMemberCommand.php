<?php namespace Sanghaplanner\Memberships;

class ApproveMemberCommand {

	/**
	 * @var int
	 */
	public $userId;

	/**
	 * @var int
	 */
	public $sanghaId;

	/**
	 * @param int user_id
	 * @param int sangha_id
	 */
	public function __construct($userId, $sanghaId)
	{
		$this->userId = $userId;
		$this->sanghaId = $sanghaId;
	}
}
