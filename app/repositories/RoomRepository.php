<?php

namespace App\Repositories;

use App\Models\RoleEntity;
use App\Models\RoomEntity;
use Config\Conn;
use PDO;

class RoomRepository extends Conn
{
    public function show()
    {
        $sql = "select id_habitacion, th.nombre tipo_habitacion, h.nombre, precio, disponibilidad
                from habitacion h
                    inner join tipo_habitacion th on th.id_tipo = h.id_tipo
                order by id_habitacion desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(RoomEntity $room)
    {
        $sql = "insert into habitacion (id_tipo, nombre, precio, disponibilidad)
                values (?, ?, ?, ?);";

        $roomName = $room->getRoomName();
        $roomType = $room->getRoomType();
        $price = $room->getPrice();
        $availability = $room->getAvailability();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roomType);
        $resource->bindParam(2, $roomName);
        $resource->bindParam(3, $price);
        $resource->bindParam(4, $availability);

        $resource->execute();

        return $resource;
    }

    public function update(RoomEntity $room)
    {
        $sql = "update habitacion
                set id_tipo    = ?,
                nombre         = ?,
                precio         = ?,
                disponibilidad = ?
                where id_habitacion = ?;";

        $roomName = $room->getRoomName();
        $roomType = $room->getRoomType();
        $price = $room->getPrice();
        $availability = $room->getAvailability();
        $roomId = $room->getRoomId();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roomType);
        $resource->bindParam(2, $roomName);
        $resource->bindParam(3, $price);
        $resource->bindParam(4, $availability);
        $resource->bindParam(5, $roomId);

        $resource->execute();

        return $resource;
    }

    public function delete(RoomEntity $room)
    {
        $sql = "delete
                from habitacion
                where id_habitacion = ?;";

        $roomId = $room->getRoomId();

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $roomId);
        $resource->execute();

        return $resource;
    }

    public function getOne($roomId)
    {
        $sql = "select id_habitacion, id_tipo, nombre, precio, disponibilidad
                from habitacion
                where id_habitacion =?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $roomId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return null;
        }
        return $row[0];
    }

    public function getAll()
    {
        $sql = "select id_habitacion,
                th.nombre tipo_habitacion,
                h.nombre,
                precio,
                disponibilidad,
                (select count(*) from reservacion r where r.id_habitacion = h.id_habitacion) childs
                from habitacion h
                    inner join tipo_habitacion th on th.id_tipo = h.id_tipo
                order by id_habitacion desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNumChildById($roomId)
    {
        $sql = "select count(*) as childs from reservacion r where r.id_habitacion = ?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $roomId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return -1;
        }
        return $row[0]['childs'];
    }

    public function activateAvailability($roomId)
    {
        $sql = "update habitacion
        set disponibilidad = true
        where id_habitacion = ?;";

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roomId);
        $resource->execute();

        return $resource;
    }

    public function disableAvailability($roomId)
    {
        $sql = "update habitacion
        set disponibilidad = false
        where id_habitacion = ?;";

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $roomId);
        $resource->execute();

        return $resource;
    }

    public function getAvailabilityPercentage()
    {
        $sql = "select (count(*)) num, (select count(*) from habitacion) total
                from habitacion
                where disponibilidad = true;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        $num = $row[0]['num'];
        $total = $row[0]['total'];
        if (empty($row) || $total == 0) {
            return array(0, 0);
        }
        $percentageAvailable= $num / $total;
        $percentageReserved  = ($total - $num) / $total;
        return array($percentageAvailable * 100, $percentageReserved * 100, $total);
    }
}