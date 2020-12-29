<?php

use App\Controllers\UserController;
use App\Models\UserEntity;
use Config\Session;
use Utilities\Alert;
use Utilities\UploadImage;
use Utilities\Validate;
use Utilities\Validation\ValidateUser;

require_once "../../../config/loader.php";

$response = [];
if (!Session::isValidCredentials()) {
    header("Location: ../../views/login.php");
} else {
    if (!isset($_FILES["uploadFile"])) {
        $response["alert"] = Alert::getAlert("error", "Error", "No se pudo leer el archivo");
    } else {
        $project = explode('/', $_SERVER['REQUEST_URI'])[1];
        if($project!="app"){
            $folder = "{$_SERVER['DOCUMENT_ROOT']}/{$project}/uploads/images/";
        }else{
            $folder = "{$_SERVER['DOCUMENT_ROOT']}/uploads/images/";
        }
        $extensions = ["png", "jpg", "jpeg"];
        $uploadImage = new UploadImage($folder, 500000, $extensions, "img_");

        $result = $uploadImage->uploadFile("uploadFile");
        if ($result["status"]) {
            $userController = new UserController();
            $user = new UserEntity();
            $user->setUserId(Session::get("user"));
            $user->setImage($result["name"]);
            $result = $userController->updateImage($user);
            if($result->rowCount()==1){
                $response = [
                    "icon" => "success",
                    "title" => "Éxito",
                    "msg" => "La imágen se ha actualizado con éxito"
                ];
            }else{
                $response = [
                    "icon" => "error",
                    "title" => "Error",
                    "msg" => "La imágen no se ha actualizado"
                ];
            }
        } else {
            $response = [
                "icon" => "warning",
                "title" => "Error",
                "msg" => $result["error"]
            ];
        }
        Session::setFlashWi("msg", json_encode($response));
    }
}

header("Location: ../../views/profile.php");