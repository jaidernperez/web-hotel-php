<?php

require_once "../../../config/loader.php";

use App\Controllers\PersonController;
use App\Models\PersonEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Validate;
use Utilities\Validation\ValidatePerson;

Session::init();
if (!Session::get("authenticated")) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {
    $dni = filter_input(INPUT_POST, "dni");
    $names = filter_input(INPUT_POST, "names");
    $lastNames = filter_input(INPUT_POST, "lastNames");
    $email = filter_input(INPUT_POST, "email");
    $phone = filter_input(INPUT_POST, "phone");

    $message = ValidatePerson::validate($dni, $names, $lastNames, $email, $phone);
    if ($message != null) {
        $response["alert"] = Alert::getAlert("warning","Advertencia!", $message);
    } else {
        $person = new PersonEntity();
        $personController = new PersonController();

        $person->setDni($dni);
        $person->setNames($names);
        $person->setLastNames($lastNames);
        $person->setEmail($email);
        $person->setPhone($phone);

        $result = $personController->createPerson($person);

        if ($result->rowCount() == 1) {
            $response["status"] = 200;
            $response["alert"] = Alert::getAlert("success", "Éxito", "La persona se ha creado correctamente");
        } else {
            $response["status"] = 500;
            $response["alert"] = Alert::getAlert("error", "Error", "La persona no pudo ser creada");
        }
    }
}
echo json_encode($response);
