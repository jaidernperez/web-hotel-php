<?php
require_once "../../config/loader.php";

use App\Controllers\PersonController;
use App\Controllers\ReservationController;
use App\Controllers\RoomController;
use App\Controllers\UserController;
use Config\Session;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Hotel</title>
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
        $reservationController = new ReservationController();
        $roomController = new RoomController();
        $personController = new PersonController();
        $userController = new UserController();

        $reservationNumber = $reservationController->getStatePercentage()[2];
        $roomNumber = $roomController->getAvailabilityPercentage()[2];
        $personNumber = $personController->getPersonNumber();
        $userNumber = $userController->getUserNumber();

        $percentageRoom = $roomController->getAvailabilityPercentage();
        $percentageReservation = $reservationController->getStatePercentage();
        ?>

        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start index content -->
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                <span>reservaciones</span>
                                            </div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?= $reservationNumber?></span>
                                            </div>
                                        </div>
                                        <div class="col-auto"><span
                                                    class="fas fa-concierge-bell fa-2x text-gray-300"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                                <span>Habitaciones</span>
                                            </div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?= $roomNumber?></span>
                                            </div>
                                        </div>
                                        <div class="col-auto"><span
                                                    class="fas fa-bed fa-2x text-gray-300"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1">
                                                <span>Personas</span>
                                            </div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?=$personNumber ?></span></div>
                                        </div>
                                        <div class="col-auto"><span
                                                    class="fas fa-user-friends fa-2x text-gray-300"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1">
                                                <span>Usuarios</span>
                                            </div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?= $userNumber ?></span></div>
                                        </div>
                                        <div class="col-auto"><span class="fas fa-user-tie fa-2x text-gray-300"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">Estados</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Reservaciones finalizadas<span
                                                class="float-right"><?= $percentageReservation[0]?>%</span>
                                    </h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0"
                                             aria-valuemax="100" style="width: <?= $percentageReservation[0] ?>%;"><span
                                                    class="sr-only"><?= $percentageReservation[0] ?>%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Reservaciones en curso<span
                                                class="float-right">40%</span>
                                    </h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 40%;"><span
                                                    class="sr-only">40%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Habitaciones disponibles<span
                                                class="float-right">60%</span>
                                    </h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 60%;"><span
                                                    class="sr-only">60%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Habitaciones reservadas<span
                                                class="float-right">80%</span>
                                    </h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 80%;"><span
                                                    class="sr-only">80%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white bg-primary shadow">
                                        <div class="card-body">
                                            <p class="m-0">Primary</p>
                                            <p class="text-white-50 small m-0">#4e73df</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white bg-success shadow">
                                        <div class="card-body">
                                            <p class="m-0">Success</p>
                                            <p class="text-white-50 small m-0">#1cc88a</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white bg-info shadow">
                                        <div class="card-body">
                                            <p class="m-0">Info</p>
                                            <p class="text-white-50 small m-0">#36b9cc</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white bg-warning shadow">
                                        <div class="card-body">
                                            <p class="m-0">Warning</p>
                                            <p class="text-white-50 small m-0">#f6c23e</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white bg-danger shadow">
                                        <div class="card-body">
                                            <p class="m-0">Danger</p>
                                            <p class="text-white-50 small m-0">#e74a3b</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white bg-secondary shadow">
                                        <div class="card-body">
                                            <p class="m-0">Secondary</p>
                                            <p class="text-white-50 small m-0">#858796</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end index content -->

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


