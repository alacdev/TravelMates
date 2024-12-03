<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/inicio.css">
</head>

<body>

    <section class="boton-nueva-publicacion">
        <a href="/nueva-publicacion" title="Nueva Publicación"><i class="fa fa-plus"></i></a>
    </section>
    <?php if (isset($publicaciones)) { ?>
        <section class="publicaciones-container">
            <div class="publicaciones">
                <?php
                $usuarioModel = new \Com\TravelMates\Models\UsuarioModel();
                foreach ($publicaciones as $publicacion) {
                    $usuario = $usuarioModel->obtenerUsuarioPorId($publicacion['id_usuario']);
                    ?>
                    <div class="publicacion">
                        <div class="publicacion-header">
                            <a href="/usuario/<?php echo $usuario['id'] ?>">
                                <p><img src="<?php echo ($usuario['url_img'] != null) ? $usuario['url_img'] : 'assets/img/defaultUser.png' ?>"
                                        class="foto-perfil">@<?php echo $usuario['username'] ?></p>
                            </a>
                        </div>
                        <div class="publicacion-body">
                            <img src="<?php echo $publicacion['url_img'] ?>"
                                alt="Publicación de <?php echo $usuario['username'] ?> el <?php echo $publicacion['fecha'] ?>" />
                            <p><span
                                    style="font-weight: bold;"><?php echo $usuario['username'] ?>&nbsp;</span><?php echo $publicacion['texto'] ?>
                            </p>
                        </div>
                        <div class="publicacion-footer">
                            <span class="acciones">
                                <a href="javascript:void(0);"
                                    onclick="toggleLike(<?php echo $publicacion['id']; ?>, <?php echo $publicacion['me_gusta'] ? 'false' : 'true'; ?>)">
                                    <i id="heart-<?php echo $publicacion['id']; ?>" class="fa fa-heart" <?php echo $publicacion['me_gusta'] ? 'style="color: red;"' : ''; ?>></i>
                                </a>
                            </span>
                            <?php $controlador = new \Com\TravelMates\Controllers\InicioController(); ?>
                            <span class="fecha text-muted"><?php echo $controlador->tiempoTranscurrido($publicacion['fecha']); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
    <?php if (count($publicaciones) == 0) { ?>
        <section class="publicaciones-container">
            <p class="text-muted">Haz amistades para ver aquí sus publicaciones</p>
        </section>
    <?php } ?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/inicio.js"></script>
</body>

</html>