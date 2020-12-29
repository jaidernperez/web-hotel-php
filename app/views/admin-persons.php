<?php
require_once "../../config/loader.php";

use App\Controllers\PersonController;
use Config\Session;
use Utilities\Hash;

if (Session::isValidCredentials()):?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Admin persons</title>
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
        $persons = $personController->getAllPersons();
        ?>
        <?php require_once "../../public/menu-left.php"; ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php require_once "../../public/header.php"; ?>

                <!-- start admin persons content -->
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Personas</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Administrar personas</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <label>Show&nbsp;<select
                                                    class="form-control form-control-sm custom-select custom-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input
                                                    type="search" class="form-control form-control-sm"
                                                    aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                 aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable" aria-describedby="Admin persons">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($persons as $person):
                                        $id = $person['id_persona'];
                                        $hash = Hash::basicHash($id);
                                        ?>
                                        <tr id="tr-<?= $hash . $id ?>">
                                            <td><?= $person['id_persona'] ?></td>
                                            <td><?= $person['nombres'] ?></td>
                                            <td><?= $person['apellidos'] ?></td>
                                            <td><?= $person['correo'] ?></td>
                                            <td><?= $person['telefono'] ?></td>
                                            <td class="text-center">
                                                <a href="./update-person.php?sh=<?= $hash ?>&&id=<?= $id ?>">
                                                        <span class="fa fa-edit btn-put" type="submit"
                                                              data-bs-hover-animate="tada"
                                                              style="color: var(--cyan);"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($person['childs'] == 0): ?>
                                                    <a data-target="#delete-<?= $id ?>" data-toggle="modal">
                                                            <span class="fa fa-trash-o"
                                                                  data-bs-hover-animate="wobble"
                                                                  style="color: var(--danger);"></span>
                                                    </a>
                                                <?php else: ?>
                                                    <a class="disabled">
                                                            <span class="fa fa-trash-o" type="submit"
                                                                  id="<?= $id ?>"
                                                                  style="color: var(--secondary);"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="delete-<?= $id ?>" aria-labelledby="title"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="title">Advertencia</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estas seguro de eliminar la persona?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar
                                                        </button>
                                                        <a class="btn btn-primary text-white btn-delete"
                                                           data-id="<?= $id ?>" data-sh="<?= $hash ?>"
                                                           data-dismiss="modal">
                                                            Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class=" row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status"
                                       aria-live="polite">Showing
                                        1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#"
                                                                              aria-label="Previous"><span
                                                            aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link"
                                                                            href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#"
                                                                     aria-label="Next"><span
                                                            aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end admin persons content -->

            </div>
            <?php require_once "../../public/footer.php"; ?>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><span
                    class="fas fa-angle-up"></span></a>
    </div>

    <script src="../../public/js/jquery.min.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/chart.min.js"></script>
    <script src="../../public/js/bs-init.js"></script>
    <script src="../../public/js/jquery.easing.min.js"></script>
    <script src="../../public/js/theme.js"></script>
    <script src="../../public/js/sweetalert2@10.js"></script>
    <script src="./js/delete/person-delete.js"></script>
    </body>

    </html>
<?php
else:
    header("Location: ./login.php");
endif;
?>