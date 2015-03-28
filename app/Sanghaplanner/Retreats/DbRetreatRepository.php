<?php namespace Sanghaplanner\Retreats;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Retreats\Retreat;
use Carbon\Carbon;
use DB;

class DbRetreatRepository extends DbRepository implements RetreatRepositoryInterface
{

    /**
     *
     * @var Sanghaplanner\Retreats\Retreat
     */
    protected $model;

    /**
     *
     * @param Retreat $model
     */
    public function __construct(Retreat $retreat)
    {
        $this->model = $retreat;
    }

    /**
     * Persist a Retreat
     *
     * @param Retreat $retreat
     * @return mixed
     */
    public function save(Retreat $retreat)
    {
        return $retreat->save();
    }

    /**
     * Returns a list of all retreats for an array of sangha_users
     *
     * @param $sanghaUserIds
     * @return array
     */
    public function getRetreatsForSangha($sanghaUserIds)
    {
        $retreats = $this->model->whereHas('tasks', function($q) use ($sanghaUserIds) {

            $q->whereIn('sangha_user_id', $sanghaUserIds);

        })
        ->where('retreat_start', '>', Carbon::now())
        ->get();

        return $retreats;
    }

    /**
     * Returns the participants of a retreat
     *
     * @param $retreatId
     * @return array
     */
    public function getParticipants($retreatId)
    {
        return DB::table('retreats')
            ->join('tasks', function($join) use ($retreatId) {

                    $join->on('retreats.id', '=', 'tasks.retreat_id')
                         ->where('retreats.id', '=', $retreatId);
            })
            ->join('sangha_user', 'tasks.sangha_user_id', '=', 'sangha_user.id')
            ->join('users', 'sangha_user.user_id', '=', 'users.id')
            ->select('users.*')
            ->get();
    }
}
