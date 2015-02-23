<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\CreateSanghaRequest;
use App\Commands\CreateSanghaCommand;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Sanghaplanner\Facades\Search;
use \Laracasts\Flash\Flash;

class SanghasController extends Controller
{

    /**
     * @var SanghaRepositoryInterface
     */
    private $sanghaRepository;

    /**
     * @var NotificationRepositoryInterface
     */
    private $notificationRepository;

    /**
     * @param SanghaRepositoryInterface $sanghaRepository
     * @param NotificationRepositoryInterface $notificationRepository
     */
    public function __construct(
        SanghaRepositoryInterface $sanghaRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->sanghaRepository = $sanghaRepository;
        $this->notificationRepository = $notificationRepository;

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
        $request['userId'] = Auth::id();

        $sangha = $this->dispatchFrom(CreateSanghaCommand::class, $request);

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

        return view('sanghas.show', ['sangha' => $sangha, 'notifications' => $notifications]);
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
