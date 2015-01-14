<?php namespace Sanghaplanner\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	/**
	 * Validation rules for the registration form
	 *
	 * @var array
	 */
	protected $rules = [
		'email' => 'required|email|unique:users',
		'password' => 'required|confirmed',
		'firstname' => 'required',
		'lastname' => 'required',
		'address' => 'required',
		'zipcode' => 'required',
		'place' => 'required'
	];
}
