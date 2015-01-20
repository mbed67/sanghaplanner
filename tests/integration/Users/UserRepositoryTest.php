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
}