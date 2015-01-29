<?php

use Sanghaplanner\Users\DbUserRepository;
use Sanghaplanner\Users\User;
use Laracasts\TestDummy\Factory as TestDummy;

class UserRepositoryTest extends \Codeception\TestCase\Test
{
	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	protected function _before()
	{
		$user = new User();
		$this->repo = new DbUserRepository($user);
	}

	/** @tests */
	public function it_gets_all_users()
	{
		TestDummy::times(4)->create('Sanghaplanner\Users\User');

		$results = $this->repo->getAll();

		$this->assertCount(4, $results);
	}

	/** @tests */
	public function it_persists_a_user()
	{
		$user = new User();
		$user->setAttribute('firstname', 'Testuser');

		$this->repo->save($user);

		$this->tester->seeRecord('users', array('firstname' => 'Testuser'));
	}

	/** @tests */
	public function it_finds_a_user_based_on_search_criteria()
	{
		$this->tester->createAUser();

		$result = $this->repo->searchUser('Test');

		$this->assertCount(1, $result);
	}

	/** @tests */
	public function it_finds_a_user_with_sanghas()
	{
		$user = $this->tester->haveAUserWithTwoSanghas();

		$result = $this->repo->findUserWithSanghas($user->id);

		$this->tester->seeRecord('users', array('firstname' => 'Testuser'));
		$this->tester->seeRecord('sanghas', array('sanghaname' => 'First sangha'));
		$this->tester->seeRecord('sanghas', array('sanghaname' => 'Second sangha'));

		$sanghas = $result->sanghas;

		$this->assertCount(2, $sanghas);
	}

	/** @tests */
	public function it_finds_a_user_with_all_notifications()
	{
		$user = $this->tester->createAUser();

		TestDummy::times(4)->create('Sanghaplanner\Notifications\Notification', [
			'user_id' => $user->id
		]);

		$result = $this->repo->findUserWithAllNotifications($user->id);

		$notifications = $result->notifications;

		$this->assertCount(4, $notifications);
	}
}
