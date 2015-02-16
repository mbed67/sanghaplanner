<?php namespace Sanghaplanner\Users;

interface UserRepositoryInterface
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
     * Persist a user
     *
     * @param User $user
     * @return mixed
     */
    public function save(User $user);

    /**
     * Find a user based on input from a search box
     *
     * @param $search
     */
    public function searchUser($search);

    /**
     * Find a user with all of its sanghas
     *
     * @param $id
     * @return mixed
     */
    public function findUserWithSanghas($id);

    /**
     * Create a notification for a user
     *
     * @param User $user
     * @return Notification $notification
     */
    public function newNotification(User $user);

    /**
     * Find a user with all of its unread notifications
     *
     * @param $id
     * @return mixed
     */
    public function findUserWithAllNotifications($id);
}
