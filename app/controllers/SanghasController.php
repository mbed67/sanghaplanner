<?php

use Sanghaplanner\Forms\CreateSanghaForm;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
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
	 * @param SanghaRepository $sanghaRepository
	 */
	public function __construct(
		CreateSanghaForm $createSanghaForm,
		SanghaRepositoryInterface $sanghaRepository
	) {
		$this->createSanghaForm = $createSanghaForm;
		$this->sanghaRepository = $sanghaRepository;

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

		return View::make('sanghas.show')->withSangha($sangha);
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
