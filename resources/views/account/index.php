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
                                    <h6 class="font-weight-semibold text-lg mb-0">Cuentas actuales</h6>
                                    <p class="text-sm mb-sm-0">Cuentas de las usuarios verficados</p>
                                </div>

                                <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-primary btn-icon d-flex align-items-center mb-0 me-2" data-bs-toggle="modal" data-bs-target="#createAccountModal">
                                        <i class="fa-regular fa-building fs-6 me-2"></i>
                                        <span class="btn-inner--text">Nueva Cuenta</span>
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
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Usuario</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Correo</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Role</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Estado</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Fecha de creacion</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10 align-items-center justify-content-center text-center">Ultima modificacion</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-10"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($accounts)) : ?>
                                            <tr>
                                                <td colspan="6" class="text-center mb-0 text-sm">
                                                    <h5>Aun no hay registros</h5>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($accounts as $account) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <div class="my-auto">
                                                                <h6 class="mb-0 text-sm"><?= $account['account_id'] ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="align-items-center justify-content-center text-center">
                                                        <p class="text-sm font-weight-normal mb-0"><?= $account['account_name'] ?></p>
                                                    </td>

                                                    <td class="align-items-center justify-content-center text-center">
                                                        <p class="text-sm font-weight-normal mb-0"><?= $account['account_email'] ?></p>
                                                    </td>

                                                    <td class="align-items-center justify-content-center text-center">
                                                        <p class="text-sm font-weight-normal mb-0"><?= $account['role_name'] ?></p>
                                                    </td>

                                                    <td class="align-items-center justify-content-center text-center">
                                                        <?php if ($account['account_status'] === 'Activo') : ?>
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
                                                        <p class="text-sm font-weight-normal mb-0"><?= $account['account_creation'] ?></p>
                                                    </td>
                                                    <?php if ($account['account_modification'] === null) : ?>
                                                        <td class="align-items-center justify-content-center text-center">
                                                            <p class="text-sm font-weight-normal mb-0">Sin Modificar</p>
                                                        </td>
                                                    <?php else : ?>
                                                        <td class="align-items-center justify-content-center text-center">
                                                            <p class="text-sm font-weight-normal mb-0"><?= $account['account_modification'] ?></p>
                                                        </td>
                                                    <?php endif; ?>
                                                    <td class="align-middle text-center">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-white text-primary btn-icon mb-0 mx-3 p-0 border-0 shadow-none">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-white text-warning btn-icon mb-0 mx-3 p-0 border-0 shadow-none">
                                                                <i class="fa-solid fa-pen"></i>
                                                            </button>
                                                            <?php if ($account['account_status'] === 'Activo') : ?>
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




    <div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" action="<?= url("/account/create") ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadiendo una nueva empresa</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="account-name" class="col-form-label">Empresa</label>
                            <input type="text" class="form-control" type="text" id="account-name" name="account-name" placeholder="Fundacion Gloria Kriete" require>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancelar</button>
                        <input class="btn btn-primary" type="submit" value="Crear">
                    </div>
                </div>
            </form>
        </div>
    </div>



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