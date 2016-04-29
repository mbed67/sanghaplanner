<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use App\Commands\JoinSanghaCommand;
use App\Http\Requests\JoinSanghaRequest;
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
     * @var SanghaRepositoryInterface
     */
    private $sanghaRepository;

    /**
     * @param NotificationRepositoryInterface $notificationRepository
     * @param UserRepository|UserRepositoryInterface $userRepository
     * @param SanghaRepositoryInterface $sanghaRepository
     */
    public function __construct(
        NotificationRepositoryInterface $notificationRepository,
        UserRepositoryInterface $userRepository,
        SanghaRepositoryInterface $sanghaRepository
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
        $this->sanghaRepository = $sanghaRepository;
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
     * Display the notifications for a specified sangha.
     *
     * @param  int $sanghaId
     * @return Response
     */
    public function fetchNotificationsForSangha($sanghaId)
    {
        $sangha = $this->sanghaRepository->findById($sanghaId);
        $notifications = $this->notificationRepository->showMembershipRequestsForSangha($sangha, auth::user()->id);

        return response()->json($notifications);
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
