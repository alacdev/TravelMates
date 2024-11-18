<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Perfil</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mi Perfil</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Información de Perfil</h3>
                            </div>
                            <div class="card-body">
                                <!-- Formulario para editar el perfil -->
                                <form action="profile_update.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Nombre de usuario</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['user']['username']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['user']['nombre_completo']?>" required>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user']['email']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="residencia">Lugar actual de residencia</label>
                                        <input type="text" class="form-control" id="residencia" name="residencia" value="<?php echo $_SESSION['user']['residencia']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_picture">Foto de Perfil</label><br>
                                        <img src="assets/img/profile/default.jpg" id="profile-image" class="img-thumbnail mb-3" alt="Foto de Perfil" width="150">
                                        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
