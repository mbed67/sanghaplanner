<?php

use Sanghaplanner\Retreats\DbRetreatRepository;
use Sanghaplanner\Retreats\Retreat;
use Laracasts\TestDummy\Factory as TestDummy;

class RetreatRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    /**
     * @var Sanghaplanner\Retreats\DbRetreatRepository
     */
    protected $repo;

    protected function _before()
    {
        $retreat = new Retreat();
        $this->repo = new DbRetreatRepository($retreat);
    }

    /** @tests */
    public function it_persists_a_retreat()
    {
        $retreat = new Retreat();
        $retreat->setAttribute('description', 'Testretreat');

        $this->repo->save($retreat);

        $this->tester->seeRecord('retreats', array('description' => 'Testretreat'));
    }

    /** @tests */
    public function it_gets_the_retreats_for_a_sangha()
    {
        $sanghaUserId = 1;
        $retreat = $this->tester->createARetreat();
        $task = $this->tester->createATask($sanghaUserId, $retreat->id, 'attending');

        $results = $this->repo->getRetreatsForSangha([$sanghaUserId]);

        $this->assertCount(1, $results);
    }

    /** @tests */
    public function it_gets_the_participants_for_a_retreat()
    {
        $retreat = $this->tester->haveARetreatWithTwoUsers();

        $results = $this->repo->getParticipants($retreat->id);

        $this->assertCount(2, $results);

    }
}
