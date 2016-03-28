<?php namespace App\Http\Controllers;

use App\Commands\ApproveMemberCommand;
use App\Commands\RejectMemberCommand;
use App\Commands\LeaveSanghaCommand;
use App\Commands\ToggleRoleCommand;
use App\Http\Requests\ApproveOrRejectMemberRequest;
use App\Http\Requests\LeaveSanghaRequest;
use App\Http\Requests\ToggleRoleRequest;
use Request;
use Redirect;
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
        if (Request::exists('approved')) {
            $this->dispatchFrom(ApproveMemberCommand::class, $request);

            return Redirect::back();

        } else {
            $this->dispatchFrom(RejectMemberCommand::class, $request);

            return Redirect::back();
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
    public function update(ToggleRoleRequest $request)
    {
        $this->dispatchFrom(ToggleRoleCommand::class, $request);

        return Redirect::back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  LeaveSanghaRequest $request
     * @return Response
     */
    public function destroy(LeaveSanghaRequest $request)
    {
        $this->dispatchFrom(LeaveSanghaCommand::class, $request);

        return Redirect::back();
    }
}
