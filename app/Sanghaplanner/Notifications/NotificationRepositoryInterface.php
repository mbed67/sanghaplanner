<?php namespace Sanghaplanner\Notifications;

use Sanghaplanner\Sanghas\Sangha;

interface NotificationRepositoryInterface
{

    /**
     * Get all records from model
     */
    public function getAll();

    /**
     * Gets a record from the model table by id
     *
     * @param integer $id
     */
    public function findById($id);

    /**
     * Persist a notification
     *
     * @param Notification $notification
     * @return mixed
     */
    public function save(Notification $notification);

    /**
     * Marks a notification as read
     *
     * @param Notification $notification
     * @return mixed
     */
    public function markNotificationRead($id);

    /**
     * @param Sangha $sangha
     * @return mixed
     */
    public function showMembershipRequestsForSangha(Sangha $sangha, $id);

    /**
     * @param int $senderId
     * @param int $objectId
     * @return mixed
     */
    public function findMembershipRequestsForSenderWithObject($senderId, $objectId);
}
