<?php
require_once "../../config/loader.php";

use App\Controllers\PersonController;
use App\Controllers\UserController;
use Config\Session;
use Utilities\Alert;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile</title>
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
        $user_id = Session::get("user");
        $userController = new UserController();
        $personController = new PersonController();

        $user = $userController->getOneUser($user_id);

        $personId = $user['id_persona'];
        $person = $personController->getOnePerson($personId);

        $hashPerson = hash("sha512", $personId);
        $hashUser = hash("sha512", $user_id);
        ?>

        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start profile content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Mi perfil</h3>
                    <div class="row mb-3">

                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <?php
                                $img = "../../public/images/avatar1.jpg";
                                if ($user["imagen"]):
                                    $img = "../../uploads/images/{$user["imagen"]}";
                                endif;
                                ?>
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
                                                                               src="<?= $img ?>"
                                                                               width="160" height="160" alt="">
                                    <form method="post" action="../controllers/put/profile-image-controller.php"
                                          enctype="multipart/form-data">
                                        <label> Seleccionar imagen </label>
                                        <a class="btn btn-secondary btn-sm"
                                           onclick="getElementById('uploadFile').click()">
                                            <span>+</span>
                                            <input id="uploadFile" name="uploadFile" type="file" required
                                                   style="display: none"/>
                                        </a>
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm" type="submit" id="btn-submit-image"
                                                    name="btn-submit-image">
                                                Actualizar foto
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Actualizar datos de usuario</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post">
                                                <div>
                                                    <input
                                                            type="hidden"
                                                            id="id-person"
                                                            name="id-person"
                                                            value="<?= $personId ?>"
                                                    />
                                                    <input
                                                            type="hidden"
                                                            id="sh-person"
                                                            name="sh-person"
                                                            value="<?= $hashPerson ?>"
                                                    />
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="username"><strong>Cedula</strong></label><input
                                                                    class="border rounded form-control" type="text"
                                                                    id="dni" minlength="5" maxlength="15"
                                                                    required="" value="<?= $person['cedula'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="username"><strong>Nombres</strong></label><input
                                                                    class="border rounded form-control" type="text"
                                                                    id="names" minlength="3" maxlength="30"
                                                                    required="" value="<?= $person['nombres'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="username"><strong>Apellidos</strong></label><input
                                                                    class="border rounded form-control" type="text"
                                                                    id="lastNames" minlength="3" maxlength="30"
                                                                    required="" value="<?= $person['apellidos'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="first_name"><strong>Correo</strong></label><input
                                                                    class="border rounded form-control" id="email"
                                                                    type="email" value="<?= $person['correo'] ?>"
                                                                    required="" minlength="2" maxlength="100"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="last_name"><strong>Teléfono</strong></label><input
                                                                    class="border rounded form-control" id="phone"
                                                                    type="tel" value="<?= $person['telefono'] ?>"
                                                                    required="" maxlength="15" minlength="10"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm"
                                                            data-bs-hover-animate="pulse"
                                                            id="btn-submit-profile" name="btn-submit-profile"
                                                            type="submit">Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Actualizar usuario</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div>
                                                    <input
                                                            type="hidden"
                                                            id="id-user"
                                                            name="id-user"
                                                            value="<?= $user_id ?>"
                                                    />
                                                    <input
                                                            type="hidden"
                                                            id="sh-user"
                                                            name="sh-user"
                                                            value="<?= $hashUser ?>"
                                                    />
                                                    <input
                                                            type="hidden"
                                                            id="user"
                                                            name="user"
                                                            value="<?= $user['nombre_usuario'] ?>"
                                                    />
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label
                                                                        for="currentPassword"><strong>Contraseña
                                                                        actual</strong></label><input
                                                                        class="form-control" type="password"
                                                                        id="currentPassword" name="currentPassword">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group"><label
                                                                        for="newPassword"><strong>Nueva
                                                                        contraseña</strong></label><input
                                                                        class="form-control" type="password"
                                                                        id="newPassword" name="newPassword"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label
                                                                        for="confirmPassword"><strong>Confirmar
                                                                        contraseña</strong></label><input
                                                                        class="form-control" type="password"
                                                                        id="confirmPassword" name="confirmPassword">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-sm" id="btn-submit-account"
                                                                name="btn-submit-account" type="submit">Actualizar
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
                <!-- end profile content -->

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
    <script src="./js/put/account-put.js"></script>
    <script src="./js/put/profile-put.js"></script>

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