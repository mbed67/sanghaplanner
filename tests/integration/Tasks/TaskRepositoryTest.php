<?php

use Sanghaplanner\Tasks\DbTaskRepository;
use Sanghaplanner\Tasks\Task;
use Laracasts\TestDummy\Factory as TestDummy;

class TaskRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    /**
     * @var Sanghaplanner\Tasks\DbTaskRepository
     */
    protected $repo;

    /**
     * @var Sanghaplanner\Tasks\Task
     */
    protected $task;

    protected function _before()
    {
        $this->task = new Task();
        $this->repo = new DbTaskRepository($this->task);
    }

    /** @tests */
    public function it_persists_a_task()
    {
        $user = $this->tester->haveAUserWithTwoSanghas();
        $sanghaIds = $user->sanghas->lists('id');

        $sanghaUserId = $this->tester->haveASanghaUserId($user->id, $sanghaIds[0]);

        $retreat = $this->tester->createARetreat();

        $task = $this->task->makeRetreatTask($sanghaUserId, $retreat->id, 'Testdescription');

        $this->repo->save($task);

        $this->tester->seeRecord('tasks', array('description' => 'Testdescription'));
    }
}
