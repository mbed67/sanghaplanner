<?php
namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class IntegrationHelper extends \Codeception\Module
{
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

    public function have($model, $overrides = [])
    {
        return TestDummy::create($model, $overrides);
    }
}
