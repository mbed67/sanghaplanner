<?php namespace App\Http\Controllers;

use Sanghaplanner\Roles\RoleRepositoryInterface;
use App\Http\Requests\CreateRoleRequest;
use App\Commands\CreateRoleCommand;
use \Laracasts\Flash\Flash;
use Redirect;

class RolesController extends Controller
{

    /**
     * @var
     */
    protected $roleRepository;

    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;

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

        return view('roles.index')->withRoles($roles);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->dispatchFrom(CreateRoleCommand::class, $request);

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
