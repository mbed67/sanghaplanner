<?php namespace Sanghaplanner\Retreats;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Retreats\Retreat;
use Carbon\Carbon;

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
}
