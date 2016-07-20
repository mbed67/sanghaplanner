<?php namespace App\Http\Controllers;

use App\Commands\ApproveMemberCommand;
use App\Commands\RejectMemberCommand;
use App\Commands\LeaveSanghaCommand;
use App\Commands\ToggleRoleCommand;
use App\Http\Requests\ApproveOrRejectMemberRequest;
use App\Http\Requests\ToggleRoleRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Request;
use Redirect;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;

class MembershipsController extends Controller
{

    /**
     * @var SanghaRepositoryInterface
     */
    private $sanghaRepository;

    public function __construct(SanghaRepositoryInterface $sanghaRepository)
    {
        $this->sanghaRepository = $sanghaRepository;
    }

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
        if (Input::has('approved')) {
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
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(ToggleRoleRequest $request)
    {
        $this->dispatchFrom(ToggleRoleCommand::class, $request);

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $sanghaIdToLeave
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy($sanghaIdToLeave)
    {
        if ($this->sanghaRepository->findById($sanghaIdToLeave)->users()->get()->contains('id', Auth::user()->id)) {
            $this->dispatch(new LeaveSanghaCommand(Auth::user()->id, $sanghaIdToLeave));
        }

        return redirect()->back();
    }
}
