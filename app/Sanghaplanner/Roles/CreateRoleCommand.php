<?php namespace Sanghaplanner\Roles;

class CreateRoleCommand {

	/**
	 * @var string
	 */
	public $rolename;

	/**
	 * @param string rolename
	 */
	public function __construct($rolename)
	{
		$this->rolename = $rolename;
	}
}