<?php namespace Sanghaplanner\Sanghas\Events;

use Sanghaplanner\Sanghas\Sangha;

class SanghaCreated {

	/**
	 * @var Sangha $sangha
	 */
	public $sangha;

	/**
	 * @param Sangha $sangha
	 */
	public function __construct(Sangha $sangha)
	{
		$this->sangha = $sangha;
	}
}