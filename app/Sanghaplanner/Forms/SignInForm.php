<?php namespace Sanghaplanner\Forms;

use Laracasts\Validation\FormValidator;

class SignInForm extends FormValidator {

	/**
	 * Validation rules for the sign in form
	 *
	 * @var array
	 */
	protected $rules = [
		'email' => 'required',
		'password' => 'required'
	];
}
