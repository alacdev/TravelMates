<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/nuevapublicacion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="publicaciones-container">
        <div class="publicacion">
            <form action="/nueva-publicacion" method="post" enctype="multipart/form-data">
                <div class="publicacion-header">
                    <img src="<?php echo $_SESSION['user']['url_img'] ?? 'assets/img/defaultUser.png'; ?>" class="foto-perfil">
                    <span style="font-weight: bold; " >@<?php echo $_SESSION['user']['username']; ?></span>
                </div>
                <div class="publicacion-body">
                    <div class="imagen-publicacion">
                        <label for="imagen" class="imagen-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg" required>
                        <div id="imagen-preview"></div>
                    </div>
                    <textarea name="texto" placeholder="¿Qué estás pensando?"></textarea>
                </div>
                <div class="publicacion-footer">
                    <button type="submit">Publicar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/nuevapublicacion.js"></script>
</body>
</html>