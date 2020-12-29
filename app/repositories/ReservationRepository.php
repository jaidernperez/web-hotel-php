<?php

namespace App\Repositories;

use App\Models\ReservationEntity;
use Config\Conn;
use PDO;

class ReservationRepository extends Conn
{
    public function show()
    {
        $sql = "select id_reservacion,
                h.nombre habitacion,
                concat(p.nombres, ' ', p.apellidos) persona,
                fecha_inicio,
                fecha_final,
                precio_total,
                estado
                from reservacion r
                    inner join habitacion h on h.id_habitacion = r.id_habitacion
                    inner join persona p on p.id_persona = r.id_persona
                    order by id_reservacion desc;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        return $resource->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(ReservationEntity $reservation)
    {
        $sql = "insert into reservacion (id_habitacion, id_persona, fecha_inicio, fecha_final, precio_total, estado)
                values (?, ?, ?, ?, ?, ?);";

        $room = $reservation->getRoom();
        $person = $reservation->getPerson();
        $startDate = $reservation->getStartDate();
        $endDate = $reservation->getEndDate();
        $finalPrice = $reservation->getFinalPrice();
        $state = $reservation->getState();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $room);
        $resource->bindParam(2, $person);
        $resource->bindParam(3, $startDate);
        $resource->bindParam(4, $endDate);
        $resource->bindParam(5, $finalPrice);
        $resource->bindParam(6, $state);

        $resource->execute();

        return $resource;
    }

    public function update(ReservationEntity $reservation)
    {
        $sql = "update reservacion
                set id_habitacion = ?,
                    id_persona    = ?,
                    fecha_inicio  = ?,
                    fecha_final   = ?,
                    precio_total  = ?,
                    estado        = ?
                where id_reservacion = ?;";

        $room = $reservation->getRoom();
        $person = $reservation->getPerson();
        $startDate = $reservation->getStartDate();
        $endDate = $reservation->getEndDate();
        $finalPrice = $reservation->getFinalPrice();
        $state = $reservation->getState();
        $reservationId = $reservation->getReservationId();

        $resource = $this->conn->prepare($sql);

        $resource->bindParam(1, $room);
        $resource->bindParam(2, $person);
        $resource->bindParam(3, $startDate);
        $resource->bindParam(4, $endDate);
        $resource->bindParam(5, $finalPrice);
        $resource->bindParam(6, $state);
        $resource->bindParam(7, $reservationId);

        $resource->execute();

        return $resource;
    }

    public function delete(ReservationEntity $reservation)
    {
        $sql = "delete
                from reservacion
                where id_reservacion = ?;";

        $reservationId = $reservation->getReservationId();

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $reservationId);
        $resource->execute();

        return $resource;
    }

    public function getOne($reservationId)
    {
        $sql = "select id_reservacion, id_habitacion, id_persona, fecha_inicio, fecha_final, precio_total, estado
                from reservacion
                where id_reservacion = ?;";

        $resource = $this->conn->prepare($sql);
        $resource->bindParam(1, $reservationId);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        if (empty($row)) {
            return null;
        }
        return $row[0];
    }

    public function getStatePercentage()
    {
        $sql = "select (count(*)) num , (select count(*) from reservacion) total
                from reservacion
                where estado = true;";

        $resource = $this->conn->prepare($sql);
        $resource->execute();

        $row = $resource->fetchAll(PDO::FETCH_ASSOC);
        $num = $row[0]['num'];
        $total = $row[0]['total'];
        if (empty($row) || $total == 0) {
            return array(0, 0);
        }
        $percentageFinalize = $num / $total;
        $percentageInProcess = ($total - $num) / $total;
        return array($percentageFinalize * 100, $percentageInProcess * 100, $total);
    }

}