<?php

require_once "../../../config/loader.php";

use App\Controllers\RoomController;
use App\Models\RoomEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Hash;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {

    $roomId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "hash");

    if (Hash::basicHash($roomId) != $hash) {
        $response["alert"] = Alert::getAlert("error", "Error", "Acción corrupta");
    } elseif (!isset($roomId) || empty($roomId)) {
        $response["alert"] = Alert::getAlert("error", "Error", "No es posible realizar esta acción");
    } else {
        $room = new RoomEntity();
        $room->setRoomId($roomId);

        $roomController = new RoomController();

        if($roomController->getNumChildById($roomId)==0){
            $result = $roomController->deleteRoom($room);

            if ($result->rowCount() == 1) {
                $response["status"] = 200;
                $response["alert"] = Alert::getAlert("success", "Éxito", "La habitación se ha eliminado correctamente");
            } else {
                $response["status"] = 500;
                $response["alert"] = Alert::getAlert("error", "Error", "La habitación no pudo ser eliminada");
            }
        }else{
            $response["status"] = 403;
            $response["alert"] = Alert::getAlert("error", "Error", "La habitación no puede ser eliminada");
        }

    }
}
echo json_encode($response);
