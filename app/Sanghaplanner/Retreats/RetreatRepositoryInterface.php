<?php namespace Sanghaplanner\Retreats;

use Sanghaplanner\Tasks\Task;

interface RetreatRepositoryInterface
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
     * Persist a retreat
     *
     * @param Retreat $retreat
     * @return mixed
     */
    public function save(Retreat $retreat);

    /**
     * Returns a list of all retreats for an array of sangha_users
     *
     * @param $sanghaUserIds
     * @return array
     */
    public function getRetreatsForSangha($sanghaUserIds);
}
