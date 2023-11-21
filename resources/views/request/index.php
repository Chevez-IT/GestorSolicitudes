<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include_once './resources/views/templates/head.php'; ?>

<body class="g-sidenav-show  bg-gray-100"></body>
<!-- sidebar -->
<?php include_once './resources/views/templates/vertical-nav.php'; ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- navbar -->
    <?php include_once './resources/views/templates/horizontal-nav.php'; ?>

    <!-- Content -->
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center mb-3">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Solicitudes actuales</h6>
                                <p class="text-sm mb-sm-0">Nivel General</p>
                            </div>

                            <div class="ms-auto d-flex">
                                <button type="button" class="btn btn-sm btn-primary btn-icon d-flex align-items-center mb-0 me-2" data-bs-toggle="modal" data-bs-target="#createRequestModal">
                                    <i class="fa-regular fa-building fs-6 me-2"></i>
                                    <span class="btn-inner--text">Nueva solicitud</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                    <i class="fa-regular fa-file-pdf fs-6 me-2"></i>
                                    <span class="btn-inner--text">PDF</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                    <i class="fa-regular fa-file-excel fs-6 me-2"></i>
                                    <span class="btn-inner--text">PDF</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10">#</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Solicitante</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Tipo Arte</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Tipo Apoyo</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Fecha entrega/final</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Encargado</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Estado</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Fecha Solicitud</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($requests)) : ?>
                                        <tr>
                                            <td colspan="8" class="text-center mb-0 text-sm">
                                                <h5>Aun no hay registros</h5>
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($requests as $request) : ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm"><?= $request['request_id'] ?></h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="align-items-center justify-content-center text-center">
                                                    <p class="text-sm font-weight-normal mb-0"><?= $request['user_id_customer'] ?></p>
                                                </td>

                                                <td class="align-items-center justify-content-center text-center">
                                                    <p class="text-sm font-weight-normal mb-0"><?= $request['request_art'] ?></p>
                                                </td>

                                                <td class="align-items-center justify-content-center text-center">
                                                    <p class="text-sm font-weight-normal mb-0"><?= $request['request_support'] ?></p>
                                                </td>

                                                <td class="align-items-center justify-content-center text-center">
                                                    <p class="text-sm font-weight-normal mb-0"><?= $request['request_final_production_date'] ?></p>
                                                </td>

                                                <td class="align-items-center justify-content-center text-center">
                                                    <p class="text-sm font-weight-normal mb-0"><?= $request['user_id_employee'] ?></p>
                                                </td>

                                                <td class="align-items-center justify-content-center text-center">
                                                    <?php if ($request['request_status'] === 'Activo') : ?>
                                                        <span class="badge badge-md border border-success border-2 text-success bg-success">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                            Activo
                                                        </span>
                                                    <?php elseif ($request['request_status'] === 'En espera') : ?>
                                                        <span class="badge badge-md border border-warning border-2 text-warning bg-warning">
                                                            <i class="fa-solid fa-ghost px-1"></i>
                                                            En espera
                                                        </span>
                                                    <?php elseif ($request['request_status'] === 'En proceso') : ?>
                                                        <span class="badge badge-md border border-primary border-2 text-primary bg-primary">
                                                            <i class="fa-solid fa-clock px-1"></i>
                                                            En proceso
                                                        </span>
                                                    <?php elseif ($request['request_status'] === 'Finalizado') : ?>
                                                        <span class="badge badge-md border border-info border-2 text-info bg-info">
                                                            <i class="fa-solid fa-calendar-check px-1"></i>
                                                            Finalizado
                                                        </span>
                                                    <?php elseif ($request['request_status'] === 'Vencido') : ?>
                                                        <span class="badge badge-md border border-danger border-2 text-danger bg-danger">
                                                            <i class="fa-solid fa-ban px-1"></i>
                                                            Vencido
                                                        </span>
                                                    <?php elseif ($request['request_status'] === 'Rechazado') : ?>
                                                        <span class="badge badge-md border border-danger border-2 text-danger bg-danger">
                                                            <i class="fa-solid fa-skull"></i>
                                                            Rechazado
                                                        </span>
                                                    <?php else : ?>
                                                        <span class="badge badge-md border border-danger border-2 text-danger bg-danger">
                                                            <i class="fa-solid fa-circle-xmark"></i>
                                                            Desconocido
                                                        </span>
                                                    <?php endif; ?>
                                                </td>


                                                <td class="align-items-center justify-content-center text-center">
                                                    <p class="text-sm font-weight-normal mb-0"><?= $request['request_creation'] ?></p>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <!-- btn informacion completa -->
                                                        <button type="submit" class="btn btn-white text-primary btn-icon mb-0 mx-3 p-0 border-0 shadow-none" data-bs-toggle="modal" data-bs-target="#detailRequestModal-<?= $request['request_id'] ?>">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>

                                                        <?php if ($request['request_status'] === 'Activo') : ?>
                                                            <!-- btn finalizar -->
                                                            <form action="<?= url("/requests/update/status") ?>" method="POST">
                                                                <input type="text" id="request_id" name="request_id" value="<?= $request['request_id'] ?>" hidden>
                                                                <input type="text" id="request_status" name="request_status" value="Finalizado" hidden>
                                                                <button type="submit" class="btn btn-white text-info btn-icon mb-0 mx-3 p-0 border-0 shadow-none"">
                                                                    <i class=" fa-solid fa-calendar-check"></i>
                                                                </button>
                                                            </form>
                                                        <?php elseif ($request['request_status'] === 'En espera') : ?>
                                                            <!-- btn asignar -->
                                                            <button type="button" class="btn btn-white text-secondary btn-icon mb-0 mx-3 p-0 border-0 shadow-none" data-bs-toggle="modal" data-bs-target="#assignRequestModal-<?= $request['request_id'] ?>">
                                                                <i class="fa-solid fa-users"></i>
                                                            </button>
                                                            <!-- btn aceptar -->
                                                            <form action="<?= url("/requests/update/status") ?>" method="POST">
                                                                <input type="text" id="request_id" name="request_id" value="<?= $request['request_id'] ?>" hidden>
                                                                <input type="text" id="request_status" name="request_status" value="Activo" hidden>
                                                                <button type="submit" class="btn btn-white text-success btn-icon mb-0 mx-3 p-0 border-0 shadow-none">
                                                                    <i class="fa-solid fa-square-check"></i>
                                                                </button>
                                                            </form>

                                                            <!-- btn rechazar -->
                                                            <form action="<?= url("/requests/update/status") ?>" method="POST">
                                                                <input type="text" id="request_id" name="request_id" value="<?= $request['request_id'] ?>" hidden>
                                                                <input type="text" id="request_status" name="request_status" value="Rechazado" hidden>
                                                                <button type="submit" class="btn btn-white text-danger btn-icon mb-0 mx-3 p-0 border-0 shadow-none">
                                                                    <i class="fa-solid fa-square-xmark"></i>
                                                                </button>
                                                            </form>

                                                        <?php elseif ($request['request_status'] === 'Finalizado') : ?>
                                                            <!-- No hay botones adicionales para Finalizado -->
                                                        <?php elseif ($request['request_status'] === 'En proceso') : ?>
                                                            <!-- No hay botones adicionales para En proceso -->
                                                        <?php elseif ($request['request_status'] === 'Vencida') : ?>
                                                            <!-- No hay botones adicionales para Vencida -->
                                                        <?php else : ?>
                                                            <!-- No hay botones adicionales para otro estado -->
                                                        <?php endif; ?>

                                                    </div>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                            <button class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</button>
                            <nav aria-label="..." class="ms-auto">
                                <ul class="pagination pagination-light mb-0">
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link font-weight-bold">1</span>
                                    </li>
                                    <li class="page-item"><a class="page-link border-0 font-weight-bold" href="javascript:;">2</a></li>
                                    <li class="page-item"><a class="page-link border-0 font-weight-bold d-sm-inline-flex d-none" href="javascript:;">3</a></li>
                                    <li class="page-item"><a class="page-link border-0 font-weight-bold" href="javascript:;">...</a></li>
                                    <li class="page-item"><a class="page-link border-0 font-weight-bold d-sm-inline-flex d-none" href="javascript:;">8</a></li>
                                    <li class="page-item"><a class="page-link border-0 font-weight-bold" href="javascript:;">9</a></li>
                                    <li class="page-item"><a class="page-link border-0 font-weight-bold" href="javascript:;">10</a></li>
                                </ul>
                            </nav>
                            <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php include_once './resources/views/templates/footer.php'; ?>
    </div>
</main>

<!-- Modal Asignar Empleado -->
<?php foreach ($requests as $request) : ?>
    <div class="modal fade" id="assignRequestModal-<?= $request['request_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= url("/request/update/employee") ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitud: <?= $request['request_id'] ?></h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" type="text" id="request_id" name="request_id" value="<?= $request['request_id'] ?>" hidden required>
                            <input type="text" class="form-control" type="text" id="request_status" name="request_status" value="Activo" hidden required>
                        </div>
                        <div class="form-group">
                            <label for="request_assessment" class="col-form-label">Comentarios:</label>
                            <textarea rows="4" cols="50" class="form-control" id="request_assessment" name="request_assessment"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="user_id_employee">Usuario a asignar:</label>
                            <select class="form-control" id="user_id_employee" name="user_id_employee" required>
                                <?php foreach ($accounts as $account) : ?>
                                    <?php if ($account['role_name'] === 'Empleado') : ?>
                                        <?php foreach ($users as $user) : ?>
                                            <?php if ($user['account_email'] === $account['account_email']) : ?>
                                                <option value="<?= $user['user_id']; ?>"><?= $user['user_names'] . " " . $user['user_surnames'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Volver</button>
                        <button type="submit" class="btn btn-dark">Asignar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Asignar Empleado -->
<?php foreach ($requests as $request) : ?>
    <div class="modal fade" id="detailRequestModal-<?= $request['request_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitud: <?= $request['request_id'] ?></h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" type="text" id="request_id" name="request_id" value="<?= $request['request_id'] ?>" hidden required>

                    <div class="row">
                        <div class="col">
                            <label for="user_id_customer" class="col-form-label">Solicitante:</label>
                            <?php foreach ($users as $user) : ?>
                                <?php if ($user['user_id'] == $request['user_id_customer']) : ?>
                                    <input type="text" class="form-control" type="text" id="user_id_customer" name="user_id_customer" value="<?= $user['user_names'] . " " . $user['user_surnames'] ?>" disabled readonly>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col">
                            <label for="request_status" class="col-form-label">Estado de la solicitud:</label>
                            <input type="text" class="form-control" type="text" id="request_status" name="requrequest_statusest_id" value="<?= $request['request_status'] ?>" disabled readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="request_art" class="col-form-label">Tipo de arte:</label>
                            <input type="text" class="form-control" type="text" id="request_art" name="request_art" value="<?= $request['request_art'] ?>" disabled readonly>

                        </div>
                        <div class="col">
                            <label for="request_support" class="col-form-label">Tipo de ayuda:</label>
                            <input type="text" class="form-control" type="text" id="request_support" name="request_support" value="<?= $request['request_support'] ?>" disabled readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Detalles sobre la solicitud:</label>
                            <textarea rows="4" cols="50" class="form-control" id="request_assessment" name="request_assessment" disabled readonly><?= $request['request_details'] ?></textarea>
                        </div>
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Proposito de la solictud:</label>
                            <textarea rows="4" cols="50" class="form-control" id="request_assessment" name="request_assessment" disabled readonly><?= $request['request_purpose'] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Archivo de referencia:</label> <br>
                            <?php if ($request['request_reference'] === null) : ?>
                                <a href="#" class="form-control btn btn-outline-secondary btn-lg disabled">Sin archivo </a>
                            <?php else : ?>
                                <a href="files_requests/<?=$request['request_reference'] ?>" download class="form-control btn btn-outline-secondary btn-lg">Descargar Archivo</a>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Comentarios extras de la solicitud:</label>
                            <?php if ($request['request_additional_comments'] === null) : ?>
                                <textarea rows="4" cols="50" class="form-control" id="request_assessment" name="request_assessment" disabled readonly>Sin contenido</textarea>
                            <?php else : ?>
                                <textarea rows="4" cols="50" class="form-control" id="request_assessment" name="request_assessment" disabled readonly><?= $request['request_additional_comments'] ?></textarea>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Fecha a realizar:</label>
                            <?php if ($request['request_production_date'] === null) : ?>
                                <input class="form-control" type="text" value="Sin contenido" id="example-date-input" disabled readonly>

                            <?php else : ?>
                                <input class="form-control" type="date" value="<?= $request['request_production_date'] ?>" id="example-date-input" disabled readonly>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Hora a realizar:</label>
                            <?php if ($request['request_production_time'] === null) : ?>
                                <input class="form-control" type="text" value="Sin contenido" id="example-date-input" disabled readonly>
                            <?php else : ?>
                                <input class="form-control" type="time" value="<?= $request['request_production_time'] ?>" id="example-time-input" disabled readonly>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Fecha de entrega:</label>
                            <input class="form-control" type="date" value="<?= $request['request_final_production_date'] ?>" id="example-date-input" disabled readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Evaluacion del encargado:</label>
                            <?php if ($request['request_assessment'] === null) : ?>
                                <textarea rows="4" cols="50" class="form-control" id="request_assessment" name="request_assessment" disabled readonly>Sin realizar</textarea>
                            <?php else : ?>
                                <textarea rows="4" cols="50" class="form-control" id="request_assessment" name="request_assessment" disabled readonly><?= $request['request_assessment'] ?></textarea>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Encargado:</label>
                            <?php if ($request['user_id_employee'] === null) : ?>
                                <input type="text" class="form-control" type="text" id="request_support" name="request_support" value="Sin registrar" disabled readonly>
                            <?php else : ?>
                                <?php foreach ($users as $user) : ?>
                                    <?php if ($user['user_id'] == $request['user_id_employee']) : ?>
                                        <input type="text" class="form-control" type="text" id="request_support" name="request_support" value="<?= $user['user_names'] . " " . $user['user_surnames'] ?>" disabled readonly> <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Fecha de solicitud:</label>
                            <input class="form-control" type="datetime-local" value="<?= $request['request_creation'] ?>" id="example-datetime-local-input" disabled readonly>
                        </div>
                        <div class="col">
                            <label for="request_assessment" class="col-form-label">Ultima evaluacion:</label>
                            <?php if ($request['request_modification'] === null) : ?>
                                <input class="form-control" type="text" value="Sin realizar" id="example-datetime-local-input" disabled readonly>
                            <?php else : ?>
                                <input class="form-control" type="datetime-local" value="<?= $request['request_modification'] ?>" id="example-datetime-local-input" disabled readonly>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Nueva solicitud -->
<div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form action="<?= url("/requests/create") ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Solicitud</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="request_art" class="col-form-label">Tipo de arte:</label>
                            <select class="form-control" id="request_art" name="request_art" data-trigger-other data-input-id="other_request_art">
                                <option value="" disabled selected hidden>Selecciona un arte: </option>
                                <option value="Arte Digital">Arte Digital</option>
                                <option value="Produccion Multimedia">Produccion Multimedia</option>
                                <option value="Cobertura de Evento">Cobertura de Evento</option>
                                <option value="Otro" data-trigger-other>Otro</option>
                            </select>
                        </div>
                        <div class="col" id="input_other_request_art">
                            <label for="other_request_art" class="col-form-label">Tipo de arte:</label>
                            <input type="text" name="other_request_art" id="other_request_art" class="form-control" placeholder="Especifique el tipo de arte que desea" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="request_support" class="col-form-label">Tipo de ayuda:</label>
                            <select class="form-control" id="request_support" name="request_support" data-trigger-other data-input-id="other_request_support">
                                <option value="" disabled selected hidden>Selecciona un tipo de ayuda</option>
                                <option value="Toma de fotografía">Toma de fotografía</option>
                                <option value="Solo grabación de vídeo (Sin editar)">Solo grabación de vídeo (Sin editar)</option>
                                <option value="Grabación y edición de vídeo (Producción completa)">Grabación y edición de vídeo (Producción completa)</option>
                                <option value="Otro" data-trigger-other>Otro</option>
                            </select>
                        </div>
                        <div class="col" id="input_other_request_support">
                            <label for="other_request_support" class="col-form-label">Otro tipo de ayuda:</label>
                            <input type="text" name="other_request_support" id="other_request_support" class="form-control" placeholder="Especifique el tipo de ayuda que desea" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="request_details" class="col-form-label">Detalles sobre la solicitud:</label>
                            <textarea rows="4" cols="50"  class="form-control" id="request_details" name="request_details" placeholder="Por favor, incluya detalles como fechas, ubicaciones, o cualquier información adicional que considere relevante para su solicitud."></textarea>
                        </div>
                        <div class="col">
                            <label for="request_purpose" class="col-form-label">Proposito de la solictud:</label>
                            <textarea rows="4" cols="50" class="form-control" id="request_purpose" name="request_purpose" placeholder="Describa brevemente la razón o el objetivo detrás de su solicitud. Esto nos ayudará a entender mejor cómo podemos ayudarlo."></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="request_reference" class="col-form-label">Archivo de referencia:</label> <br>
                            <input type="file" class="form-control" mu name="request_reference" id="request_reference" aria-describedby="basic-addon1">

                        </div>
                        <div class="col">
                            <label for="request_additional_comments" class="col-form-label">Comentarios extras de la solicitud:</label>
                            <textarea rows="4" cols="50" class="form-control" id="request_additional_comments" name="request_additional_comments" placeholder="Si hay detalles adicionales que considere importantes para la evaluación y solución de su solicitud, por favor compártalos aquí. Esto podría incluir preferencias personales o cualquier información relevante que no haya mencionado anteriormente."></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="request_production_date" class="col-form-label">Fecha a realizar:</label>
                            <input class="form-control" type="date" id="request_production_date" name="request_production_date">
                        </div>
                        <div class="col">
                            <label for="request_production_time" class="col-form-label">Hora a realizar:</label>
                            <input class="form-control" type="time" id="request_production_time" name="request_production_time">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="request_final_production_date" class="col-form-label">Fecha de entrega:</label>
                            <input class="form-control" type="date" id="request_final_production_date" name="request_final_production_date">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Volver</button>
                    <button type="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Función para manejar el cambio en los elementos select
        $('select[data-trigger-other]').change(function() {
            // Obtener el valor seleccionado
            var selectedValue = $(this).val();

            // Obtener el ID del elemento input relacionado
            var inputId = $(this).data('input-id');

            // Obtener el elemento input
            var inputElement = $('#' + inputId);

            // Habilitar o deshabilitar el input según la opción seleccionada
            if (selectedValue === 'Otro') {
                inputElement.prop('readonly', false);
            } else {
                inputElement.prop('readonly', true);
            }
        });
    });
</script>



<!-- scripts -->
<?php include_once './resources/views/templates/script.php'; ?>




<script>
    // Obtener la fecha actual
    const currentDate = new Date();

    // Establecer la fecha mínima para ser 15 días después de la fecha actual
    currentDate.setDate(currentDate.getDate() + 15);
    const minDate = currentDate.toISOString().split('T')[0];

    // Establecer la hora mínima y máxima
    const minTime = '09:00';
    const maxTime = '16:00';

    // Obtener referencias a los elementos de entrada
    const productionDateInput = document.getElementById('request_production_date');
    const productionTimeInput = document.getElementById('request_production_time');
    const finalProductionDateInput = document.getElementById('request_final_production_date');

    // Configurar las restricciones en los campos de entrada
    productionDateInput.setAttribute('min', minDate);
    productionTimeInput.setAttribute('min', minTime);
    productionTimeInput.setAttribute('max', maxTime);
    finalProductionDateInput.setAttribute('min', minDate);
</script>
<script>
    <?php if (isset($_SESSION['alert']['success'])) : ?>
        Swal.fire({
            icon: 'success',
            title: '<?= $_SESSION['alert']['title'] ?>',
            text: '<?= $_SESSION['alert']['success'] ?>',
        });
        <?php unset($_SESSION['alert']['success']); ?>
        <?php unset($_SESSION['alert']['title']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['alert']['error'])) : ?>
        Swal.fire({
            icon: 'error',
            title: '<?= $_SESSION['alert']['title'] ?>',
            text: '<?= $_SESSION['alert']['error'] ?>',
        });
        <?php unset($_SESSION['alert']['error']); ?>
        <?php unset($_SESSION['alert']['title']); ?>
    <?php endif; ?>
</script>
</body>

</html>