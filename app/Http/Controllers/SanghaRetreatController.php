<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\CreateRetreatRequest;
use App\Commands\CreateRetreatCommand;
use Sanghaplanner\Facades\Search;
use \Laracasts\Flash\Flash;

class SanghaRetreatController extends Controller
{

    /**
     * @param RetreatRepositoryInterface $retreatRepository
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($sanghaId)
    {
        return view('retreats.create', ['sanghaId' => $sanghaId]);
    }


    /**
     * Create a new Retreat.
     *
     * @return string
     */
    public function store(CreateRetreatRequest $request)
    {
        $retreat = $this->dispatchFrom(CreateRetreatCommand::class, $request);

        Flash::success('Het nieuwe evenement is aangemaakt.');

        return redirect('/sanghas/');
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
}
