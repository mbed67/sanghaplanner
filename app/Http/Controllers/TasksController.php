<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\CreateTaskRequest;
use App\Commands\CreateTaskCommand;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;

class TasksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
    public function store(
        CreateTaskRequest $request,
        SanghaRepositoryInterface $sanghaRepository
    ) {
        $sangha = $sanghaRepository->findById($request->sanghaId);
        $sanghaUserId = $sanghaRepository->findPivotId($sangha, $request->userId);

        $task = $this->dispatchFrom(CreateTaskCommand::class, $request, ['sanghaUserId' => $sanghaUserId]);

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
