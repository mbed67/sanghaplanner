<?php namespace App\Http\Controllers;

use App\Commands\ApproveMemberCommand;
use App\Commands\RejectMemberCommand;
use App\Commands\LeaveSanghaCommand;
use App\Http\Requests\ApproveOrRejectMemberRequest;
use App\Http\Requests\LeaveSanghaRequest;
use Request;
use Auth;

class MembershipsController extends Controller
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
    public function store(ApproveOrRejectMemberRequest $request)
    {

        if (Request::exists('approve_button')) {
            $this->dispatchFrom(ApproveMemberCommand::class, $request);

            return redirect('/sanghas');

        } else {
            $this->dispatchFrom(RejectMemberCommand::class, $request);

            return redirect('/sanghas');
        }
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
     * @param  LeaveSanghaRequest $request
     * @return Response
     */
    public function destroy(LeaveSanghaRequest $request)
    {
        $request['userId'] = Auth::id();

        $this->dispatchFrom(LeaveSanghaCommand::class, $request);

        return redirect('/sanghas');
    }
}
