<?php
namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;
use DB;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class IntegrationHelper extends \Codeception\Module
{
    public function haveAUserWithTwoRetreats()
    {
        $user = $this->haveAUserWithTwoSanghas();
        $sanghaIds = $user->sanghas->lists('id');

        $sanghaUserId = $this->haveASanghaUserId($user->id, $sanghaIds[0]);
        $retreat1 = $this->createARetreat();
        $retreat2 = $this->createARetreat();

        $this->createATask($sanghaUserId, $retreat1->id, 'attending');
        $this->createATask($sanghaUserId, $retreat2->id, 'attending');

        return $user;
    }

    public function haveARetreatWithTwoUsers()
    {
        $sangha = $this->haveASanghaWithTwoAdmins();
        $userIds = $sangha->users->lists('id');

        $sanghaUserId1 = $this->haveASanghaUserId($userIds[0], $sangha->id);
        $sanghaUserId2 = $this->haveASanghaUserId($userIds[1], $sangha->id);
        $retreat = $this->createARetreat();

        $this->createATask($sanghaUserId1, $retreat->id, 'attending');
        $this->createATask($sanghaUserId2, $retreat->id, 'attending');

        return $retreat;
    }

    public function haveAUserWithTwoSanghas()
    {
        $role = $this->createAnAdministratorRole();

        $sangha1 = TestDummy::create('Sanghaplanner\Sanghas\Sangha', [
            'sanghaname' => 'First sangha'
            ]);

        $sangha2 = TestDummy::create('Sanghaplanner\Sanghas\Sangha', [
            'sanghaname' => 'Second sangha'
            ]);

        $user = $this->createAUser();

        $user->sanghas()->attach($sangha1->id, array('role_id' => $role->id));
        $user->sanghas()->attach($sangha2->id, array('role_id' => $role->id));

        return $user;
    }

    public function haveASanghaWithTwoAdmins()
    {
        $role = $this->createAnAdministratorRole();

        $user1 = TestDummy::create('Sanghaplanner\Users\User', [
            'firstname' => 'First user'
            ]);

        $user2 = TestDummy::create('Sanghaplanner\Users\User', [
            'firstname' => 'Second user'
            ]);

        $sangha = $this->createASangha();

        $sangha->users()->attach($user1->id, array('role_id' => $role->id));
        $sangha->users()->attach($user2->id, array('role_id' => $role->id));

        return $sangha;
    }

    public function haveASanghaUserId($userId, $sanghaId)
    {
        $sanghaUserId = DB::table('sangha_user')
        ->where('sangha_id', '=', $sanghaId)
        ->where('user_id', '=', $userId)
        ->pluck('id');

        return $sanghaUserId;
    }

    public function createAnAdministratorRole()
    {
        return TestDummy::create('Sanghaplanner\Roles\Role', [
            'rolename' => 'administrator'
        ]);
    }

    public function createASangha()
    {
        return TestDummy::create('Sanghaplanner\Sanghas\Sangha', [
            'sanghaname' => 'Testsangha'
        ]);
    }

    public function createAUser()
    {
        return TestDummy::create('Sanghaplanner\Users\User', [
            'firstname' => 'Testuser'
        ]);
    }

    public function createATask($sanghaUserId, $retreatId, $description)
    {
        return TestDummy::create('Sanghaplanner\Tasks\Task', [
            'sangha_user_id' => $sanghaUserId,
            'retreat_id' => $retreatId,
            'description' => $description
        ]);
    }

    public function createARetreat()
    {
        return TestDummy::create('Sanghaplanner\Retreats\Retreat', [
            'description' => 'TestRetreat'
        ]);
    }

    public function have($model, $overrides = [])
    {
        return TestDummy::create($model, $overrides);
    }
}
