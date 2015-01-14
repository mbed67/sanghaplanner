<?php

class PagesController extends \BaseController {

	/**
	 * Shows the home page
	 */
	public function home()
	{
		return View::make('pages.home');
	}
}
