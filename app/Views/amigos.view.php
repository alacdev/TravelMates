<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/buscar.css">
</head>

<body>
    <div class="amigos">
        <?php if (isset($amigos)) { ?>
            <div class="table-responsive">
                <table class="table align-middle mb-4">
                    <tbody>
                        <?php if (count($amigos) == 0) { ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Todavía no tienes amigos.
                                </td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($amigos as $amigo) { ?>
                                <tr class="amigo">
                                    <td class="text-center">
                                        <img src="<?php echo ($amigo['url_img'] != null) ? $amigo['url_img'] : 'assets/img/defaultUser.png'; ?>"
                                            alt="Foto de perfil de @<?php echo $amigo['username']; ?>"
                                            class="avatar rounded-circle">
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-bold"><?php echo $amigo['username']; ?></p>
                                        <p class="mb-0 text-muted"><?php echo $amigo['nombre_completo']; ?></p>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-success btn-sm" data-usuario-id="<?php echo $amigo['id']; ?>"
                                            onmouseover="">
                                            <i class="fa fa-smile"></i>&nbsp; Amigo
                                        </button>
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