<?php

require_once "../../../config/loader.php";

use App\Controllers\UserController;
use App\Models\UserEntity;
use Config\Session;
use Utilities\Hash;

$userName = filter_input(INPUT_POST, "userName");
$password = filter_input(INPUT_POST, "password");

if (!isset($userName) || empty($userName) || (strlen($userName) < 2 || strlen($userName) > 30)
    || !isset($password) || empty($password) || (strlen($userName) < 4 || strlen($userName) > 30)) {

    $response = [
        "icon" => "warning",
        "title" => "Error",
        "msg" => "Datos incorrectos"
    ];
    Session::setFlash("msg", json_encode($response));
    header("Location: ../../views/login.php");

} else {

    $user = new UserEntity();
    $userController = new UserController();

    $newPwd = Hash::hashPwd($password);

    $user->setUserName($userName);
    $user->setPassword($newPwd);

    $user = $userController->loginUser($user);

    if ($user) {
        Session::init();
        Session::set("authenticated", true);
        Session::set("user", $user['id_usuario']);
        Session::set("key", Hash::basicHash($user['id_usuario']));
        Session::set("level", 1);
        Session::set("name", $user['nombre_usuario']);
        Session::set("time", time());
        header("Location: ../../views/");
    }else {
        $response = [
            "icon" => "warning",
            "title" => "Error",
            "msg" => "Credenciales incorrectas"
        ];
        Session::setFlash("msg", json_encode($response));
        header("Location: ../../views/login.php");
    }
}