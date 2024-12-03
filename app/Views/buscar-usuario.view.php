<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/buscar.css">
</head>

<body>
  <div class="container mt-3">
    <div class="barra-busqueda">
      <form action="/buscar-usuario" method="POST" class="d-flex">
        <input type="text" name="busqueda" class="form-control rounded-pill" placeholder="Buscar usuarios..."
          value="<?php echo isset($_POST['busqueda']) ? $_POST['busqueda'] : '' ?>" required>
        <button type="submit" class="btn btn-primary rounded-pill">
          <i class="fa fa-search"></i>
        </button>
      </form>
    </div>
  </div>

  <div class="usuarios">
    <?php if (isset($usuariosBusqueda)) { ?>
      <div class="table-responsive">
        <table class="table align-middle mb-4">
          <tbody>
            <?php if (count($usuariosBusqueda) == 0) { ?>
              <tr>
                <td colspan="3" class="text-center text-muted">
                  No se han encontrado usuarios.
                </td>
              </tr>
            <?php } else { ?>
              <?php foreach ($usuariosBusqueda as $usuario) { ?>
                <tr class="usuario-busqueda">
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
                    <?php $amistadesModel = new \Com\TravelMates\Models\AmistadesModel();
                    if ($amistadesModel->esAmigo($usuario['id'])) { ?>
                      <button class="btn btn-success btn-sm" data-usuario-id="<?php echo $usuario['id']; ?>"
                        data-busqueda="<?php echo htmlspecialchars($_POST['busqueda']); ?>"
                        onclick="manejarSolicitud(this, 'cancelar')" onmouseover="">
                        <i class="fa fa-smile"></i>&nbsp; Amigo
                      </button>
                    <?php } else if ($usuario['solicitud_enviada']) { ?>
                        <button class="btn btn-success btn-sm" data-usuario-id="<?php echo $usuario['id']; ?>"
                          data-busqueda="<?php echo htmlspecialchars($_POST['busqueda']); ?>"
                          onclick="manejarSolicitud(this, 'cancelar')">
                          <i class="fa fa-clock"></i>&nbsp; Pendiente
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary btn-sm" data-usuario-id="<?php echo $usuario['id']; ?>"
                          data-busqueda="<?php echo htmlspecialchars($_POST['busqueda']); ?>"
                          onclick="manejarSolicitud(this, 'enviar')">
                          <i class="fa fa-paper-plane"></i>&nbsp; Enviar solicitud
                        </button>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
  </div>
  <script src="/assets/js/buscarusuario.js"></script>
</body>

</html>