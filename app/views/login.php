<?php
require_once "../../config/loader.php";

use Config\Session;
use Utilities\Alert;

if (Session::isValidCredentials()):
    header("Location: ./");
endif;
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../../public/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../public/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>

<body class="bg-gradient-primary" style="background: url(../../public/images/background.jpg);background-size: cover;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image"
                                 style="background-image: url(../../public/images/img_login.jpg);"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Iniciar Sesión</h4>
                                </div>
                                <form class="user" method="post" action="../controllers/post/login-controller.php">
                                    <div class="form-group"><input class="form-control form-control-user" type="text"
                                                                   id="userName" aria-describedby="emailHelp"
                                                                   placeholder="Usuario." name="userName">
                                    </div>
                                    <div class="form-group"><input class="form-control form-control-user"
                                                                   type="password" id="exampleInputPassword"
                                                                   placeholder="Password" name="password"></div>

                                    <button class="btn btn-primary btn-block text-white btn-user" type="submit">Login
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center"><a class="small" href="register.php">Crea una cuenta!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../public/js/jquery.min.js"></script>
<script src="../../public/js/bootstrap.min.js"></script>
<script src="../../public/js/chart.min.js"></script>
<script src="../../public/js/bs-init.js"></script>
<script src="../../public/js/jquery.easing.min.js"></script>
<script src="../../public/js/theme.js"></script>
<script src="../../public/js/sweetalert2@10.js"></script>
<script src="./js/put/account-put.js"></script>
<script src="./js/put/profile-put.js"></script>

<?php
$msg = Session::getFlashWi("msg");
if ($msg != null) {
    $msgArray = json_decode($msg);
    Alert::setAlert($msgArray->icon, $msgArray->title, $msgArray->msg);
}
?>
</body>

</html>