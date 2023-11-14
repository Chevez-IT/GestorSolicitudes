<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- You can also include your custom CSS file here -->
</head>
<body>

<div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="index.html">
                                <span>
                                    <h1 class="text-white">Diego Chevez 🏀</h1>
                                </span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Iniciar sesión</h4>
                                <p class="text-muted mb-4">Ingrese su dirección de correo electrónico y contraseña para
                                    acceder al panel de administración.
                                </p>
                            </div>

                            <form method="POST" action="<?= url("/user/auth") ?>">

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Dirección de correo electrónico</label>
                                  
                                    <input class="form-control" type="email" id="emailaddress" name="email"
                                        placeholder="Enter your email"
                                        value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">

                                    <?php if (isset($error['email']['message'])) { ?>
                                        <span class="error">
                                            <?php echo $error['email']['message']; ?>
                                        </span>
                                    <?php } ?>

                                </div>

                                <div class="mb-3">
                                    <a href="pages-recoverpw.html" class="text-muted float-end"><small>Ha olvidado su
                                            ¿contraseña?</small></a>
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter your password"
                                            value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    <?php if (isset($error['password']['message'])) { ?>
                                        <span class="error">
                                            <?php echo $error['password']['message']; ?>
                                        </span>
                                    <?php } ?>
                                </div>

                                <?php if (isset($status) && $status === false): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $message; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($status) && $status === true): ?>
                                    <div class="alert alert-primary">
                                        <?php echo $message; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Acuérdate de mí</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <input class="btn btn-primary" type="submit" value="Iniciar sesión">
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="<?= url("/user/account") ?>"
                                    class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add your JavaScript code here for form validation and submission
    </script>
</body>
</html>