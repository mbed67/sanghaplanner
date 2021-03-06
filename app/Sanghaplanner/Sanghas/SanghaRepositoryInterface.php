<?php namespace Sanghaplanner\Sanghas;

use Sanghaplanner\Users\User;

interface SanghaRepositoryInterface
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
     * Persist a sangha
     *
     * @param Sangha $sangha
     * @return mixed
     */
    public function save(Sangha $sangha);

    /**
     * Gets sangha data
     *
     * @param string $sanghaname
     */
    public function getSanghaByName($sanghanaam);

    /**
     * Creates a record in pivot table sangha_user
     *
     * @param Sangha $sangha
     * @param User $user
     * @param integer $role_id
     */
    public function createSanghaUser(Sangha $sangha, User $user, $role_id);

    /**
     * Deletes a record from pivot table sangha_user
     *
     * @param Sangha $sangha
     * @param User $user
     */
    public function deleteSanghaUser(Sangha $sangha, User $user);

    /**
     * Find a sangha based on input from a search box
     *
     * @param $search
     */
    public function searchSangha($search);

    /**
     * Find a sangha with all of its users
     *
     * @param $id
     * @return mixed
     */
    public function findSanghaWithUsers($id);

    /**
     * Finds all users with a certain role for a certain sangha
     *
     * @param $sanghaId
     * @param $roleId
     * @return mixed
     */
    public function findUsersByRoleForSangha($sanghaId, $roleId);

    /**
     * returns the ids of the pivot table records for a sangha
     *
     * @param $sanghaId
     * @returns array
     */
    public function findSanghaUserIdsForSangha($sanghaId);

    /**
     * Returns the id on the pivot table for the user with this sangha
     *
     * @param $id
     * @return string
     */
    public function findPivotId($sangha, $userId);
}
