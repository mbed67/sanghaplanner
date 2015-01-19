<?php namespace Sanghaplanner\Sanghas;

class CreateSanghaCommand {

	/**
	 * @var integer
	 */
	public $userId;

	/**
	 * @var string
	 */
	public $sanghaname;

	/**
	 * @param string sanghaname
	 */
	public function __construct($userId, $sanghaname)
	{
		$this->userId = $userId;
		$this->sanghaname = $sanghaname;
	}
}