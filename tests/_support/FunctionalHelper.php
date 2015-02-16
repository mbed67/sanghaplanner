<?php namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
    public function signIn()
    {
        $email = 'foo@example.com';
        $password = bcrypt('foofoofoo');
        $firstname = 'foo';
        $middlename = 'de';
        $lastname = 'bar';
        $address = 'spoorweg 4';
        $zipcode = '1234 AA';
        $place = 'Amsterdam';
        $phone = '020-1234567';
        $gsm = '06-12345678';

        $this->haveAnAccount(compact(
            'email',
            'password',
            'firstname',
            'middlename',
            'lastname',
            'address',
            'zipcode',
            'place',
            'phone',
            'gsm'
        ));

        $I = $this->getModule('Laravel5');

        $I->amOnPage('/auth/login');
        $I->fillField('email', $email);
        $I->fillField('password', 'foofoofoo');
        $I->click('Inloggen');
    }

    public function createAnAdministratorRole()
    {
        TestDummy::create('Sanghaplanner\Roles\Role', [
            'rolename' => 'administrator'
        ]);
    }

    public function createAMemberRole()
    {
        TestDummy::create('Sanghaplanner\Roles\Role', [
            'rolename' => 'lid'
        ]);
    }

    public function haveASanghaWithAnAdministrator()
    {
        $role = TestDummy::create('Sanghaplanner\Roles\Role', [
            'rolename' => 'administrator'
        ]);

        $sangha = TestDummy::create('Sanghaplanner\Sanghas\Sangha', [
            'sanghaname' => 'Mijn sangha'
        ]);

        $user = TestDummy::create('Sanghaplanner\Users\User', [
            'email' => 'admin@example.com',
            'password' => bcrypt('adminadmin')
        ]);

        $user->sanghas()->attach($sangha->id, array('role_id' => $role->id));

        return $user;
    }

    public function haveAnAccount($overrides = [])
    {
        return $this->have('Sanghaplanner\Users\User', $overrides);
    }

    public function have($model, $overrides = [])
    {
        return TestDummy::create($model, $overrides);
    }

    public function signInAsAdministrator()
    {
        $user = $this->haveASanghaWithAnAdministrator();
        $I = $this->getModule('Laravel5');

        $I->amOnPage('/auth/login');
        $I->fillField('email', 'admin@example.com');
        $I->fillField('password', 'adminadmin');
        $I->click('Inloggen');

        return $user;
    }

    public function haveANotification($user, $overrides = [])
    {
        return $this->have('Sanghaplanner\Notifications\Notification', $overrides);
    }
}
