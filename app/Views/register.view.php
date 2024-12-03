<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Select 2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Css propio -->
    <link rel="stylesheet" href="assets/css/loginregister.css">
</head>

<body id="register" class="hold-transition register-page">
    <div class="register-box">
        <div class="logo">
            <img src="assets/img/TravelMates.png" alt="Logo TravelMates" />
        </div>
        <div class="card">
            <div class="card-body login-card-body">

                <form action="/register" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Nombre de usuario"
                            value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-at"></span>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['errores_register']['username'])) { ?>
                            <p class="login-box-msg text-danger">
                                <?php echo isset($_SESSION['errores_register']['username']) ? $_SESSION['errores_register']['username'] : '' ?>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" name="nombre_completo" class="form-control" placeholder="Nombre completo"
                            value="<?php echo isset($_POST['nombre_completo']) ? $_POST['nombre_completo'] : '' ?>"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-n"></span>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['errores_register']['nombre_completo'])) { ?>
                            <p class="login-box-msg text-danger">
                                <?php echo isset($_SESSION['errores_register']['nombre_completo']) ? $_SESSION['errores_register']['nombre_completo'] : '' ?>
                            </p>
                        <?php } ?>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo@dominio.com"
                            value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['errores_register']['email'])) { ?>
                        <p class="login-box-msg text-danger">
                            <?php echo isset($_SESSION['errores_register']['email']) ? $_SESSION['errores_register']['email'] : '' ?>
                        </p>
                    <?php } ?>
                    <div class="input-group mb-3">
                        <input type="password" name="pass" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        <?php if (isset($_SESSION['errores_register']['pass'])) { ?>
                            <p class="login-box-msg text-danger">
                                <?php echo isset($_SESSION['errores_register']['pass']) ? $_SESSION['errores_register']['pass'] : '' ?>
                            </p>
                        <?php } ?>

                        <input type="password" name="confirm_pass" class="form-control"
                            placeholder="Confirmar contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['errores_register']['confirm_pass'])) { ?>
                            <p class="login-box-msg text-danger">
                                <?php echo isset($_SESSION['errores_register']['confirm_pass']) ? $_SESSION['errores_register']['confirm_pass'] : '' ?>
                            </p>
                        <?php } ?>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="residencia" id="residencia" class="form-control" autocomplete="off"
                            placeholder="Lugar actual de residencia"
                            value="<?php echo isset($_POST['residencia']) ? $_POST['residencia'] : '' ?>" required>
                        <div id="sugerencias" class="sugerencias"></div>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-location-arrow"></span>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['errores_register']['residencia'])) { ?>
                        <p class="login-box-msg text-danger">
                            <?php echo isset($_SESSION['errores_register']['residencia']) ? $_SESSION['errores_register']['residencia'] : '' ?>
                        </p>
                    <?php } ?>
                    <div class="input-group mb-3">
                        <select id="intereses" name="intereses[]" class="form-control" multiple>
                            <?php foreach ($intereses as $interes) { ?>
                                <option value="<?php echo $interes['id'] ?>"><?php echo $interes['interes'] ?> </option>
                            <?php } ?>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-face-smile"></span>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['errores_register']['sexo'])) { ?>
                        <p class="login-box-msg text-danger">
                            <?php echo isset($_SESSION['errores_register']['sexo']) ? $_SESSION['errores_register']['sexo'] : '' ?>
                        </p>
                    <?php } ?>
                    <div class="input-group mb-3">
                        <select name="sexo" class="form-control" required>
                            <option value="hombre" <?php echo (isset($_POST['sexo']) && $_POST['sexo'] == "hombre") ? "selected" : ""; ?>>Hombre</option>
                            <option value="mujer" <?php echo (isset($_POST['sexo']) && $_POST['sexo'] == "mujer") ? "selected" : ""; ?>>Mujer</option>
                            <option value="NA" <?php echo isset($_POST['sexo']) ? "" : "selected" ?>selected>Prefiero no
                                decirlo</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-venus-mars"></span>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['errores_register']['sexo'])) { ?>
                        <p class="login-box-msg text-danger">
                            <?php echo isset($_SESSION['errores_register']['sexo']) ? $_SESSION['errores_register']['sexo'] : '' ?>
                        </p>
                    <?php } ?>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="col-5">
                                <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="mb-0">
                        <a href="/login" class="text-center">¿Ya tienes una cuenta?</a>
                    </p>
                </div>
            </div>
            <!-- /.register-card-body -->
        </div>
    </div>
    <!-- /.register-box -->

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- JS propio-->
    <script src="assets/js/register.js"></script>
</body>

</html>