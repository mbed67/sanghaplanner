<?php namespace Sanghaplanner\Sanghas;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Users\User;

class DbSanghaRepository extends DbRepository implements SanghaRepositoryInterface
{

    /**
     *
     * @var Sanghaplanner\Sanghas\Sangha
     */
    protected $model;

    /**
     *
     * @param Sangha $model
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
     * @param integer $role_id
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
}
