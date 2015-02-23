<?php namespace App\Http\Controllers;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Shows the home page
     */
    public function home()
    {
        return view('pages.home');
    }
}
