<?php namespace App\Http\Controllers;

use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Users\User;
use App\Http\Requests\EditUserRequest;
use App\Commands\EditUserCommand;
use Sanghaplanner\Facades\Search;
use Request;
use \Laracasts\Flash\Flash;

class UsersController extends Controller
{

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
        if ($search = Request::get('q')) {
            $repo = $this->userRepository;
            $users = Search::users($search, $repo);
        } else {
            $users = $this->userRepository->getAll();
        }

        return view('users.index')->withUsers($users);
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

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findById($id);

        return view('users.edit', ['user' => $user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(EditUserRequest $request, $id)
    {

        $this->dispatchFrom(EditUserCommand::class, $request);

        Flash::success('De gegevens zijn gewijzigd');

        return redirect('/users/' . $id);
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
