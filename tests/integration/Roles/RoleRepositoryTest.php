<?php

use Sanghaplanner\Roles\DbRoleRepository;
use Sanghaplanner\Roles\Role;
use Laracasts\TestDummy\Factory as TestDummy;

class RoleRepositoryTest extends \Codeception\TestCase\Test
{
	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	protected function _before()
	{
		$role = new Role();
		$this->repo = new DbRoleRepository($role);
	}

	/** @tests */
	public function it_persists_a_role()
	{
		$role = new Role();
		$role->setAttribute('rolename', 'Testrole');

		$this->repo->save($role);

		$this->tester->seeRecord('roles', array('rolename' => 'Testrole'));
	}

	/** @tests */
	public function it_finds_a_role_by_its_name()
	{
		$this->tester->createAnAdministratorRole();

		$result = $this->repo->getRoleByName('administrator');

		$this->assertEquals('administrator', $result->rolename);
	}
}
