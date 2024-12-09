<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="assets/css/cuentaeditar.css">

</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Información de Perfil</h3>
        </div>
        <div class="card-body text-center">
            <form action="/actualizar-cuenta" method="POST" enctype="multipart/form-data">
                <div class="form-group" id="foto">
                    <div class="image-container">
                        <img src="<?php echo ($_SESSION['user']['url_img'] != null) ? $_SESSION['user']['url_img'] : 'assets/img/defaultUser.png'; ?>"
                            class="foto-perfil img-thumbnail" id="foto-preview"
                            alt="Foto de perfil de @<?php echo $_SESSION['user']['username'] ?>">
                    </div>


                    <label for="foto-perfil" class="btn btn-link">Cambiar foto de perfil</label>
                    <input type="file" id="foto-perfil" name="url_img" accept="image/png, image/jpeg"
                        style="display: none;">
                </div>
                <div class="form-group">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="<?php echo $_SESSION['user']['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="nombre_completo">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre_completo" name="nombre_completo"
                        value="<?php echo $_SESSION['user']['nombre_completo'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $usuario['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="residencia">Lugar actual de residencia</label>
                    <input type="text" class="form-control" id="residencia" name="residencia"
                        value="<?php echo $_SESSION['user']['residencia'] ?>">
                    <div id="sugerencias" class="sugerencias"></div>
                </div>
                <div class="form-group">
                    <label for="pass_antigua">Contraseña actual</label>
                    <input type="password" class="form-control" id="pass_antigua" name="pass_antigua">
                </div>
                <div class="form-group">
                    <label for="pass_nueva">Nueva contraseña</label>
                    <input type="password" class="form-control" id="pass_nueva" name="pass_nueva">
                </div>
                <div class="form-group">
                    <label for="confirm_pass_nueva">Confirmar nueva contraseña</label>
                    <input type="password" class="form-control" id="confirm_pass_nueva" name="confirm_pass_nueva">
                </div>
                <!-- Botón para guardar -->
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i>&nbsp;
                    Guardar</button>
            </form>
        </div>
    </div>
    <script src="assets/js/cuentaeditar.js"></script>
</body>

</html>