<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/nueva-publicacion.css">
    </head>
    <body>
        <form action="/nueva-publicacion" method="post" enctype="multipart/form-data">
            <div class="imagen-publicacion">
                <input type="file" name="imagen" id="imagen" accept="image/*" required>
            </div>
            <div class="texto-publicacion">
                <textarea name="texto"></textarea>
            </div>
            <button type="submit">Publicar</button>
        </form>
    </body>
</html>
