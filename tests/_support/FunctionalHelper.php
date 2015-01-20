<?php namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
	public function signIn()
	{
		$email = 'foo@example.com';
		$password = 'foo';
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

		$I = $this->getModule('Laravel4');

		$I->amOnPage('/login');
		$I->fillField('email', $email);
		$I->fillField('password', $password);
		$I->click('Inloggen');
	}

	public function createAnAdministratorRole()
	{
		TestDummy::create('Sanghaplanner\Roles\Role', [
		'rolename' => 'administrator'
		]);
	}

	public function haveAMember()
	{
		TestDummy::create('Sanghaplanner\Roles\Role', [
		'rolename' => 'lid'
		]);
	}

//     public function haveASangha()
//     {
//         TestDummy::create('Sanghaplanner\Pivot\SanghaUser');
//     }

	public function haveAnAccount($overrides = [])
	{
		return $this->have('Sanghaplanner\Users\User', $overrides);
	}

	public function have($model, $overrides = [])
	{
		return TestDummy::create($model, $overrides);
	}
}
