<?php namespace Sanghaplanner\Sanghas;

class CreateSanghaCommand {

	/**
	 * @var string
	 */
	public $sanghaname;

	/**
	 * @param string sanghaname
	 */
	public function __construct($sanghaname)
	{
		$this->sanghaname = $sanghaname;
	}
}