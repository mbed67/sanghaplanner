<?php namespace Sanghaplanner\Roles;

use Sanghaplanner\Repositories\DbRepository;
use Sanghaplanner\Roles\Role;

class DbRoleRepository extends DbRepository implements RoleRepositoryInterface
{

    /**
     *
     * @var Sanghaplanner\Entities\Role
     */
    protected $model;

    /**
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Persist a role
     *
     * @param Role $role
     * @return mixed
     */
    public function save(Role $role)
    {
        return $role->save();
    }

    /**
     * Gets role data
     *
     * @param string $modelnaam
     * @return Sanghaplanner\Roles\Role
     */
    public function getRoleByName($rolename)
    {
        return $this->model->whereRolename($rolename)->first();
    }
}
