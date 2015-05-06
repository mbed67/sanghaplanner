<?php namespace App\Http\Controllers;

use Mockery as m;
use Sanghaplanner\Users\User;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use App\Http\Requests\CreateRoleRequest;
use \Laracasts\Flash\Flash;
use Redirect;

class RolesControllerTest extends \TestCase
{

    /** @var Mockery|RoleRepositoryInterface */
    private $repositoryMock;

    /** @var Mockery|CreateRoleRequest */
    private $requestMock;

    /** @var RolesController */
    private $fixture;

    /**
     * Initializes the fixture for this test.
     */
    public function setUp()
    {
        parent::setup();

        $this->repositoryMock = $this->mock('Sanghaplanner\Roles\RoleRepositoryInterface');
        $this->requestMock = $this->mock('App\Http\Requests\CreateRoleRequest');

        $this->fixture = new RolesController($this->repositoryMock);
    }

    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /**
     * @covers App\Http\Controllers\RolesController::__construct
     */
    public function testIfDependencyIsCorrectlyRegisteredOnInitialization()
    {
        $this->assertAttributeSame($this->repositoryMock, 'roleRepository', $this->fixture);
    }

    /**
     * @covers App\Http\Controllers\RolesController::index
     */
    public function testIndex()
    {
        $this->authenticate();
        $this->repositoryMock
            ->shouldReceive('getAll')
            ->twice()
            ->andReturn(new \Illuminate\Database\Eloquent\Collection);

        $this->call('GET', 'roles');

        $this->assertViewHas('roles');
        $this->assertInstanceOf("Illuminate\View\View", $this->fixture->index());
    }

    /**
     * @covers App\Http\Controllers\RolesController::create
     */
    public function testCreate()
    {
        $this->authenticate();

        $this->call('GET', 'createrole');

        $this->assertResponseOk();
        $this->assertInstanceOf("Illuminate\View\View", $this->fixture->create());
    }

    /**
     * @covers App\Http\Controllers\RolesController::store
     */
    public function testStore()
    {
        $this->requestMock->shouldReceive('offsetExists')->andReturn(['rolename' => 'lid']);
        $this->requestMock->shouldReceive('offsetGet')->andReturn(['rolename' => 'lid']);
        $this->repositoryMock->shouldReceive('save')->once();
        Flash::shouldReceive('success')->once();
        Redirect::shouldReceive('to')->once();

        $this->fixture->store($this->requestMock);
    }

    private function mock($class)
    {
        $mock = m::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }

    private function authenticate()
    {
        $user = new User(['firstname' => ' John']);
        $this->be($user);
    }
}
