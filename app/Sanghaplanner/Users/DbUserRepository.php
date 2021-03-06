<?php namespace Sanghaplanner\Users;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Notifications\Notification;
use DB;

class DbUserRepository extends DbRepository implements UserRepositoryInterface
{
    /**
     *
     * @var Sanghaplanner\Users\User
     */
    protected $model;

    /**
     * @param User $model
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Persist a user
     *
     * @param User $user
     * @return mixed
     */
    public function save(User $user)
    {
        return $user->save();
    }

    /**
     * Find a user based on input from a search box
     *
     * @param $search
     */
    public function searchUser($search)
    {
        return User::search($search)->get();
    }

    /**
     * Find a user with all of its sanghas
     *
     * @param $id
     * @return mixed
     */
    public function findUserWithSanghas($id)
    {
        return User::with('sanghas')->find($id);
    }

    /**
     * @param User $user
     * @return Notification $notification
     */
    public function newNotification(User $user)
    {
        $notification = new Notification;
        $notification->user()->associate($user);

        return $notification;
    }

    /**
     * Find a user with all of its unread notifications
     *
     * @param $id
     * @return mixed
     */
    public function findUserWithAllNotifications($id)
    {
        return User::with(array('notifications' => function($query) {
            $query->orderBy('sent_at', 'desc');

        }))->find($id);
    }

    /**
     * Toggle the role of the user
     *
     * @param integer $userId
     * @param integer $sanghaId
     */
    public function toggleRole($userId, $sanghaId)
    {
        $user = $this->model->find($userId);

        if ($user->roleForSangha($sanghaId) == 'administrator') {
            $user->sanghas()->updateExistingPivot($sanghaId, ['role_id' => 2]);
        } elseif ($user->roleForSangha($sanghaId) == 'lid') {
            $user->sanghas()->updateExistingPivot($sanghaId, ['role_id' => 1]);
        }
    }

    /**
     * Return a list with retreats that the user is attending
     *
     * @param $userId
     * @return array
     */
    public function retreatsAttendedByUser($userId)
    {
        $retreats =  DB::table('users')
        ->join('sangha_user', function($join) use ($userId) {

            $join->on('users.id', '=', 'sangha_user.user_id')
            ->where('users.id', '=', $userId);
        })
        ->join('tasks', 'sangha_user.id', '=', 'tasks.sangha_user_id')
        ->join('retreats', 'tasks.retreat_id', '=', 'retreats.id')
        ->select('retreats.id')
        ->get();

        return (array) $retreats;
    }
}
