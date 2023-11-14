<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include_once './resources/views/templates/head.php'; ?>

<body class="g-sidenav-show  bg-gray-100">

    <main class="main-content mt-0 ps">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h2 class="font-weight-black text-dark display-6">Gestor de solicitudes</h2>
                                    <br>
                                    <p class="mb-0">¡Bienvenido de nuevo!, hay muchas cosas que hacer no tardes en acceder</p>
                                    <br>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="<?= url("/user/auth") ?>">
                                        <label>Correo</label>
                                        <div class="mb-3">
                                            <input class="form-control" type="email" id="emailaddress" name="email" placeholder="Digite su correo:" aria-label="Name" aria-describedby="name-addon">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Digite su contraseña:" aria-label="Password" aria-describedby="password-addon">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="<?= url("/user/forgot/password") ?>" class="text-xs font-weight-bold ms-auto">Forgot password</a>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-dark w-100 mt-4 mb-3">Acceder</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8" style="background-image:url('<?= assets('img/ilustrations/img1.jpg'); ?>')">
                                    <div class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h2 class="mt-3 text-dark font-weight-bold">El sistema que logra tus objetivos</h2>
                                        <h6 class="text-dark text-sm mt-5">Copyright © 2022 Corporate UI Design System by Creative Tim.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </main>


    <!-- scripts -->
    <?php include_once './resources/views/templates/script.php'; ?>
</body>

</html>