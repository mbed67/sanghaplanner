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

        $user = $this->haveAnAccount(compact(
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

        return $user;
    }

    public function haveASanghaWithARetreat()
    {
        $user = $this->signInAsRole('administrator', 'myrole@example.com');
        $I = $this->getModule('Laravel5');
        $I->click('Sangha\'s');
        $I->click('Mijn sangha');
        $I->click('Evenementen');
        $I->click('Nieuw evenement');
        $I->fillField('Omschrijving:', 'Testevenement');
        $I->fillField('Begin:', '30-03-2030 21:25');
        $I->fillField('Einde:', '30-03-2030 22:25');
        $I->click('Maak evenement');
        $I->click('myrole@example.com');
        $I->click('Uitloggen');

        $sanghaId = $user->sanghas()->first()->id;

        return $sanghaId;

    }

    public function signInAsRole($role, $email)
    {
        $user = $this->haveASanghaWithRole($role);
        $I = $this->getModule('Laravel5');

        $I->amOnPage('/auth/login');
        $I->fillField('email', $email);
        $I->fillField('password', 'rolerole');
        $I->click('Inloggen');

        return $user;
    }

    public function haveASanghaWithRole($role)
    {
        $role = TestDummy::create('Sanghaplanner\Roles\Role', [
            'rolename' => $role
        ]);

        $sangha = TestDummy::create('Sanghaplanner\Sanghas\Sangha', [
            'sanghaname' => 'Mijn sangha'
        ]);

        $user = TestDummy::create('Sanghaplanner\Users\User', [
            'email' => 'myrole@example.com',
            'password' => bcrypt('rolerole')
        ]);

        $user->sanghas()->attach($sangha->id, array('role_id' => $role->id));

        return $user;
    }


    public function createAnAdministratorRole()
    {
        TestDummy::create('Sanghaplanner\Roles\Role', [
            'rolename' => 'administrator'
        ]);
    }

    public function createAMemberRole()
    {
        $role = TestDummy::create('Sanghaplanner\Roles\Role', [
            'rolename' => 'lid'
        ]);

        return $role;
    }

    public function haveAnAccount($overrides = [])
    {
        return $this->have('Sanghaplanner\Users\User', $overrides);
    }

    public function haveANotification($user, $overrides = [])
    {
        return $this->have('Sanghaplanner\Notifications\Notification', $overrides);
    }

    public function have($model, $overrides = [])
    {
        return TestDummy::create($model, $overrides);
    }
}
