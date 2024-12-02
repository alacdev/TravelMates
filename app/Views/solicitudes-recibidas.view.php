<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/buscar.css">
</head>

<body>
  <div class="solicitudes-recibidas">
    <?php if (isset($solicitudesRecibidas)) { ?>
      <div class="table-responsive">
        <table class="table align-middle mb-4">
          <tbody>
            <?php if (count($solicitudesRecibidas) == 0) { ?>
              <tr>
                <td colspan="3" class="text-center text-muted">
                  No hay solicitudes recibidas.
                </td>
              </tr>
            <?php } else { ?>
              <?php foreach ($solicitudesRecibidas as $solicitud) { ?>
                <?php $usuarioModel = new Com\TravelMates\Models\UsuarioModel();
                $usuario = $usuarioModel->obtenerUsuarioPorId($solicitud['id_emisor']) ?>
                <tr class="solicitud">
                  <td class="text-center">
                    <img
                      src="<?php echo ($usuario['url_img'] != null) ? $usuario['url_img'] : 'assets/img/defaultUser.png'; ?>"
                      alt="Foto de perfil de @<?php echo $usuario['username']; ?>" class="avatar rounded-circle">
                  </td>
                  <td>
                    <p class="mb-0 fw-bold"><?php echo $usuario['username']; ?></p>
                    <p class="mb-0 text-muted"><?php echo $usuario['nombre_completo']; ?></p>
                  </td>
                  <td class="text-end">
                    <p>
                      <a href="/aceptar-solicitud/<?php echo $solicitud['id'] ?>" class="btn btn-success mr-2"><i
                          class="fa fa-check"></i><span> &nbsp;Aceptar</span></a>
                      <a href="/rechazar-solicitud/<?php echo $solicitud['id'] ?>" class="btn btn-danger"><i
                          class="fa fa-times"></i><span> &nbsp;Rechazar</span></a>
                    </p>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
  </div>
</body>

</html>