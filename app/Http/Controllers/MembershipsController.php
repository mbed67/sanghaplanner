<?php namespace App\Http\Controllers;

use App\Commands\ApproveMemberCommand;
use App\Commands\RejectMemberCommand;
use App\Commands\LeaveSanghaCommand;
use App\Commands\ToggleRoleCommand;
use App\Http\Requests\ApproveOrRejectMemberRequest;
use App\Http\Requests\ToggleRoleRequest;
use App\Http\Requests\RemoveMemberRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Psy\Util\Json;
use Redirect;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;

class MembershipsController extends Controller
{

    /**
     * @var SanghaRepositoryInterface
     */
    private $sanghaRepository;

    /**
     * MembershipsController constructor.
     *
     * @param SanghaRepositoryInterface $sanghaRepository
     */
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
     * @param ApproveOrRejectMemberRequest $request
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
     * Update the specified resource in storage.
     *
     * @param ToggleRoleRequest $request
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
    public function leaveSangha($sanghaIdToLeave)
    {
        if ($this->sanghaRepository->findById($sanghaIdToLeave)->users()->get()->contains('id', Auth::user()->id)) {
            $this->dispatch(new LeaveSanghaCommand(Auth::user()->id, $sanghaIdToLeave));
        }

        return new JsonResponse();
    }

    /**
     * Remove the specified member from the sangha.
     *
     * @param RemoveMemberRequest $request
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function removeFromSangha(RemoveMemberRequest $request)
    {
        if ($this->sanghaRepository->findById(Input::get('sanghaIdToUnjoin'))
            ->users()
            ->get()
            ->contains('id', Input::get('userId'))) {
            $this->dispatch(new LeaveSanghaCommand(Input::get('userId'), Input::get('sanghaIdToUnjoin')));
        }

        return new JsonResponse();
    }
}
