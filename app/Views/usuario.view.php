<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="assets/css/usuario.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><img
                    src="<?php echo ($usuario['url_img'] != null) ? $usuario['url_img'] : 'assets/img/defaultUser.png'; ?>"
                    class="foto-perfil" alt="Foto de perfil de @<?php echo $usuario['username'] ?>">
                &nbsp;@<?php echo $usuario['username'] ?>
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
                <p><i class="fa fa-map-marker-alt text-muted"></i>&nbsp; <?php echo $usuario['residencia'] ?></p>
            </div>
            <div class="intereses">
                <?php foreach ($intereses as $interes) { ?>
                    <span class="badge badge-primary"><?php echo $interes['interes'] ?></span>
                <?php } ?>
            </div>
            <?php if (count($publicaciones) > 0) { ?>
                <div class="publicaciones">
                    <?php
                    $usuarioModel = new \Com\TravelMates\Models\UsuarioModel();
                    foreach ($publicaciones as $publicacion) {
                        $usuario = $usuarioModel->obtenerUsuarioPorId($publicacion['id_usuario']);
                        ?>
                        <div class="publicacion">
                            <div class="publicacion-body">
                                <img src="<?php echo $publicacion['url_img'] ?>"
                                    alt="Publicación de <?php echo $usuario['username'] ?> el <?php echo $publicacion['fecha'] ?>" />
                                <p><?php echo $publicacion['texto'] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="no-publicaciones">
                    <p class="text-center text-muted"><i class="fa fa-images"></i> No hay publicaciones</p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>