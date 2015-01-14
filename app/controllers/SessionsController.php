<?php

use Sanghaplanner\Forms\SignInForm;

class SessionsController extends \BaseController {

	/**
	 * @var SignInForm
	 */
	private $signInForm;

	/**
	 * Constructor
	 *
	 */
	public function __construct(SignInForm $signInForm)
	{
		$this->signInForm = $signInForm;

		$this->beforeFilter('guest', ['except' => 'destroy']);
	}

	/**
	 * Show the form for signing in.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

	/**
	 * Sign in.
	 *
	 * @return string
	 */
	public function store()
	{
	    $formData = Input::only('email', 'password');

	    $this->signInForm->validate($formData);

	    if (! Auth::attempt($formData))
	    {
	        Flash::message('Het inloggen is niet gelukt. Check je inloggegevens en probeer opnieuw.');

	        return Redirect::back()->withInput();
	    }

		Flash::message('Welkom terug!');

		return Redirect::intended('/');
	}



	/**
	 * Log a user out of Sanghaplanner
	 *
	 * @return mixed
	 */
	public function destroy()
	{
		Auth::logout();

		Flash::message('Je bent nu uitgelogd.');

		return Redirect::home();
	}
}
