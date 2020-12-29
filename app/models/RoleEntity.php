<?php

namespace App\Models;

class RoleEntity
{
    private $roleId;
    private $roleName;

    /**
     * RoleEntity constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param mixed $roleId
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param mixed $roleName
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

}