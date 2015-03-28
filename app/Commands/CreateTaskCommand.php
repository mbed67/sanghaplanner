<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Tasks\TaskRepositoryInterface;
use Sanghaplanner\Tasks\Task;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateTaskCommand extends Command implements SelfHandling
{

    /**
     * @var int
     */
    protected $sanghaUserId;

    /**
     * @var int
     */
    protected $retreatId;

    /**
     * @var string
     */
    protected $description;


    /**
     * @param int $sanghaUserId
     * @param int $retreatId
     * @param string $description
     */
    public function __construct($sanghaUserId, $retreatId, $description)
    {
        $this->sanghaUserId = $sanghaUserId;
        $this->retreatId = $retreatId;
        $this->description = $description;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(TaskRepositoryInterface $repository)
    {
        $task = Task::makeRetreatTask(
            $this->sanghaUserId,
            $this->retreatId,
            $this->description
        );

        $repository->save($task);

        return $task;
    }
}
