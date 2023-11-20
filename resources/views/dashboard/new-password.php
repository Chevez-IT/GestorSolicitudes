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
                </div>
            </div>
        </div>
        <div class="container my-3 py-3">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <form action="<?= url("/profile/update/password") ?>" method="POST">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0 font-weight-semibold text-lg">Cambio de contraseña</h6>
                                <p class="text-sm mb-1">Contraseña de acceso</p>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-dark font-weight-semibold mb-1">Cuenta: <?= $account['account_id'] ?></h6>
                                <input name="account_id" value="<?= $account['account_id']; ?>" required hidden />
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account_password">Contraseña actual</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Actual contraseña: </span>
                                                <input type="password" class="form-control" id="account_password" name="account_password" aria-describedby="basic-addon3" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label" for="new_account_password">Contraseña nueva</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Nueva contraseña: </span>
                                                <input type="password" class="form-control" id="new_account_password" name="new_account_password" aria-describedby="basic-addon3" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="confirm_new_account_password">Comprueba la contraseña nueva</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon3">Nueva contraseña: </span>
                                                <input type="password" class="form-control" id="confirm_new_account_password" name="confirm_new_account_password" aria-describedby="basic-addon3" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-body-secondary text-sm-end">
                                <button type="submit" class="btn btn-sm btn-dark">Cambiar contraseña</button>
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
                title: 'Éxito',
                text: '<?= $_SESSION['alert']['success'] ?>',
            });
            <?php unset($_SESSION['alert']['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['alert']['error'])) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Opps',
                text: '<?= $_SESSION['alert']['error'] ?>',
            });
            <?php unset($_SESSION['alert']['error']); ?>
        <?php endif; ?>
    </script>


    <!-- scripts -->
    <?php include_once './resources/views/templates/script.php'; ?>
</body>

</html>