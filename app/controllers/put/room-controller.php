<?php

require_once "../../../config/loader.php";

use App\Controllers\RoomController;
use App\Models\RoomEntity;
use Utilities\Hash;
use Utilities\Validation\ValidateRoom;
use Config\Session;
use Utilities\Alert;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {

    $roomId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "sh");

    if (Hash::basicHash( $roomId) != $hash) {
        $response["alert"] = Alert::getAlert("error", "Error", "Acción corrupta");
    } else {

        $roomType = filter_input(INPUT_POST, "roomType");
        $name = filter_input(INPUT_POST, "name");
        $price = filter_input(INPUT_POST, "price");
        $availability = filter_input(INPUT_POST, "availability");

        $message = ValidateRoom::validateRoom($roomId, $roomType, $name, $price, $availability);
        if ($message != null) {
            $response["alert"] = Alert::getAlert("warning","Advertencia!", $message);
        } else {

            $room = new RoomEntity();
            $roomController = new RoomController();

            $room->setRoomId($roomId);
            $room->setRoomType($roomType);
            $room->setRoomName($name);
            $room->setPrice($price);
            $room->setAvailability($availability);

            $result = $roomController->updateRoom($room);
            if ($result->rowCount() == 1) {
                $response["status"] = 200;
                $response["alert"] = Alert::getAlert("success", "Éxito", "La habitación se ha actualizado correctamente");
            } else {
                $response["status"] = 500;
                $response["alert"] = Alert::getAlert("error", "Error", "La habitación no pudo ser actualizada");
            }
        }
    }
}
echo json_encode($response);