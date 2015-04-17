<?php

use Sanghaplanner\Sanghas\DbSanghaRepository;
use Sanghaplanner\Sanghas\Sangha;
use Laracasts\TestDummy\Factory as TestDummy;

class SanghaRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    /**
     * @var Sanghaplanner\Sanghas\DbSanghaRepository
     */
    protected $repo;

    protected function _before()
    {
        $sangha = new Sangha();
        $this->repo = new DbSanghaRepository($sangha);
    }

    /** @tests */
    public function it_persists_a_sangha()
    {
        $sangha = new Sangha();
        $sangha->setAttribute('sanghaname', 'Testsangha');

        $this->repo->save($sangha);

        $this->tester->seeRecord('sanghas', array('sanghaname' => 'Testsangha'));
    }

    /** @tests */
    public function it_finds_a_sangha_by_its_name()
    {
        TestDummy::create('Sanghaplanner\Sanghas\Sangha', ['sanghaname' => 'Testsangha']);

        $result = $this->repo->getSanghaByName('Testsangha');

        $this->assertEquals('Testsangha', $result->sanghaname);
    }

    /** @tests */
    public function it_makes_a_user_a_member_of_sangha()
    {
        $role = $this->tester->createAnAdministratorRole();
        $sangha = $this->tester->createASangha();
        $user = $this->tester->createAUser();

        $this->repo->createSanghaUser($sangha, $user, $role->id);

        $this->tester->seeRecord('sangha_user', ['sangha_id' => $sangha->id]);
        $this->tester->seeRecord('sangha_user', ['user_id' => $user->id]);
        $this->tester->seeRecord('sangha_user', ['role_id' => $role->id]);
    }

    /** @tests */
    public function it_finds_a_sangha_based_on_search_criteria()
    {
        $this->tester->createASangha();

        $result = $this->repo->searchSangha('Test');

        $this->assertCount(1, $result);
    }

    /** @tests */
    public function it_finds_a_sangha_with_users()
    {
        $sangha = $this->tester->haveASanghaWithTwoAdmins();

        $result = $this->repo->findSanghaWithUsers($sangha->id);

        $this->tester->seeRecord('sanghas', array('sanghaname' => 'Testsangha'));
        $this->tester->seeRecord('users', array('firstname' => 'First user'));
        $this->tester->seeRecord('users', array('firstname' => 'Second user'));

        $users = $result->users;

        $this->assertCount(2, $users);
    }

    /** @tests */
    public function it_finds_all_admins_for_a_sangha()
    {
        $sangha = $this->tester->haveASanghaWithTwoAdmins();
        $role_id = $sangha->users()->first()->pivot->role_id;

        $results = $this->repo->findUsersByRoleForSangha($sangha->id, $role_id);

        $this->assertCount(2, $results);
    }

    /** @tests */
    public function it_removes_a_user_from_a_sangha()
    {
        $sangha = $this->tester->haveASanghaWithTwoAdmins();
        $user = $sangha->users()->first();

        $this->tester->seeRecord('sangha_user', ['user_id' => $user->id]);

        $results = $this->repo->deleteSanghaUser($sangha, $user);

        $this->tester->dontSeeRecord('sangha_user', ['user_id' => $user->id]);
    }

    /** @tests */
    public function it_finds_the_sangha_user_ids_for_a_sangha()
    {
        $sangha = $this->tester->haveASanghaWithTwoAdmins();

        $results = $this->repo->findSanghaUserIdsForSangha($sangha->id);

        $this->assertCount(2, $results);
    }

    /** @tests */
    public function it_finds_the_id_of_the_pivot_record_for_a_user_and_a_sangha()
    {
        $user = $this->tester->haveAUserWithTwoSanghas();
        $sangha = $user->sanghas()->first();

        $result = $this->repo->findPivotId($sangha, $user->id);

        $this->assertTrue(gettype($result) === 'integer');
    }
}
