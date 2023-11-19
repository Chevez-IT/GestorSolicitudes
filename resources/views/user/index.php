<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include_once './resources/views/templates/head.php'; ?>

<body class="g-sidenav-show  bg-gray-100">
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Usuarios actuales</h6>
                                    <p class="text-sm mb-sm-0">Nuestros usuarios verficados</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-primary btn-icon d-flex align-items-center mb-0 me-2" data-bs-toggle="modal" data-bs-target="#createUserModal">
                                        <i class="fa-regular fa-building fs-6 me-2"></i>
                                        <span class="btn-inner--text">Nuevo usuario</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                        <i class="fa-regular fa-file-pdf fs-6 me-2"></i>
                                        <span class="btn-inner--text">PDF</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                        <i class="fa-regular fa-file-excel fs-6 me-2"></i>
                                        <span class="btn-inner--text">EXCEL</span>
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
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Nombre</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Compañia</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Estado</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Fecha de creacion</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Ultima modificacion</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($users)) : ?>
                                            <tr>
                                                <td colspan="11" class="text-center mb-0 text-sm">
                                                    <h5>Aun no hay registros</h5>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($users as $user) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <div class="my-auto">
                                                                <h6 class="mb-0 text-sm"><?= $user['user_id'] ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="align-items-center justify-content-center text-center">
                                                        <p class="text-sm font-weight-normal mb-0"><?= $user['user_names'] . " " . $user['user_surnames'] ?></p>
                                                    </td>

                                                    <td class="align-items-center justify-content-center text-center">
                                                        <p class="text-sm font-weight-normal mb-0"><?= $user['company_name'] ?></p>
                                                    </td>

                                                    <td class="align-items-center justify-content-center text-center">
                                                        <?php if ($user['user_status'] === 'Activo') : ?>
                                                            <span class="badge badge-md border border-success border-2 text-success bg-success">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                                Activo
                                                            </span>
                                                        <?php else : ?>
                                                            <span class="badge badge-md border border-danger border-2 text-danger bg-danger">
                                                                <i class="fa-solid fa-circle-xmark"></i>
                                                                Inactivo
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-items-center justify-content-center text-center">
                                                        <p class="text-sm font-weight-normal mb-0"><?= $user['user_creation'] ?></p>
                                                    </td>
                                                    <?php if ($user['user_modification'] === null) : ?>
                                                        <td class="align-items-center justify-content-center text-center">
                                                            <p class="text-sm font-weight-normal mb-0">Sin Modificar</p>
                                                        </td>
                                                    <?php else : ?>
                                                        <td class="align-items-center justify-content-center text-center">
                                                            <p class="text-sm font-weight-normal mb-0"><?= $user['user_modification'] ?></p>
                                                        </td>
                                                    <?php endif; ?>
                                                    <td class="align-middle text-center">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="submit" class="btn btn-white text-primary btn-icon mb-0 mx-3 p-0 border-0 shadow-none" data-bs-toggle="modal" data-bs-target="#detailUserModal-<?= $user['user_id'] ?>">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-white text-warning btn-icon mb-0 mx-3 p-0 border-0 shadow-none">
                                                                <i class="fa-solid fa-pen"></i>
                                                            </button>
                                                            <?php if ($user['user_status'] === 'Activo') : ?>
                                                                <button type="button" class="btn btn-white text-danger btn-icon mb-0 mx-3 p-0 border-0 shadow-none">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            <?php else : ?>
                                                                <button type="button" class="btn btn-white text-success btn-icon mb-0 mx-3 p-0 border-0 shadow-none">
                                                                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                                                                </button>
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




    <!-- Modal crear usuario -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="users/create">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="account-name" class="col-form-label">Nombres:</label>
                                <input type="text" class="form-control" type="text" id="user_names" name="user_names" required>
                            </div>
                            <div class="col">
                                <label for="account-name" class="col-form-label">Apellidos:</label>
                                <input type="text" class="form-control" type="text" id="user_surnames" name="user_surnames" required>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="account-name" class="col-form-label">Correo:</label>
                                <input type="text" class="form-control" type="text" id="account_email" name="account_email" required>
                            </div>
                            <div class="col">
                                <label for="account-name" class="col-form-label">Telefono:</label>
                                <input type="text" class="form-control" type="text" id="user_phone" name="user_phone" required>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="message-text" class="col-form-label">Direccion:</label>
                                <textarea class="form-control" id="user_address" name="user_address"></textarea>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="company_id" class="col-form-label">Compañia</label>
                                <select class="form-control" id="company_id" name="company_id" required>
                                    <?php foreach ($companies as $company) : ?>
                                        <option selected value="<?= $company['company_id'] ?>"><?= $company['company_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="role_id" class="col-form-label">Rol:</label>
                                <select class="form-control" id="role_id" name="role_id" required>
                                    <?php foreach ($roles as $role) : ?>
                                        <option selected value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="account-name" class="col-form-label">Posicion:</label>
                                <input type="text" class="form-control" type="text" id="user_position" name="user_position" required>
                            </div>
                            <div class="col">
                                <label for="account-name" class="col-form-label">Area:</label>
                                <input type="text" class="form-control" type="text" id="user_area" name="user_area" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal detalles cuenta -->
    <?php foreach ($users as $user) : ?>
        <div class="modal fade" id="detailUserModal-<?= $user['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Usuario: <?= $user['user_id'] ?></h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user-name" class="col-form-label">Nombres:</label>
                            <input type="text" class="form-control" disabled type="text" id="user_name" name="user-name" value="<?= $user['user_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="user-name" class="col-form-label">Correo asociado:</label>
                            <input type="text" class="form-control" disabled type="text" id="user_email" name="user_email" value="<?= $user['user_email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="user-name" class="col-form-label">Rol asociado:</label>
                            <input type="text" class="form-control" disabled type="text" id="role_name" name="role_name" value="<?= $user['role_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="user-name" class="col-form-label">Estado actual:</label>
                            <input type="text" class="form-control" disabled type="text" id="user-status" name="user-status" value="<?= $user['user_status'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="user-name" class="col-form-label">Fecha de creacion:</label>
                            <input type="text" class="form-control" disabled type="text" id="user-creation" name="user-creation" value="<?= $user['user_creation'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="user-name" class="col-form-label">Ultima modificacion:</label>
                            <?php if (empty($user['user_modification'])) : ?>
                                <input type="text" class="form-control" disabled type="text" id="user-creation" name="user-creation" value="No ha sido modificado">
                            <?php else : ?>
                                <input type="text" class="form-control" disabled type="text" id="user-creation" name="user-creation" value="<?= $user['user_modification'] ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Volver</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>



    <script>
        // Verificar si hay un mensaje de éxito en la sesión
        <?php if (isset($_SESSION['success'])) : ?>
            // Mostrar SweetAlert2 con el mensaje
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '<?= $_SESSION['success'] ?>',
            });

            // Eliminar la variable de sesión
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </script>

    <!-- scripts -->
    <?php include_once './resources/views/templates/script.php'; ?>
</body>

</html>