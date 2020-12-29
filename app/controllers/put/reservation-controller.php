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

        $message = ValidateReservation::validateReservation($reservationId, $room, $person);
        if ($message != null) {
            $response["alert"] = Alert::getAlert("error", "Advertencia!", $message);
        } else {

            if (Validate::isEmpty($startDate)) {
                $startDate = date('d-m-Y');
            }

            if (Validate::isEmpty($endDate)) {
                $endDate = null;
            }

            if ((!Validate::isEmpty($startDate) && !Validate::isEmpty($endDate)) && $startDate > $endDate) {

                $response['alert'] = Alert::getAlert("warning", "Advertencia", "La fecha de inicio no debe ser mayor que la fecha final");
            } else {
                $reservation = new ReservationEntity();
                $reservationController = new ReservationController();

                $reservationObj = $reservationController->getOneReservation($reservationId);
                $reservation->setReservationId($reservationObj['id_reservacion']);
                $reservation->setRoom($room);
                $reservation->setPerson($person);
                $reservation->setStartDate($startDate);
                $reservation->setEndDate($endDate);
                $reservation->setState($reservationObj['estado']);
                $reservation->setFinalPrice($reservationObj['precio_total']);

                $result = $reservationController->updateReservation($reservation);

                if ($result->rowCount() == 1) {
                    $response["status"] = 200;
                    $response["alert"] = Alert::getAlert("success", "Éxito", "La reservación se ha actualizado correctamente");
                } else {
                    $response["status"] = 500;
                    $response["alert"] = Alert::getAlert("error", "Error", "La reservación no pudo ser actualizada");
                }
            }
        }
    }
}
echo json_encode($response);