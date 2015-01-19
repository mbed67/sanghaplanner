<?php namespace Sanghaplanner\Memberships;

class JoinSanghaCommand {

	/**
	 * @var integer
	 */
	public $userId;

	/**
	 * @var string
	 */
	public $sanghaIdToJoin;

	/**
	 * @param string sanghaId
	 * @param integer userId
	 */
	public function __construct($userId, $sanghaIdToJoin)
	{
		$this->userId = $userId;
		$this->sanghaIdToJoin = $sanghaIdToJoin;
	}
}