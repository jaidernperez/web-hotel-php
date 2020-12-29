<?php

require_once "../../../config/loader.php";

use App\Controllers\PersonController;
use App\Models\PersonEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Hash;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {
    $personId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "hash");

    if (Hash::basicHash($personId) != $hash) {
        $response["alert"] = Alert::getAlert("error", "Error", "Acción corrupta");
    } elseif (!isset($personId) || empty($personId)) {
        $response["alert"] = Alert::getAlert("error", "Error", "No es posible realizar esta acción");
    } else {
        $person = new PersonEntity();
        $personController = new PersonController();

        $person->setPersonId($personId);

        if($personController->getNumChildById($personId)==0){
            $result = $personController->deletePerson($person);

            if ($result->rowCount() == 1) {
                $response["status"] = 200;
                $response["alert"] = Alert::getAlert("success", "Éxito", "La persona se ha eliminado correctamente");
            } else {
                $response["status"] = 500;
                $response["alert"] = Alert::getAlert("error", "Error", "La persona no pudo ser eliminada");
            }
        }else{
            $response["status"] = 403;
            $response["alert"] = Alert::getAlert("error", "Error", "La persona no puede ser eliminada");
        }

    }
}
echo json_encode($response);