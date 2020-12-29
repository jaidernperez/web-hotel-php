<?php

namespace App\Repositories;

use App\Models\RoomTypeEntity;
use Config\Conn;
use PDO;

class RoomTypeRepository extends Conn
{
    public function show()
    {
        $sql = "select id_tipo, nombre
                from tipo_habitacion
                order by id_tipo desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(RoomTypeEntity $roomType)
    {
        $sql = "insert into tipo_habitacion (nombre)
                values (?);";

        $roomTypeName = $roomType->getTypeName();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roomTypeName);

        $resource->execute();

        return $resource;
    }

    public function update(RoomTypeEntity $roomType)
    {
        $sql = "update tipo_habitacion
                set nombre = ?
                where id_tipo = ?;";

        $roomTypeId = $roomType->getTypeId();
        $roomTypeName = $roomType->getTypeName();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roomTypeName);
        $resource->bindParam(2, $roomTypeId);

        $resource->execute();

        return $resource;
    }

    public function delete(RoomTypeEntity $roomType)
    {
        $sql = "delete
                from tipo_habitacion
                where id_tipo = ?;";

        $roomTypeId = $roomType->getTypeId();

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $roomTypeId);
        $resource->execute();

        return $resource;
    }

    public function getOne($roomTypeId)
    {
        $sql="select id_tipo, nombre
                from tipo_habitacion
                where id_tipo = ?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $roomTypeId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)){
            return null;
        }
        return $row[0];
    }

    public function getRoomsNumberByType()
    {
        $sql = "select count(h.id_habitacion) numero, th.nombre tipo
                from tipo_habitacion th
                         left join habitacion h on th.id_tipo = h.id_tipo
                group by th.id_tipo;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return  $resource->fetchAll(PDO::FETCH_ASSOC);
    }
}