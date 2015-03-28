<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Sanghaplanner\Users\UserRepositoryInterface;
use Auth;

class JoinRetreatComposer
{

    /**
     * @var UserRepositoryInterface
     */
    protected $repository;

    /**
     * @param  UserRepositoryInterface  $repository
     * @return void
     */
    public function __construct(UserRepositoryInterface  $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $retreatArray = [];
        $retreats = $this->repository->retreatsAttendedByUser(Auth::id());

        foreach ($retreats as $retreat) {
            $retreatArray[] = $retreat->id;
        }

        $view->with('myRetreats', $retreatArray);
    }
}
