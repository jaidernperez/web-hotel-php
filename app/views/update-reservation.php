<?php
require_once "../../config/loader.php";

use App\Controllers\PersonController;
use App\Controllers\ReservationController;
use App\Controllers\RoomController;
use Config\Session;
use Utilities\Hash;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Create reservation</title>
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
        $reservationId = filter_input(INPUT_GET, "id");
        $hash = filter_input(INPUT_GET, "sh");

        if (Hash::basicHash($reservationId) != $hash) {
            header("Location: ./admin-reservations.php");
        }
        $roomController = new RoomController();
        $rooms = $roomController->getAllRooms();

        $personController = new PersonController();
        $persons = $personController->getAllPersons();

        $reservationController = new ReservationController();
        $reservation = $reservationController->getOneReservation($reservationId);

        $roomSelected = $roomController->getOneRoom($reservation['id_habitacion']);
        $personSelected = $personController->getOnePerson($reservation['id_persona']);
        ?>

        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start create reservation content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Reservaciones</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
                                                                               data-bs-hover-animate="pulse"
                                                                               src="../../public/images/updateReservation.png"
                                                                               width="160" height="160" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Actualizar reservación</p>
                                        </div>
                                        <div class="card-body">
                                            <form id="form-update">
                                                <input
                                                        type="hidden"
                                                        id="id"
                                                        name="id"
                                                        value="<?= $reservationId ?>"
                                                />
                                                <input
                                                        type="hidden"
                                                        id="sh"
                                                        name="sh"
                                                        value="<?= $hash ?>"
                                                />
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="room"><strong>Habitación</strong></label>
                                                            <select class="form-control" required="" name="room"
                                                                    id="room">
                                                                <option value="<?= $roomSelected['id_habitacion'] ?>"
                                                                        selected="">
                                                                    <?= $roomSelected['nombre'] ?></option>
                                                                <?php
                                                                foreach ($rooms as $room):
                                                                    if ($room['id_habitacion'] != $roomSelected['id_habitacion'] && $room['childs'] == 0):
                                                                        ?>
                                                                        <option value="<?= $room['id_habitacion'] ?>">
                                                                            <?= $room['nombre'] ?></option>
                                                                    <?php endif; endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="person"><strong>Persona</strong><br></label><select
                                                                    class="form-control" required="" name="person"
                                                                    id="person">
                                                                <option value="<?= $personSelected['id_persona'] ?>"
                                                                        selected="">
                                                                    <?= $personSelected['nombres'] . ' ' . $personSelected['apellidos'] ?>
                                                                </option>
                                                                <?php
                                                                foreach ($persons as $person):
                                                                    if ($person['id_persona'] != $personSelected['id_persona']):
                                                                        ?>
                                                                        <option value="<?= $person['id_persona'] ?>">
                                                                            <?= $person['nombres'] . ' ' . $person['apellidos'] ?></option>
                                                                    <?php endif; endforeach; ?>
                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="startDate"><strong>Fecha
                                                                    Inicio</strong></label><input
                                                                    class="form-control" type="date" required=""
                                                                    name="startDate" id="startDate"
                                                                    value="<?= $reservation['fecha_inicio'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="endDate"><strong>Fecha
                                                                    final</strong><br></label><input
                                                                    class="form-control" type="date"
                                                                    name="endDate" id="endDate"
                                                                    value="<?= $reservation['fecha_final'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm"
                                                            data-bs-hover-animate="pulse" id="btn-submit"
                                                            type="submit">Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end create reservation content -->

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
    <script src="../../public/js/sweetalert2@10.js"></script>
    <script src="../../public/js/jquery.validate.min.js"></script>
    <script src="js/validations/put/validate-reservation-put.js"></script>
    </body>

    </html>
<?php
else:
    header("Location: ./login.php");
endif;
?>