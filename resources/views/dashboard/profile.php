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
        <div class="pt-7 pb-6 bg-cover" style="background: repeating-radial-gradient(circle, #55038C, #360259, #011526);"></div>
        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4">
                            <img src="https://api.lorem.space/image/face?w=150&h=150" alt="profile_image" class="w-100">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">
                                <?= $user['user_names'] . " " . $user['user_surnames'] ?>
                            </h3>
                            <p class="mb-0">
                                <?= $account['account_email'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-sm-end">
                        <form action="<?= url("/profile/update/status") ?>" method="POST">
                            <input name="user_id" value="<?= $user['user_id']; ?>" required hidden>
                            <input name="account_id" value="<?= $account['account_id']; ?>" required hidden>
                            <button type="submit" class="btn btn-sm btn-outline-danger">Desactivar cuenta</button>
                            <a href="<?= url('/profile/password/new') ?>" class="btn btn-sm btn-outline-secondary">Cambiar contraseña</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 py-3">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <form action="<?= url('/profile/update/account') ?>" method="POST">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0 font-weight-semibold text-lg">Informacion de la cuenta</h6>
                                <p class="text-sm mb-1">Informacion de acceso</p>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-dark font-weight-semibold mb-1">Cuenta: <?= $account['account_id'] ?></h6>
                                <input name="account_id" value="<?= $account['account_id']; ?>" required hidden />
                                <?php foreach ($roles as $role) : ?>
                                    <?php if ($role['role_name'] === $account['role_name']) : ?>
                                        <input name="role_id" value="<?= $role['role_id']; ?>" required hidden />
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_name">Usuario de la cuenta</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Usuario: </span>
                                                <input type="text" class="form-control" id="account_name" name="account_name" aria-describedby="basic-addon3" value="<?= $account['account_name'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_email">Correo de la cuenta</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Correo: </span>
                                                <input type="text" class="form-control" id="account_email" name="account_email" aria-describedby="basic-addon3" value="<?= $account['account_email'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary text-sm-end">
                                <button type="submit" class="btn btn-sm btn-dark">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col py-4"></div>

                <div class="col-12">
                    <div class="card border shadow-xs h-100">
                        <form action="<?= url('/profile/update/user') ?>" method="POST">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 col-9">
                                        <h6 class="mb-0 font-weight-semibold text-lg">Informacion del perfil</h6>
                                        <p class="text-sm mb-1">Informacion del usuario</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-dark font-weight-semibold mb-1">Usuario: <?= $user['user_id'] ?></h6>

                                <input name="user_id" value="<?= $user['user_id']; ?>" required hidden />
                                <input name="user_position" value="<?= $user['user_position']; ?>" required hidden />
                                <input name="user_area" value="<?= $user['user_area']; ?>" required hidden />
                                <?php foreach ($companies as $company) : ?>
                                    <?php if ($company['company_id'] === $user['company_id']) : ?>
                                        <input name="company_id" value="<?= $user['company_id']; ?>" required hidden />
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="user_names">Nombres del usuario</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Nombres: </span>
                                                <input type="text" class="form-control" id="user_names" name="user_names" aria-describedby="basic-addon3" value="<?= $user['user_names'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="user_surnames">Apellidos del usuario</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Apellidos: </span>
                                                <input type="text" class="form-control" id="user_surnames" name="user_surnames" aria-describedby="basic-addon3" value="<?= $user['user_surnames'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="user_phone">Telefono del usuario</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Telefono: </span>
                                                <input type="text" class="form-control" id="user_phone" name="user_phone" aria-describedby="basic-addon3" value="<?= $user['user_phone'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="user_address">Direccion del usuario</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Direccion: </span>
                                                <textarea class="form-control" id="user_address" name="user_address" aria-describedby="basic-addon3" required><?= $user['user_address'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary text-sm-end">
                                <button type="submit" class="btn btn-sm btn-dark">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php include_once './resources/views/templates/footer.php'; ?>
        </div>
    </main>

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


    <!-- scripts -->
    <?php include_once './resources/views/templates/script.php'; ?>
</body>

</html>