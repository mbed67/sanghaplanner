<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\CreateRetreatRequest;
use App\Commands\CreateRetreatCommand;
use Illuminate\Http\Response;
use Sanghaplanner\Facades\Search;
use \Laracasts\Flash\Flash;
use Sanghaplanner\Retreats\RetreatRepositoryInterface;

class SanghaRetreatController extends Controller
{
    /**
     * @var RetreatRepositoryInterface
     */
    protected $retreatRepository;

    /**
     * @param RetreatRepositoryInterface $retreatRepository
     */
    public function __construct(RetreatRepositoryInterface $retreatRepository)
    {
        $this->retreatRepository = $retreatRepository;

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

        return redirect('/sanghas/' . $request->sanghaId);
    }

    /**
     * Display the specified resource.
     *
     * @param int $sanghaId
     * @param int $retreatId
     * @return Response
     */
    public function show($sanghaId, $retreatId)
    {
        $retreat = $this->retreatRepository->findById($retreatId);

        $participants = $this->retreatRepository->getParticipants($retreatId);

        return view('retreats.show', [
            'sanghaId' => $sanghaId,
            'retreat' => $retreat,
            'participants' => $participants
        ]);
    }
}
