<?php

require_once "../../../config/loader.php";

use App\Controllers\PersonController;
use App\Models\PersonEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Hash;
use Utilities\Validation\ValidatePerson;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {

    $personId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "sh");

    if (Hash::basicHash($personId) != $hash) {
        $response["alert"] = Alert::getAlert("error", "Error", "Acción corrupta");
    } else {
        $dni = filter_input(INPUT_POST, "dni");
        $names = filter_input(INPUT_POST, "names");
        $lastNames = filter_input(INPUT_POST, "lastNames");
        $email = filter_input(INPUT_POST, "email");
        $phone = filter_input(INPUT_POST, "phone");

        $message = ValidatePerson::validatePerson($personId, $dni, $names, $lastNames, $email, $phone);
        if ($message != null) {
            $response["alert"] = Alert::getAlert("warning","Advertencia!", $message);
        } else {

            $person = new PersonEntity();
            $personController = new PersonController();

            $person->setPersonId($personId);
            $person->setDni($dni);
            $person->setNames($names);
            $person->setLastNames($lastNames);
            $person->setEmail($email);
            $person->setPhone($phone);

            $result = $personController->updatePerson($person);

            if ($result->rowCount() == 1) {
                $response["status"] = 200;
                $response["alert"] = Alert::getAlert("success", "Éxito", "La persona se ha actualizado correctamente");
            } else {
                $response["status"] = 500;
                $response["alert"] = Alert::getAlert("error", "Error", "La persona no pudo ser actualizada");
            }
        }
    }
}
echo json_encode($response);