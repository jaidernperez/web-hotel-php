<?php

namespace App\Repositories;

use App\Models\UserEntity;
use Config\Conn;
use PDO;

class UserRepository extends Conn
{
    public function show()
    {
        $sql = "select id_usuario, r.nombre rol, concat(p.nombres, ' ', p.apellidos) persona, nombre_usuario, imagen
                from usuario u
                         inner join persona p on p.id_persona = u.id_persona
                         inner join rol r on r.id_rol = u.id_rol
                order by id_usuario desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(UserEntity $user)
    {
        $sql = "insert into usuario (id_rol, id_persona, nombre_usuario, clave)
                values (?, ?, ?, ?);";

        $userName = $user->getUserName();
        $password = $user->getPassword();
        $role = $user->getRole();
        $person = $user->getPerson();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $role);
        $resource->bindParam(2, $person);
        $resource->bindParam(3, $userName);
        $resource->bindParam(4, $password);

        $resource->execute();

        return $resource;
    }

    public function update(UserEntity $user)
    {
        $sql = "update usuario
                set nombre_usuario = ?,
                    clave          = ?,
                    id_rol         = ?,
                    id_persona     = ?
                where id_usuario = ?;";

        $userName = $user->getUserName();
        $password = $user->getPassword();
        $role = $user->getRole();
        $person = $user->getPerson();
        $userId = $user->getUserId();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $userName);
        $resource->bindParam(2, $password);
        $resource->bindParam(3, $role);
        $resource->bindParam(4, $person);
        $resource->bindParam(5, $userId);

        $resource->execute();

        return $resource;
    }

    public function delete(UserEntity $user)
    {
        $sql = "delete
                from usuario
                where id_usuario = ?;";

        $userId = $user->getUserId();

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $userId);
        $resource->execute();

        return $resource;
    }

    public function getOne($userId)
    {
        $sql="select id_usuario, id_rol, id_persona, nombre_usuario, imagen
                from usuario
                where id_usuario = ?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $userId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)){
            return null;
        }
        return $row[0];
    }

    public function login(UserEntity $user)
    {
        $sql="select id_usuario, id_rol, nombre_usuario
                from usuario
                where nombre_usuario = ? and clave = ?;";

        $userName = $user->getUserName();
        $password = $user->getPassword();

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $userName);
        $resource->bindParam(2, $password);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)){
            return null;
        }
        return $row[0];
    }

    public function updateLogin(UserEntity $user){
        $sql = "update usuario
                set nombre_usuario = ?,
                    clave          = ?
                where id_usuario = ?;";

        $userName = $user->getUserName();
        $password = $user->getPassword();
        $userId = $user->getUserId();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $userName);
        $resource->bindParam(2, $password);
        $resource->bindParam(3, $userId);

        $resource->execute();

        return $resource;
    }

    public function updateImage(UserEntity $user){
        $sql = "update usuario
                set imagen = ?
                where id_usuario = ?;";

        $image = $user->getImage();
        $userId = $user->getUserId();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $image);
        $resource->bindParam(2, $userId);

        $resource->execute();

        return $resource;
    }

    public function getUserNumber(){
        $sql = "select count(id_usuario) numero
                from usuario;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return null;
        }
        return $row[0]['numero'];
    }
}