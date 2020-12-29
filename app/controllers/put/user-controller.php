<?php

use App\Controllers\UserController;
use App\Models\UserEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Validate;
use Utilities\Validation\ValidateUser;

require_once "../../../config/loader.php";

Session::init();
if (!Session::get("authenticated")) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {

    $userId = filter_input(INPUT_POST, "id");
    $hash = filter_input(INPUT_POST, "sh");
    $response = [];

    if (hash("sha512", $userId) != $hash) {

        $response["alert"] = Alert::getAlert("error", "Error", "Acción corrupta");

    } else {

        $userName = filter_input(INPUT_POST, "user");
        $currentPassword = filter_input(INPUT_POST, "currentPassword");
        $newPassword = filter_input(INPUT_POST, "newPassword");
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword");
        $response = [];

        $message = ValidateUser::validatePasswords($currentPassword, $newPassword, $confirmPassword);
        if ($message != null) {
            $response["alert"] = Alert::getAlert("warning","Advertencia!", $message);
        } else {
            $userController = new UserController();

            $userCurrent = new UserEntity();
            $newUser = new UserEntity();

            $userCurrent->setPassword(hash("sha512", $currentPassword));
            $userCurrent->setUserName($userName);

            if ($userController->loginUser($userCurrent) == null){

                $response["alert"] = Alert::getAlert("error", "Error", "La clave actual es incorrecta");

            } elseif ($newPassword != $confirmPassword){

                $response["alert"] = Alert::getAlert("error", "Error", "La clave no coinciden");
            } else {

                $newPwd = hash("sha512", $newPassword);

                $newUser->setUserId($userId);
                $newUser->setUserName($userName);
                $newUser->setPassword($newPwd);

                $result = $userController->updateLogin($newUser);
                if ($result->rowCount() == 1) {
                    $response["status"] = 200;
                    $response["alert"] = Alert::getAlert("success", "Éxito", "El usuario se ha registrado correctamente");
                } else {
                    $response["status"] = 500;
                    $response["alert"] = Alert::getAlert("error", "Error", "El usuario no pudo ser creado");
                }
            }
        }
    }
}
echo json_encode($response);