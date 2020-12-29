<?php
require_once "../../config/loader.php";

use App\Controllers\RoomController;
use App\Controllers\RoomTypeController;
use Config\Session;
use Utilities\Hash;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Create room</title>
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
        $roomId = filter_input(INPUT_GET, "id");
        $hash = filter_input(INPUT_GET, "sh");

        if (Hash::basicHash($roomId) != $hash) {
            header("Location: ./admin-rooms.php");
        }

        $roomTypeController = new RoomTypeController();
        $roomController = new RoomController();

        $roomTypes = $roomTypeController->showRoomTypes();
        $room = $roomController->getOneRoom($roomId);
        $roomTypeSelected = $roomTypeController->getOneRoomType($room['id_tipo']);
        ?>

        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start create room content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Habitaciones</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
                                                                               data-bs-hover-animate="pulse"
                                                                               src="../../public/images/updateRoom.png"
                                                                               width="160" height="160" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Actualizar habitación</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <input
                                                        type="hidden"
                                                        id="id"
                                                        name="id"
                                                        value="<?= $roomId ?>"
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
                                                                    for="roomType"><strong>Tipo</strong></label><select
                                                                    class="form-control" id="roomType"
                                                                    name="roomType">
                                                                <option value="<?= $roomTypeSelected['id_tipo'] ?>"
                                                                        selected="">
                                                                    <?= $roomTypeSelected['nombre'] ?></option>
                                                                <?php foreach ($roomTypes as $roomType):
                                                                    if ($roomType['id_tipo'] != $roomTypeSelected['id_tipo']):
                                                                        ?>
                                                                        <option value="<?= $roomType['id_tipo'] ?>">
                                                                            <?= $roomType['nombre'] ?></option>
                                                                    <?php endif; endforeach; ?>
                                                            </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="name"><strong>Nombre</strong></label><input
                                                                    class="form-control" id="name" name="name"
                                                                    type="text" value="<?= $room['nombre'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="price"><strong>Precio</strong><br></label><input
                                                                    class="form-control" id="price" name="price"
                                                                    type="number" value="<?= $room['precio'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="availability"><strong>Disponibilidad</strong></label><select
                                                                    class="form-control" id="availability"
                                                                    name="availability">
                                                                <?php
                                                                if ($room['disponibilidad']):
                                                                    ?>
                                                                    <option value="true" selected="">Disponible
                                                                    </option>
                                                                    <option value="false">Reservada</option>
                                                                <?php
                                                                else:
                                                                    ?>
                                                                    <option value="false" selected="">Reservada
                                                                    </option>
                                                                    <option value="true">Disponible</option>
                                                                <?php
                                                                endif;
                                                                ?>
                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm"
                                                            id="btn-submit" name="btn-submit"
                                                            data-bs-hover-animate="pulse" type="submit">Actualizar
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
                <!-- end create room content -->

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
    <script src="./js/put/room-put.js"></script>
    </body>

    </html>
<?php
else:
    header("Location: ./login.php");
endif;
?>