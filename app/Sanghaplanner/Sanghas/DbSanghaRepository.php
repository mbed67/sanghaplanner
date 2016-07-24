<?php namespace Sanghaplanner\Sanghas;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Users\User;
use DB;

class DbSanghaRepository extends DbRepository implements SanghaRepositoryInterface
{

    /**
     *
     * @var Sangha
     */
    protected $model;

    /**
     *
     * @param Sangha $sangha
     */
    public function __construct(Sangha $sangha)
    {
        $this->model = $sangha;
    }

    /**
     * Persist a sangha
     *
     * @param Sangha $sangha
     * @return mixed
     */
    public function save(Sangha $sangha)
    {
        return $sangha->save();
    }

    /**
     * Gets sangha data
     *
     * @param string $sanghaname
     */
    public function getSanghaByName($sanghaname)
    {
        return $this->model->whereSanghaname($sanghaname)->first();
    }

    /**
     * Creates a record in pivot table sangha_user
     *
     * @param Sangha $sangha
     * @param User $user
     * @param int $role_id
     * @return bool
     */
    public function createSanghaUser(Sangha $sangha, User $user, $role_id)
    {
        if (! $sangha->users()->find($user->id)) {
            $sangha->users()->attach($user->id, array('role_id' => $role_id));

            return true;
        }
    }

    /**
     * Deletes a record from pivot table sangha_user
     *
     * @param Sangha $sangha
     * @param User $user
     * @return bool
     */
    public function deleteSanghaUser(Sangha $sangha, User $user)
    {
        if ($sangha->users()->find($user->id)) {
            $sangha->users()->detach($user->id);

            return true;
        }
    }

    /**
     * Find a sangha based on input from a search box
     *
     * @param $search
     */
    public function searchSangha($search)
    {
        return Sangha::search($search)->get();
    }

    /**
     * Find a sangha with all of its users
     *
     * @param $id
     * @return mixed
     */
    public function findSanghaWithUsers($id)
    {
        return Sangha::with('users')->find($id);
    }

    /**
     * Finds all users with a certain role for a certain sangha
     *
     * @param $sanghaId
     * @param $roleId
     * @return mixed
     */
    public function findUsersByRoleForSangha($sanghaId, $roleId)
    {
        return Sangha::find($sanghaId)->users()->wherePivot('role_id', '=', $roleId)->get();
    }


    /**
     * returns the ids of the pivot table records for a sangha
     *
     * @param $sanghaId
     * @returns array
     */
    public function findSanghaUserIdsForSangha($sanghaId)
    {
        $sanghaUserIds = DB::table('sangha_user')
            ->where('sangha_id', '=', $sanghaId)
            ->lists('id');

        return $sanghaUserIds;
    }

    /**
     * Returns the id on the pivot table for the user with this sangha
     *
     * @param Sangha $sangha
     * @param int $userId
     * @return int
     */
    public function findPivotId($sangha, $userId)
    {
        if ($sangha->users->find($userId)) {
            $sanghaUserId = DB::table('sangha_user')
            ->where('sangha_id', '=', $sangha->id)
            ->where('user_id', '=', $userId)
            ->pluck('id');

            return $sanghaUserId;
        }
    }
}
