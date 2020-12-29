<?php
require_once "../../config/loader.php";

use App\Controllers\UserController;
use Config\Session;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Users</title>
        <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="../../public/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="../../public/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../public/fonts/fontawesome5-overrides.min.css">
<link rel="stylesheet" href="../../public/css/animate.min.css">
    </head>

    <body id="page-top">

    <div id="wrapper">
        <?php
            $userController = new UserController();
            $userNumber = $userController->getUserNumber();
        ?>
        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start user content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Usuarios</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <div class="mb-3"></div>
                                    <img class="rounded" data-bs-hover-animate="pulse" width="100%" height="100%"
                                         src="../../public/images/userAdmin.png" alt="">
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="card shadow border-left-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col mr-2">
                                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                    <span>Número de usuarios</span>
                                                </div>
                                                <div class="text-dark font-weight-bold h5 mb-0"><span><?= $userNumber ?></span></div>
                                            </div>
                                            <div class="col-auto"><span class="fas fa-user-cog fa-2x text-gray-300"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-body" style="text-align: center;">
                                            <h4 class="text-center card-title">Administrar usuarios</h4><img
                                                    class="rounded-circle img-fluid border rounded-pill shadow-sm"
                                                    data-bs-hover-animate="pulse" src="../../public/images/user.png"
                                                    width="50%" height="50%" alt="Imagen no encontrada"
                                                    style="text-align: center;margin: 15px;">
                                            <a class="btn btn-primary border rounded-pill" role="button"
                                               data-bs-hover-animate="pulse"
                                               style="width: 60%;margin: 5px;text-align: center;"
                                               href="./admin-users.php">Administrar</a>
                                            <a class="btn btn-success border rounded-pill" role="button"
                                               data-bs-hover-animate="pulse" style="width: 60%;margin: 5px;"
                                               href="./create-user.php">Crear</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end user content -->

            </div>
            <?php require_once "../../public/footer.php"; ?>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><span class="fas fa-angle-up"></span></a>
    </div>

    <script src="../../public/js/jquery.min.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/chart.min.js"></script>
    <script src="../../public/js/bs-init.js"></script>
    <script src="../../public/js/jquery.easing.min.js"></script>
    <script src="../../public/js/theme.js"></script>
    </body>

    </html>

<?php
else:
    header("Location: ./login.php");
endif;
?>
