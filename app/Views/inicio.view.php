<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/inicio.css">
    </head>
    <body>
        <section class="layout">
            <?php foreach ($publicaciones as $publicacion) { ?>
            <div id="post">
                <img src="<?php echo $publicacion['url_img'] ?>" alt="alt"/>
                <p><?php echo $publicacion['texto'] ?><span><?php echo $publicacion['fecha'] ?></span></p>
                <div class="acciones">
                    <a><i class="fa-solid fa-heart"></i></a>
                    <a><i class="fa-solid fa-comment"></i></a>
                    <a><i class="fa-solid fa-share"></i></a>
                </div>
            </div>
            <?php } ?>
        </section>
    </body>