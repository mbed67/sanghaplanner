<?php namespace Sanghaplanner\Forms;

use Laracasts\Validation\FormValidator;

class CreateRoleForm extends FormValidator {

	/**
	 * Validation rules for the create role form
	 *
	 * @var array
	 */
	protected $rules = [
		'rolename' => 'required|unique:roles',
	];
}
