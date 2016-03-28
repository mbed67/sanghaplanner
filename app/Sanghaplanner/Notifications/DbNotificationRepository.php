<?php namespace Sanghaplanner\Notifications;

use Illuminate\Support\Facades\Session;
use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Sanghas\Sangha;

class DbNotificationRepository extends DbRepository implements NotificationRepositoryInterface
{
    /**
     *
     * @var Sanghaplanner\Notifications\Notification
     */
    protected $model;

    /**
     * @param User $model
     */
    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }

    /**
     * Persist a notification
     *
     * @param Notification $notification
     * @return mixed
     */
    public function save(Notification $notification)
    {
        return $notification->save();
    }

    /**
     * Marks a notification as read
     *
     * @param Notification $notification
     * @return mixed
     */
    public function markNotificationRead($id)
    {
        $notification = $this->findById($id);

        $notification->is_read = 1;

        return $notification->save();
    }

    /**
     * @param Sangha $sangha
     * @param int $id
     * @return mixed
     */
    public function showMembershipRequestsForSangha(Sangha $sangha, $id)
    {
        $models = $this->model
            ->where('object_id', '=', $sangha->id)
            ->where('type', '=', 'MembershipRequest')
            ->where('user_id', '=', $id)
            ->where('is_read', '=', '0')
            ->get();

        $arrayOfModels = [];

        foreach($models as $model) {
            $arrayOfModels[] = [
                'id' => $model->id,
                'sanghaId' => $model->object_id,
                'senderId' => $model->sender_id,
                'firstName' => $model->sender->firstname,
                'middleName' => $model->sender->middlename,
                'lastName' => $model->sender->lastname,
                'avatar' => $model->sender->present()->gravatar(30),
                'profilePath' => route('profile_path', $model->sender->id),
                'token' => Session::token()
            ];
        }

        return $arrayOfModels;
    }

    /**
     * @param int $senderId
     * @param int $objectId
     * @return mixed
     */
    public function findMembershipRequestsForSenderWithObject($senderId, $objectId)
    {
        return $this->model
        ->where('Object_id', '=', $objectId)
        ->where('type', '=', 'MembershipRequest')
        ->where('sender_id', '=', $senderId)
        ->where('is_read', '=', '0')
        ->get();

    }
}
