<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/inicio.css">
    </head>
    <body>
        <section class="publicaciones">
            <?php foreach ($publicaciones as $publicacion) { ?>
            <div class="publicacion" id="<?php echo $publicacion['id'] ?>">
                <img src="<?php echo $publicacion['url_img'] ?>" alt="Publicación de <?php echo $publicacion['id_usuario'] ?> el <?php echo $publicacion['fecha'] ?>"/>
                <p><?php echo $publicacion['texto'] ?><span><?php echo $publicacion['fecha'] ?></span></p>
                <div class="acciones">
                    <a><i class="fa-solid fa-heart"></i></a>
                    <a><i class="fa-solid fa-comment"></i></a>
                    <!-- <a><i class="fa-solid fa-share"></i></a> -->
                </div>
            </div>
            <?php } ?>
        </section>
        <section class="boton-nueva-publicacion">
            <a href="/nueva-publicacion"><i class="fa fa-plus"></i></a>
        </section>
    </body>
</html>