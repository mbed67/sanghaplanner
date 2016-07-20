<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\CreateSanghaRequest;
use App\Http\Requests\EditSanghaRequest;
use App\Commands\CreateSanghaCommand;
use App\Commands\EditSanghaCommand;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Sanghaplanner\Retreats\RetreatRepositoryInterface;
use Sanghaplanner\Facades\Search;
use \Laracasts\Flash\Flash;

class SanghasController extends Controller
{

    /**
     * @var SanghaRepositoryInterface
     */
    private $sanghaRepository;

    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    /**
     * @var NotificationRepositoryInterface
     */
    private $notificationRepository;

    /**
     * @var RetreatRepositoryInterface
     */
    private $retreatRepository;

    /**
     * @param SanghaRepositoryInterface $sanghaRepository
     * @param RoleRepositoryInterface $roleRepository
     * @param NotificationRepositoryInterface $notificationRepository
     * @param RetreatRepositoryInterface $retreatRepository
     */
    public function __construct(
        SanghaRepositoryInterface $sanghaRepository,
        RoleRepositoryInterface $roleRepository,
        NotificationRepositoryInterface $notificationRepository,
        RetreatRepositoryInterface $retreatRepository
    ) {
        $this->sanghaRepository = $sanghaRepository;
        $this->roleRepository = $roleRepository;
        $this->notificationRepository = $notificationRepository;
        $this->retreatRepository = $retreatRepository;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if ($search = \Request::get('q')) {
            $repo = $this->sanghaRepository;
            $sanghas = Search::sanghas($search, $repo);
        } else {
            $sanghas = $this->sanghaRepository->getAll();
        }

        return view('sanghas.index')->withSanghas($sanghas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('sanghas.create');
    }


    /**
     * Create a new Sangha.
     *
     * @return string
     */
    public function store(CreateSanghaRequest $request)
    {
        if ($request->file('image')) {
            $filePath = $request->file('image')->getRealPath();
            $fileName = $request->file('image')->getClientOriginalName();
        }

        $sangha = $this->dispatchFrom(CreateSanghaCommand::class, $request, [
            'userId' => Auth::id(),
            'filePath' => (isset($filePath) ? $filePath : null),
            'fileName' => (isset($fileName) ? $fileName : null)
        ]);

        Flash::success('De nieuwe sangha is aangemaakt.');

        return redirect('/sanghas');
    }

    /**
     * Display the specified sangha.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $sangha = $this->sanghaRepository->findSanghaWithUsers($id);
        $notifications = $this->notificationRepository->showMembershipRequestsForSangha($sangha, Auth::id());
        $admins = $this->getAdmins($id);
        $retreats = $this->getRetreats($id);

        $members = $sangha->users()->get()->map(function($user) {
            return [
                'firstname' => $user->firstname,
                'middlename' => $user->middlename,
                'lastname' => $user->lastname,
                'address' => $user->address,
                'zipcode' => $user->zipcode,
                'place' => $user->place,
                'phone' => $user->phone,
                'gsm' => $user->gsm,
                'email' => $user->email,
                'rolename' => $user->pivot->role->rolename
            ];
        });

        return view('sanghas.show', [
            'isAdminOfThisSangha' => Auth::user()->roleForSangha($sangha->id) == 'administrator' ? "true" : "false",
            'isMemberOfThisSangha' => Auth::user()->sanghas->find($sangha->id) ? "true" : "false",
            'sangha' => $sangha,
            'notifications' => $notifications,
            'admins' => $admins,
            'members' => $members,
            'retreats' => $retreats
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $sangha = $this->sanghaRepository->findById($id);

        return view('sanghas.edit', ['sangha' => $sangha]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(EditSanghaRequest $request, $id)
    {
        if ($request->file('image')) {
            $filePath = $request->file('image')->getRealPath();
            $fileName = $request->file('image')->getClientOriginalName();
        }

        $this->dispatchFrom(EditSanghaCommand::class, $request, [
            'filePath' => (isset($filePath) ? $filePath : null),
            'fileName' => (isset($fileName) ? $fileName : null)
        ]);

        Flash::success('De gegevens zijn gewijzigd');

        return redirect('/sanghas/' . $id);
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

    /**
     * Returns the administrators for the sangha
     *
     * @param $sanghaId
     * @return array
     */
    private function getAdmins($sanghaId)
    {
        $adminRole = $this->roleRepository->getRoleByName('administrator');
        return $this->sanghaRepository->findUsersByRoleForSangha($sanghaId, $adminRole->id);
    }

    /**
     * Returns the retreats for the sangha
     *
     * @param $sanghaId
     * @return array
     */
    private function getRetreats($sanghaId)
    {
        $sanghaUserIds = $this->sanghaRepository->findSanghaUserIdsForSangha($sanghaId);
        return $this->retreatRepository->getRetreatsForSangha($sanghaUserIds);

    }
}
