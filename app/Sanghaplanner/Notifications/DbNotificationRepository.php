<?php namespace Sanghaplanner\Notifications;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Sanghas\Sangha;

class DbNotificationRepository extends DbRepository implements NotificationRepositoryInterface {
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
		return $this->model
			->where('Object_id', '=', $sangha->id)
			->where('type', '=', 'MembershipRequest')
			->where('user_id', '=', $id)
			->where('is_read', '=', '0')
			->get();
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
