<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/gestion-usuarios.css">
</head>
<body>
<div class="container mt-4">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nombre de usuario</th>
                <th>Nombre Completo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
                <tr onclick="window.location.href='/editar-usuario/<?php echo $usuario['id']; ?>'">
                    <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nombre_completo']); ?></td>
                    <td>
                        <form action="/eliminar-usuario/<?php echo $usuario['id']; ?>" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
