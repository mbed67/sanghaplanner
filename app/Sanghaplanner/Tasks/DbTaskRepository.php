<?php namespace Sanghaplanner\Tasks;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Tasks\Task;

class DbTaskRepository extends DbRepository implements TaskRepositoryInterface
{

    /**
     *
     * @var Sanghaplanner\Entities\Role
     */
    protected $model;

    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    /**
     * Persist a task
     *
     * @param Task $task
     * @return mixed
     */
    public function save(Task $task)
    {
        return $task->save();
    }
}
