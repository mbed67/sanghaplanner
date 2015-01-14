<?php namespace Sanghaplanner\Memberships;

class CreateMembershipCommand {

	/**
	 * @var string
	 */
	public $sanghaId;

	/**
	 * @param string sanghaId
	 */
	public function __construct($sanghaId)
	{
		$this->sanghaId = $sanghaId;
	}
}