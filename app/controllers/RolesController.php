<?php

use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Forms\CreateRoleForm;
use Sanghaplanner\Roles\CreateRoleCommand;

class RolesController extends \BaseController {

	/**
	 * @var CreateRoleForm
	 */
	private $createRoleForm;

	/**
	 * @var
	 */
	protected $roleRepository;

	/**
	 * @param RoleRepository $roleRepository
	 */
	public function __construct(
		RoleRepositoryInterface $roleRepository,
		CreateRoleForm $createRoleForm
	) {
		$this->roleRepository = $roleRepository;
		$this->createRoleForm = $createRoleForm;

		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = $this->roleRepository->getAll();

		return View::make('roles.index')->withRoles($roles);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roles.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $this->createRoleForm->validate(Input::all());

	    $role = $this->execute(CreateRoleCommand::class);

	    Flash::success('De nieuwe rol is aangemaakt.');

	    return Redirect::to('/roles');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
