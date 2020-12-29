<?php

require_once "../../../config/loader.php";

use App\Controllers\ReservationController;
use App\Controllers\RoomController;
use App\Models\ReservationEntity;
use Config\Session;
use Utilities\Hash;
use Utilities\Validate;

$response = [];

if (!Session::isValidCredentials()) {
    header("Location: ../../views/login.php");
} else {
    $reservationId = filter_input(INPUT_GET, "id");
    $hash = filter_input(INPUT_GET, "sh");

    if (Hash::basicHash($reservationId) != $hash) {
        $response = [
            "icon" => "error",
            "title" => "Error",
            "msg" => "Acción corrupta"
        ];
    } elseif (!isset($reservationId) || empty($reservationId)) {
        $response = [
            "icon" => "error",
            "title" => "Error",
            "msg" => "No se pudo completar la acción"
        ];
    } else {

        $newReservation = new ReservationEntity();
        $reservationController = new ReservationController();
        $roomController = new RoomController();

        $reservation = $reservationController->getOneReservation($reservationId);
        $room = $roomController->getOneRoom($reservation['id_habitacion']);

        try {
            $endDate = new DateTime(date('Y-m-d'));
            $startDate = new DateTime($reservation['fecha_inicio']);
        } catch (Exception $e) {
        }

        $finalPrice = $reservation['precio_total'];

        $diff = $startDate->diff($endDate)->format('%a');

        if (Validate::isEmpty($finalPrice)) {
            $finalPrice = (float)$diff * (float)$room['precio'];
            if ((int)$diff == 0) {
                $finalPrice = (float)$room['precio'];
            }
            $newReservation->setReservationId($reservationId);
            $newReservation->setRoom($room['id_habitacion']);
            $newReservation->setPerson($reservation['id_persona']);
            $newReservation->setStartDate($reservation['fecha_inicio']);
            $newReservation->setEndDate($endDate->format('Y-m-d'));
            $newReservation->setFinalPrice($finalPrice);
            $newReservation->setState(true);

            $roomController->activateAvailabilityRoom($reservation['id_habitacion']);

            $result = $reservationController->updateReservation($newReservation);

            if ($result->rowCount() == 1) {
                $response = [
                    "icon" => "success",
                    "title" => "Éxito",
                    "msg" => "El precio final de la reservación es {$finalPrice}  por {$diff} días"
                ];
            } else {
                $response = [
                    "icon" => "error",
                    "title" => "Error",
                    "msg" => "No se pudo finalizar la reservacion"
                ];
            }
        } else{
            $response = [
                "icon" => "warning",
                "title" => "Advertencia",
                "msg" => "La reservación ya está finalizada"
            ];
        }
    }
}
Session::setFlashWi("msg", json_encode($response));
header("Location: ../../views/admin-reservations.php");
