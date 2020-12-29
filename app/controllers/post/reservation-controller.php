<?php

require_once "../../../config/loader.php";

use App\Controllers\ReservationController;
use App\Controllers\RoomController;
use App\Models\ReservationEntity;
use App\Models\RoomEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Validate;
use Utilities\Validation\ValidateReservation;

$response = [];
if (!Session::isValidCredentials()) {
    header("Location: ../../views/login.php");
} else {

    $room = filter_input(INPUT_POST, "room");
    $person = filter_input(INPUT_POST, "person");
    $startDate = filter_input(INPUT_POST, "startDate");
    $endDate = filter_input(INPUT_POST, "endDate");
    $finalPrice = filter_input(INPUT_POST, "finalPrice");
    $state = filter_input(INPUT_POST, "state");

    $message = ValidateReservation::validate($room, $person, $finalPrice, $state);
    if ($message != null) {
        $response = [
            "icon" => "warning",
            "title" => "Advertencia!",
            "msg" => $message
        ];
    } else {
        if (Validate::isEmpty($startDate)) {
            $startDate = date('d-m-Y');
        }
        if (Validate::isEmpty($endDate)) {
            $endDate = null;
        }
        if (empty($finalPrice) || !isset($finalPrice)) {
            $finalPrice = 0;
        }
        if ((!Validate::isEmpty($startDate) && !Validate::isEmpty($endDate)) && strtotime($startDate) > strtotime($endDate)){
            $response = [
                "icon" => "warning",
                "title" => "Advertencia!",
                "msg" => "La fecha de inicio no debe ser mayor que la fecha final"
            ];
        } else {

            $reservation = new ReservationEntity();
            $reservationController = new ReservationController();

            $reservation->setRoom($room);
            $reservation->setPerson($person);
            $reservation->setStartDate($startDate);
            $reservation->setEndDate($endDate);
            $reservation->setFinalPrice($finalPrice);
            $reservation->setState($state);

            $roomController = new RoomController();
            $roomController->disableAvailabilityRoom($room);
            $result = $reservationController->createReservation($reservation);

            if ($result->rowCount() == 1) {
                $response = [
                    "icon" => "success",
                    "title" => "Éxito",
                    "msg" => "La reservación se ha creado correctamente"
                ];
            } else {
                $response = [
                    "icon" => "error",
                    "title" => "Error",
                    "msg" => "La reservación no pudo ser creada"
                ];
            }
        }
    }
}
Session::setFlashWi("msg", json_encode($response));
header("Location: ../../views/create-reservation.php");
