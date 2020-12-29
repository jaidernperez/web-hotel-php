<?php
require_once "../../config/loader.php";

use App\Controllers\PersonController;
use App\Controllers\RoleController;
use Config\Session;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Create user</title>
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
        $roleController = new RoleController();
        $roles = $roleController->showRoles();

        $personController = new PersonController();
        $persons = $personController->showPersons();
        ?>

        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start create user content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Usuarios</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded mb-3 mt-4"
                                                                               src="../../public/images/createUser.png"
                                                                               width="75%" height="75%" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold text-center">Crear
                                                usuario</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="role"><strong>Rol</strong></label><select
                                                                    class="border rounded-pill form-control"
                                                                    id="role">
                                                                <option value="" selected=""
                                                                        style="font-style: italic">Seleccione un rol
                                                                </option>
                                                                <?php
                                                                foreach ($roles as $role):
                                                                    ?>
                                                                    <option value="<?= $role['id_rol'] ?>"><?= $role['nombre'] ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="person"><strong>Persona</strong><br></label><select
                                                                    class="border rounded-pill form-control"
                                                                    id="person">
                                                                <option value="12" selected=""
                                                                        style="font-style: italic">Seleccione una
                                                                    persona
                                                                </option>
                                                                <?php
                                                                foreach ($persons as $person):
                                                                    ?>
                                                                    <option value="<?= $person['id_persona'] ?>">
                                                                        <?= $person['nombres'] . ' ' . $person['apellidos'] ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="userName"><strong>Usuario</strong><br></label>
                                                            <input class="border rounded-pill form-control"
                                                                   id="userName" type="text"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="password"><strong>Contraseña</strong><br></label>
                                                            <input class="border rounded-pill form-control"
                                                                   id="password" type="password"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label
                                                                    for="confirmPassword"><strong>Confirmar
                                                                    contraseña</strong><br></label>
                                                            <input class="border rounded-pill form-control"
                                                                   id="confirmPassword" type="password"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button class="btn btn-primary border rounded-pill"
                                                            id="btn-submit" type="submit" style="width: 50%;">Crear
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
                <!-- end create user content -->

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
    <script src="./js/post/user-post.js"></script>
    </body>

    </html>
<?php
else:
    header("Location: ./login.php");
endif;
?>