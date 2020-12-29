<?php
require_once "../../../config/loader.php";

use App\Controllers\ReservationController;
use App\Controllers\RoomController;
use App\Models\ReservationEntity;
use App\Models\RoomEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Hash;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {
    $reservationId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "hash");

    if (Hash::basicHash($reservationId) != $hash) {
        $response['alert'] = Alert::getAlert("error", "Error", "Acción corrupta");
    } elseif (!isset($reservationId) || empty($reservationId)) {
        $response['alert'] = Alert::getAlert("error", "Error", "No se pudo completar la acción");
    } else {
        $reservation = new ReservationEntity();
        $reservationController = new ReservationController();

        $reservation->setReservationId($reservationId);
        $reservationArray = $reservationController->getOneReservation($reservationId);

        $roomController = new RoomController();
        $roomController->activateAvailabilityRoom($reservationArray['id_habitacion']);

        $result = $reservationController->deleteReservation($reservation);

        if ($result->rowCount() == 1) {
            $response['alert'] = Alert::getAlert("success", "Éxito", "La reservación se ha eliminado correctamente");
            $response['status'] = 200;
        } else {
            $response['alert'] = Alert::getAlert("error", "Error", "No se pudo eliminar la reservación");
            $response['status'] = 500;
        }
    }
}
echo json_encode($response);