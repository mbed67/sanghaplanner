<?php

use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Memberships\JoinSanghaCommand;

class NotificationsController extends \BaseController {

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

		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = $this->userRepository->findUserWithAllNotifications(Auth::user()->id);

		return View::make('notifications.index', ['user' => $user]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array_add(Input::get(), 'userId', Auth::id());

		$this->execute(JoinSanghaCommand::class, $input);

		Flash::success('Je verzoek is verstuurd');

		return Redirect::to('/sanghas');
	}
}
