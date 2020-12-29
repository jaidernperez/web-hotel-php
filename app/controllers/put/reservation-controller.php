<?php

require_once "../../../config/loader.php";

use App\Controllers\ReservationController;
use App\Models\ReservationEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Validate;
use Utilities\Hash;
use Utilities\Validation\ValidateReservation;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {

    $reservationId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "sh");

    if (Hash::basicHash($reservationId) != $hash) {
        $response["alert"] = Alert::getAlert("error", "Error", "Acción corrupta");
    } else {
        $room = filter_input(INPUT_POST, "room");
        $person = filter_input(INPUT_POST, "person");
        $startDate = filter_input(INPUT_POST, "startDate");
        $endDate = filter_input(INPUT_POST, "endDate");
        $finalPrice = filter_input(INPUT_POST, "finalPrice");
        $state = filter_input(INPUT_POST, "state");

        $message = ValidateReservation::validateReservation($reservationId, $room, $person, $finalPrice, $state);
        if ($message != null) {
            $response["alert"] = Alert::getAlert("error","Advertencia!", $message);
        } else {

            if (Validate::isEmpty($startDate)) {
                $startDate = date('d-m-Y');
            }

            if (Validate::isEmpty($finalPrice)) {
                $finalPrice = 0;
            }

            if (Validate::isEmpty($endDate)) {
                $endDate = null;
            }

            if ((!Validate::isEmpty($startDate) && !Validate::isEmpty($endDate)) && $startDate > $endDate) {

                $response['alert'] = Alert::getAlert("warning", "Advertencia", "La fecha de inicio no debe ser mayor que la fecha final");
            } else {

                $reservation = new ReservationEntity();
                $reservationController = new ReservationController();

                $reservation->setReservationId($reservationId);
                $reservation->setRoom($room);
                $reservation->setPerson($person);
                $reservation->setStartDate($startDate);
                $reservation->setEndDate($endDate);
                $reservation->setFinalPrice($finalPrice);
                $reservation->setState($state);

                $result = $reservationController->updateReservation($reservation);

                if ($result->rowCount() == 1) {
                    $response["status"] = 200;
                    $response["alert"] = Alert::getAlert("success", "Éxito", "La reservación se ha actualizado correctamente");
                } else {
                    $response["status"] = 500;
                    $response["alert"] = Alert::getAlert("error", "Error", "La reservación no pudo ser actualizada id: ");
                }
            }
        }
    }
}
echo json_encode($response);