<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/inicio.css">
    </head>
    <body>
        <section class="publicaciones">
            <?php 
            $usuarioModel = new \Com\TravelMates\Models\UsuarioModel();            
            foreach ($publicaciones as $publicacion) { 
                $usuario = $usuarioModel->obtenerUsuarioPorUsername($publicacion['username']);
            ?>
            <div class="publicacion">
                <div class="publicacion-header">
                    <p><img src="<?php echo ($usuario['url_img'] != null) ? $usuario['url_img'] : 'assets/img/defaultUser.png' ?>" class="foto-perfil">@<?php echo $publicacion['username'] ?></p>
                </div>
                <div class="publicacion-body">
                    <img src="<?php echo $publicacion['url_img'] ?>" alt="Publicación de <?php echo $publicacion['username'] ?> el <?php echo $publicacion['fecha'] ?>"/>
                    <p><?php echo $publicacion['texto'] ?></p>
                </div>
                <div class="publicacion-footer">
                    <span class="acciones">
                        <a><i class="fa fa-heart"></i></a>
                        <a><i class="fa fa-comment"></i></a>                    
                    </span>                    
                    <span class="fecha"><?php echo $publicacion['fecha'] ?></span>
                </div>
            </div>
            <?php } ?>
        </section>
        <section class="boton-nueva-publicacion">
            <a href="/nueva-publicacion"><i class="fa fa-plus"></i></a>
        </section>
    </body>
</html>