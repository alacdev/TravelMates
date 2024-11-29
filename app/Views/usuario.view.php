<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="assets/css/cuentaeditar.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><img src="<?php echo ($usuario['url_img'] != null) ? $usuario['url_img'] : 'assets/img/defaultUser.png'; ?>" class="foto-perfil" alt="Foto de perfil de @<?php echo $usuario['username'] ?>">
                @<?php echo $usuario['username'] ?>
            </h3>
        </div>
        <div class="card-body">
            <div class="actions">
                <!-- TODO:
                    Botón solicitud amistad (AJAX)
                    Botón enviar mensaje -->
            </div>
            <div class="info-usuario">
                <h3><?php echo $usuario['nombre_completo'] ?></h3>
                <p><?php echo $usuario['residencia'] ?></p>
            </div>
            <div class="publicaciones">

            </div>
        </div>
    </div>
</body>

</html>