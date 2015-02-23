<?php namespace App\Http\Controllers;

use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use App\Commands\JoinSanghaCommand;
use App\Http\Requests\JoinSanghaRequest;
use Auth;
use \Laracasts\Flash\Flash;

class NotificationsController extends Controller
{

    /**
     * @var NotificationRepositoryInterface
     */
    private $notificationRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        NotificationRepositoryInterface $notificationRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = $this->userRepository->findUserWithAllNotifications(Auth::user()->id);

        return view('notifications.index', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(JoinSanghaRequest $request)
    {
        $request['userId'] = Auth::id();

        $this->dispatchFrom(JoinSanghaCommand::class, $request);

        Flash::success('Je verzoek is verstuurd');

        return redirect('/sanghas');
    }
}
