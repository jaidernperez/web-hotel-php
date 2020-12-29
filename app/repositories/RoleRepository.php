<?php

namespace App\Repositories;

use App\Models\RoleEntity;
use Config\Conn;
use PDO;

class RoleRepository extends Conn
{
    public function show()
    {
        $sql = "select id_rol, nombre
                from rol
                order by id_rol desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(RoleEntity $role)
    {
        $sql = "insert into rol (nombre)
                values (?);";

        $roleName = $role->getRoleName();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roleName);

        $resource->execute();

        return $resource;
    }

    public function update(RoleEntity $role)
    {
        $sql = "update rol
                set nombre = ?
                where id_rol = ?;";

        $roleName = $role->getRoleName();
        $roleId = $role->getRoleId();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roleName);
        $resource->bindParam(2, $roleId);

        $resource->execute();

        return $resource;
    }

    public function delete(RoleEntity $role)
    {
        $sql = "delete
                from rol
                where id_rol = ?;";

        $roleId = $role->getRoleId();

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $roleId);
        $resource->execute();

        return $resource;
    }

    public function getOne($roleId)
    {
        $sql="select id_rol, nombre
                from rol
                where id_rol = ?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $roleId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)){
            return null;
        }
        return $row[0];
    }
}