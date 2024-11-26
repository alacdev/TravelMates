<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/buscar.css">
</head>
<body>
  <div class="barra-busqueda">
    <form action="/buscar-usuario" method="POST"> 
        <input type="text" name="busqueda" placeholder="Buscar..." required> 
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>  
  <div class="usuarios">
    <!-- Búsqueda -->
    <?php if (isset($usuariosBusqueda)) { ?>
        <?php foreach ($usuariosBusqueda as $usuario) { ?>
            <div class="usuario-busqueda">
                <img src="<?php echo $usuario['url_img']; ?>" alt="Foto de perfil de <?php echo $usuario['username']; ?>" class="avatar">
                <p><?php echo $usuario['username']; ?></p>
                <p><?php echo $usuario['nombre_completo']; ?></p>
            </div>
        <?php } ?>
    <?php } ?>


    <!-- Usuarios recomendados -->
    <div class="usuarios-recomendados">
        <?php foreach ($usuariosRecomendados as $usuario) { ?>
        <div class="usuario-recomendado">
            <img src="<?php echo $usuario['url_img'] ?>" alt="Foto de perfil de <?php echo $usuario['username'] ?>" class="avatar">
            <p><?php echo $usuario['username'] ?></p>
            <p><?php echo $usuario['nombre_completo'] ?></p>
        </div>
        <?php } ?>
    </div>
  </div>
</body>
</html>
