<?php namespace App\Commands;

use App\Commands\Command;
use Sanghaplanner\Roles\RoleRepositoryInterface;
use Sanghaplanner\Roles\Role;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateRoleCommand extends Command implements SelfHandling
{

    /**
     * @var string
     */
    protected $rolename;

    /**
     * @param string rolename
     */
    public function __construct($rolename)
    {
        $this->rolename = $rolename;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(RoleRepositoryInterface $repository)
    {
        $role = Role::createRole($this->rolename);

        $repository->save($role);

        return $role;
    }
}
