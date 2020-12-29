<?php

require_once "../../../config/loader.php";

use App\Controllers\UserController;
use App\Models\UserEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\Hash;
use Utilities\Validation\ValidateUser;

$response = [];
if (!Session::isValidCredentials()) {
    $response["status"] = 402;
    $response["redirect"] = "./login.php";
} else {

    $role = filter_input(INPUT_POST, "role");
    $person = filter_input(INPUT_POST, "person");
    $userName = filter_input(INPUT_POST, "userName");
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirmPassword");

    $message = ValidateUser::validate($role, $person, $userName, $password, $confirmPassword);
    if ($message != null) {
        $response["alert"] = Alert::getAlert("warning","Advertencia!", $message);
    } else {
        $user = new UserEntity();
        $userController = new UserController();

        $unique = $userController->isUniqueUsernameAndPerson($userName, $person);
        if($unique['person']==0) {
            if($unique['username']==0) {
                $newPwd = Hash::hashPwd($password);

                $user->setUserName($userName);
                $user->setPassword($newPwd);
                $user->setRole($role);
                $user->setPerson($person);

                $result = $userController->createUser($user);
                if ($result->rowCount() == 1) {
                    $response["status"] = 200;
                    $response["alert"] = Alert::getAlert("success", "Éxito", "El usuario se ha registrado correctamente");
                } else {
                    $response["status"] = 500;
                    $response["alert"] = Alert::getAlert("error", "Error", "El usuario no pudo ser creado");
                }
            }else{
                $response["status"] = 400;
                $response["alert"] = Alert::getAlert("warning", "Advertencia", "El nombre de usuario ya está en uso");
            }
        }else{
            $response["status"] = 400;
            $response["alert"] = Alert::getAlert("warning", "Advertencia", "La persona ya tiene cuenta");
        }
    }
}
echo json_encode($response);