<?php namespace Sanghaplanner\Repositories;

abstract class DbRepository
{

    /**
     * Get all records from model
     */
    public function getAll()
    {
        return $this->model->all();
    }


    /**
     * Gets a record from the model table by id
     *
     * @param integer $id
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }
}
