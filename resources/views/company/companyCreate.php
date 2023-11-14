<form method="POST" action="<?= url("/company/create") ?>">

    <div class="mb-3">
        <label for="company-name" class="form-label">Nombre de la compañia:</label>

        <input class="form-control" type="text" id="company-name" name="company-name" placeholder="Ingresa el nombre de la compañia" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" require>

        <?php if (isset($error['company-name']['message'])) { ?>
            <span class="error">
                <?php echo $error['company-name']['message']; ?>
            </span>
        <?php } ?>

    </div>

    <div class="mb-3 mb-0 text-center">
        <input class="btn btn-primary" type="submit" value="Iniciar sesión">
    </div>

</form>