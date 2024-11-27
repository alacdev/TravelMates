<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="assets/css/cuentaeditar.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editando @<?php echo $usuario['username'] ?></h3>
        </div>
        <div class="card-body">
            <form action="/editar-usuario/<?php echo $usuario['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group" id="foto">
                    <img src="<?php echo ($_SESSION['user']['url_img'] != null) ? $_SESSION['user']['url_img'] : 'assets/img/defaultUser.png'; ?>"
                        class="foto-perfil img-thumbnail" id="foto-preview" alt="Foto de perfil de @<?php echo $_SESSION['user']['username']?>">

                    <label for="foto-perfil" class="btn btn-link">Cambiar foto de perfil</label>
                    <input type="file" id="foto-perfil" name="url_img" accept="image/*" style="display: none;">
                </div>
                <div class="form-group">
                    <label for="name">Nombre de usuario</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo $usuario['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo $usuario['nombre_completo'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $usuario['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="residencia">Lugar actual de residencia</label>
                    <input type="text" class="form-control" id="residencia" name="residencia"
                        value="<?php echo $usuario['residencia'] ?>">
                </div>
                <div class="form-group">
                    <label for="pass">Cambiar contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Nueva contraseña">
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i>&nbsp; Guardar cambios</button>
            </form>
        </div>
    </div>
    <script src="assets/js/cuentaeditar.js"></script>
</body>
</html>