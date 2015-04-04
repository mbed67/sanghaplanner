<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Retreats\RetreatRepositoryInterface;
use Sanghaplanner\Retreats\Retreat;
use Sanghaplanner\Sanghas\Sangha;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;
use Sanghaplanner\Tasks\Task;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Auth;
use Carbon\Carbon;

class CreateRetreatCommand extends Command implements SelfHandling
{
    use DispatchesCommands;

    /**
     * @var int
     */
    protected $sanghaId;

    /**
     * @var string
     */
    protected $description;


    /**
     * @var Carbon
     */
    protected $retreatStart;

    /**
     * @var Carbon
     */
    protected $retreatEnd;

    /**
     * @param int $sanghaId
     * @param string $description
     * @param timestamp $retreat_start
     * @param timestamp $retreat_end
     */
    public function __construct($sanghaId, $description, $retreat_start, $retreat_end)
    {
        $this->sanghaId = $sanghaId;
        $this->description = $description;
        $this->retreatStart = Carbon::createFromFormat('d-m-Y H:i', $retreat_start, 'CET');
        $this->retreatEnd = Carbon::createFromFormat('d-m-Y H:i', $retreat_end, 'CET');
    }

    /**
     * Create a retreat and set the 'attending' task for the administrator
     *
     * @param RetreatRepositoryInterface $repository
     *
     * @return void
     */
    public function handle(
        RetreatRepositoryInterface $repository,
        SanghaRepositoryInterface $sanghaRepository
    ) {
        $retreat = Retreat::createRetreat(
            $this->description,
            $this->retreatStart,
            $this->retreatEnd
        );

        $repository->save($retreat);

        $sangha = $sanghaRepository->findById($this->sanghaId);
        $userId = Auth::id();

        $sanghaUserId = $sanghaRepository->findPivotId($sangha, $userId);
        $taskDescription = 'attending';

        $task = Task::makeRetreatTask($sanghaUserId, $retreat->id, $taskDescription);

        $retreat->tasks()->save($task);

        return $retreat;
    }
}
