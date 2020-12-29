<?php
require_once "../../config/loader.php";

use App\Controllers\PersonController;
use App\Controllers\RoomController;
use Config\Session;
use Utilities\Alert;

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
        $roomController = new RoomController();
        $rooms = $roomController->getAllRooms();

        $personController = new PersonController();
        $persons = $personController->getAllPersons();

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
                                                                               src="../../public/images/createReservation.png"
                                                                               width="160" height="160" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Crear reservación</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="../controllers/post/reservation-controller.php">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="room"><strong>Habitación</strong></label>
                                                            <select class="form-control" required="" name="room"
                                                                    id="room">
                                                                <option value="" selected=""
                                                                        style="font-style: italic">
                                                                    Seleccione una habitación
                                                                </option>
                                                                <?php
                                                                foreach ($rooms as $room):
                                                                    if ($room['childs'] == 0):
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
                                                                <option value="" selected=""
                                                                        style="font-style: italic">
                                                                    Seleccione una persona
                                                                </option>
                                                                <?php
                                                                foreach ($persons as $person):
                                                                    ?>
                                                                    <option value="<?= $person['id_persona'] ?>">
                                                                        <?= $person['nombres'] . ' ' . $person['apellidos'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="startDate"><strong>Fecha
                                                                    Inicio</strong></label><input
                                                                    class="form-control" type="date" required=""
                                                                    name="startDate" id="startDate"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="endDate"><strong>Fecha
                                                                    final</strong><br></label><input
                                                                    class="form-control" type="date"
                                                                    name="endDate" id="endDate"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="finalPrice"><strong>Precio
                                                                    final</strong></label><input
                                                                    class="form-control" type="number"
                                                                    min="10000" max="100000000"
                                                                    name="finalPrice" id="finalPrice"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="state"><strong>Estado de la
                                                                    reservación</strong><br></label><select
                                                                    class="form-control" required="" name="state"
                                                                    id="state">
                                                                <option value="" selected=""
                                                                        style="font-style: italic">
                                                                    Seleccione un estado
                                                                </option>
                                                                <option value="true">Finalizada</option>
                                                                <option value="false">En curso</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm"
                                                            data-bs-hover-animate="pulse" id="btn-submit"
                                                            type="submit">Crear
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
    <script src="./js/post/reservation-post.js"></script>
    <?php
    $msg = Session::getFlash("msg");
    if ($msg != null) {
        $msgArray = json_decode($msg);
        Alert::setAlert($msgArray->icon, $msgArray->title, $msgArray->msg);
    }
    ?>
    </body>

    </html>
<?php
else:
    header("Location: ./login.php");
endif;
?>