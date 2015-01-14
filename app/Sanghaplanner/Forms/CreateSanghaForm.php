<?php namespace Sanghaplanner\Forms;

use Laracasts\Validation\FormValidator;

class CreateSanghaForm extends FormValidator {

	/**
	 * Validation rules for the create sangha form
	 *
	 * @var array
	 */
	protected $rules = [
		'sanghaname' => 'required|unique:sanghas',
	];
}
