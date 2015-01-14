<?php

use Sanghaplanner\Forms\RegistrationForm;
use Sanghaplanner\Registration\RegisterUserCommand;

class RegistrationController extends \BaseController {

	/**
	 * @var RegistrationForm
	 */
	private $registrationForm;

	/**
	 * Constructor
	 *
	 * @param RegistrationForm $registrationForm
	 */
	public function __construct(RegistrationForm $registrationForm)
	{
		$this->registrationForm = $registrationForm;

		$this->beforeFilter('guest');
	}

	/**
	 * Show a form to register a user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('registration.create');
	}

	/**
	 * Create a new Sanghaplanner user.
	 *
	 * @return string
	 */
	public function store()
	{
	    $this->registrationForm->validate(Input::all());

	    $user = $this->execute(RegisterUserCommand::class);

	    Auth::login($user);

	    Flash::overlay('Dank je voor het registreren bij Sanghaplanner!');

	    return Redirect::home();
	}
}