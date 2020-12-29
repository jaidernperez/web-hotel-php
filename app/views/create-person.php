<?php
require_once "../../config/loader.php";

use App\Controllers\PersonController;
use Config\Session;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Create person</title>
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
        $personController = new PersonController();

        ?>
        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start create person content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Personas</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded mb-3 mt-4"
                                                                               data-bs-hover-animate="pulse"
                                                                               src="../../public/images/hotel.png"
                                                                               width="160" height="160"
                                                                               style="width: 80%;height: 70%;"
                                                                               alt=""></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold"
                                               data-bs-hover-animate="pulse">Crear
                                                persona</p>
                                        </div>
                                        <div class="card-body">
                                            <form id="form-create">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="dni"><strong>Cedula</strong></label><input
                                                                    class="border rounded form-control" type="text"
                                                                    id="dni" name="dni"">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="names"><strong>Nombres</strong></label><input
                                                                    class="border rounded form-control" type="text"
                                                                    id="names" name="names">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="lastNames"><strong>Apellidos</strong></label><input
                                                                    class="border rounded form-control" type="text"
                                                                    id="lastNames" name="lastNames"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="email"><strong>Correo</strong></label><input
                                                                    class="border rounded form-control" id="email"
                                                                    type="email" name="email"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="tel"><strong>Teléfono</strong></label><input
                                                                    class="border rounded form-control" id="phone"
                                                                    type="tel" name="phone"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm"
                                                            data-bs-hover-animate="pulse"
                                                            id="btn-submit" name="btn-submit" type="submit">Crear
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
                <!-- end create person content -->

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
    <script src="js/validations/validate-person-post.js"></script>
    </body>

    </html>
<?php
else:
    header("Location: ./login.php");
endif;
?>