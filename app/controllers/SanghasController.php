<?php

use Sanghaplanner\Forms\CreateSanghaForm;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Notifications\NotificationRepositoryInterface;
use Sanghaplanner\Sanghas\CreateSanghaCommand;

class SanghasController extends \BaseController {

	/**
	 * @var CreateSanghaForm
	 */
	private $createSanghaForm;

	/**
	 * @var SanghaRepositoryInterface
	 */
	private $sanghaRepository;

	/**
	 * @var NotificationRepositoryInterface
	 */
	private $notificationRepository;

	/**
	 * @param CreateSanghaForm $createSanghaForm
	 * @param SanghaRepositoryInterface $sanghaRepository
	 * @param NotificationRepositoryInterface $notificationRepository
	 */
	public function __construct(
		CreateSanghaForm $createSanghaForm,
		SanghaRepositoryInterface $sanghaRepository,
		NotificationRepositoryInterface $notificationRepository
	) {
		$this->createSanghaForm = $createSanghaForm;
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
	    if ($search = Request::get('q'))
	    {
	        $repo = $this->sanghaRepository;
	        $sanghas = Search::sanghas($search, $repo);
	    }
	    else {
	        $sanghas = $this->sanghaRepository->getAll();
	    }

		return View::make('sanghas.index')->withSanghas($sanghas);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sanghas.create');
	}


	/**
	 * Create a new Sangha.
	 *
	 * @return string
	 */
	public function store()
	{
	    $this->createSanghaForm->validate(Input::all());

	    $input = array_add(Input::get(), 'userId', Auth::id());

	    $sangha = $this->execute(CreateSanghaCommand::class, $input);

	    Flash::success('De nieuwe sangha is aangemaakt.');

	    return Redirect::to('/sanghas');
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

		return View::make('sanghas.show', ['sangha' => $sangha, 'notifications' => $notifications]);
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
