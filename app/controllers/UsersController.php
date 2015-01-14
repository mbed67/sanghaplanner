<?php
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Users\User;

class UsersController extends \BaseController {

	/**
	 * @var
	 */
	protected $userRepository;

	/**
	 * @param UserRepository $userRepository
	 */
	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;

		parent::__construct();
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    if ($search = Request::get('q'))
	    {
	        $repo = $this->userRepository;
	        $users = Search::users($search, $repo);
	    }
	    else {
	        $users = $this->userRepository->getAll();
	    }

		return View::make('users.index')->withUsers($users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		    $user = $this->userRepository->findUserWithSanghas($id);

		   // dd($user);

		   // dd($user->sanghas->first()->pivot->role->rolename);

		return View::make('users.show', ['user' => $user]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
