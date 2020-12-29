<?php

require_once "../../../config/loader.php";

use App\Controllers\UserController;
use App\Models\UserEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Hash;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {

    $userId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "hash");

    if (Hash::basicHash($userId) != $hash) {
        $response["alert"] = Alert::getAlert("error", "Error", "Acción corrupta");
    } elseif (!isset($userId) || empty($userId)) {
        $response["alert"] = Alert::getAlert("error", "Error", "No es posible realizar esta acción");
    } else {
        $user = new UserEntity();
        $user->setUserId($userId);

        $userController = new UserController();
        $result = $userController->deleteUser($user);

        if ($result->rowCount() == 1) {
            $response["status"] = 200;
            $response["alert"] = Alert::getAlert("success", "Éxito", "El usuario se ha eliminado correctamente");
        } else {
            $response["status"] = 500;
            $response["alert"] = Alert::getAlert("error", "Error", "El usuario no puede ser eliminado");
        }

    }
}
echo json_encode($response);