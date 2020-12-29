<?php
require_once "../../config/loader.php";

use App\Controllers\RoomController;
use Config\Session;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Rooms</title>
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
        $roomController = new RoomController();
        $percentage = $roomController->getAvailabilityPercentage();
        ?>

        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start room content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Habitaciones</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <div class="mb-3"></div>
                                    <img class="rounded" data-bs-hover-animate="pulse" width="100%" height="100%"
                                         src="../../public/images/room.jpg" alt="">
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">Estado de habitaciones</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Reservadas<span
                                                class="float-right"><?= round($percentage[0], 2) ?>%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-danger" aria-valuenow="<?= round($percentage[0], 2) ?>"
                                             aria-valuemin="0"
                                             aria-valuemax="100" style="width: <?= round($percentage[0], 2) ?>%;"><span
                                                    class="sr-only"><?= round($percentage[0], 2) ?>%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Disponibles<span
                                                class="float-right"><?= round($percentage[1], 2) ?>%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-warning" aria-valuenow="<?= round($percentage[1], 2) ?>"
                                             aria-valuemin="0"
                                             aria-valuemax="100" style="width: <?= round($percentage[1], 2) ?>%;"><span
                                                    class="sr-only">40%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-body" style="text-align: center;">
                                            <h4 class="text-center card-title">Administrar Habitaciones</h4><img
                                                    class="rounded-circle img-fluid border rounded-pill shadow-sm"
                                                    data-bs-hover-animate="pulse"
                                                    src="../../public/images/adminRoom.png" width="50%" height="50%"
                                                    alt="Imagen no encontrada"
                                                    style="text-align: center;margin: 15px;">
                                            <a class="btn btn-primary border rounded-pill" role="button"
                                               data-bs-hover-animate="pulse"
                                               style="width: 60%;margin: 5px;text-align: center;"
                                               href="./admin-rooms.php">Administrar</a>
                                            <a class="btn btn-info border rounded-pill" role="button"
                                               data-bs-hover-animate="pulse" style="width: 60%;margin: 5px;"
                                               href="list-rooms.php">Listar</a>
                                            <a class="btn btn-success border rounded-pill" role="button"
                                               data-bs-hover-animate="pulse" style="width: 60%;margin: 5px;"
                                               href="./create-room.php">Crear</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end room content -->

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