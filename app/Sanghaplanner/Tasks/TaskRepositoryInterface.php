<?php
namespace Sanghaplanner\Tasks;

interface TaskRepositoryInterface
{

    /**
     * Get all records from model
     *
     */
    public function getAll();

    /**
     * Gets a record from the model table by id
     *
     * @param integer $id
     */
    public function findById($id);

    /**
     * Persist a task
     *
     * @param Task $task
     * @return mixed
     */
    public function save(Task $task);
}
