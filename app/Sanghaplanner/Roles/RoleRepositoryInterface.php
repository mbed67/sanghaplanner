<?php
namespace Sanghaplanner\Roles;

interface RoleRepositoryInterface
{

    /**
     * Get all records from model
     *
     */
    public function getAll();

    /**
     * Gets a record from the model table by id
     *
     * @param integer $id
     */
    public function findById($id);

    /**
     * Persist a role
     *
     * @param Role $role
     * @return mixed
     */
    public function save(Role $role);

    /**
     * Gets role data
     *
     * @param string $modelnaam
     * @return Sanghaplanner\Roles\Role
     */
    public function getRoleByName($rolnaam);
}
