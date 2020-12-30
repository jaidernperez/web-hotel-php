<?php

namespace App\Repositories;

use App\Models\PersonEntity;
use Config\Conn;
use PDO;

class PersonRepository extends Conn
{
    public function show()
    {
        $sql = "select id_persona, cedula, nombres, apellidos, correo, telefono
                from persona
                where id_persona != 1
                order by id_persona desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(PersonEntity $person)
    {
        $sql = "insert into persona (cedula, nombres, apellidos, correo, telefono)
                values (?, ?, ?, ?, ?);";

        $dni = $person->getDni();
        $names = $person->getNames();
        $lastnames = $person->getLastNames();
        $email = $person->getEmail();
        $phone = $person->getPhone();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $dni);
        $resource->bindParam(2, $names);
        $resource->bindParam(3, $lastnames);
        $resource->bindParam(4, $email);
        $resource->bindParam(5, $phone);

        $resource->execute();

        return $resource;
    }

    public function update(PersonEntity $person)
    {
        $sql = "update persona
                set cedula    = ?,
                    nombres   = ?,
                    apellidos = ?,
                    correo    = ?,
                    telefono  = ?
                where id_persona = ?;";

        $dni = $person->getDni();
        $names = $person->getNames();
        $lastnames = $person->getLastNames();
        $email = $person->getEmail();
        $phone = $person->getPhone();
        $personId = $person->getPersonId();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $dni);
        $resource->bindParam(2, $names);
        $resource->bindParam(3, $lastnames);
        $resource->bindParam(4, $email);
        $resource->bindParam(5, $phone);
        $resource->bindParam(6, $personId);

        $resource->execute();

        return $resource;
    }

    public function delete(PersonEntity $person)
    {
        $sql = "delete
                from persona
                where id_persona = ?;";

        $personId = $person->getPersonId();

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $personId);
        $resource->execute();

        return $resource;
    }

    public function getOne($personId)
    {
        $sql = "select id_persona, cedula, nombres, apellidos, correo, telefono
                from persona
                where id_persona = ?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $personId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return null;
        }
        return $row[0];
    }

    public function getAll()
    {
        $sql = "select id_persona, cedula, nombres, apellidos, correo, telefono,
                 ((select count(*) from reservacion r where r.id_persona = p.id_persona)+
                (select count(*) from usuario u where u.id_persona = p.id_persona)) as childs
                from persona p
                where id_persona != 1
                order by id_persona desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNumChildById($personId){
        $sql = "select
                ((select count(*) from reservacion r where r.id_persona = ?)+
                (select count(*) from usuario u where u.id_persona = ?)) as childs";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $personId);
        $resource->bindParam(2, $personId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return -1;
        }
        return $row[0]['childs'];
    }

    public function getPersonNumber(){
        $sql = "select count(id_persona) numero
                from persona;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return null;
        }
        return $row[0]['numero'];
    }

    public function isUniqueDniAndEmail($dni, $email)
    {
        $dni = strtolower($dni);
        $email = strtolower($email);
        $sql = "select count(*) email,
                       (select count(*) num
                        from persona p
                        where lower(p.cedula) = ?) dni
                from persona p
                where lower(p.correo) = ?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $dni);
        $resource->bindParam(2, $email);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);

        return $row[0];
    }

}