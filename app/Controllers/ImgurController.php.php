<?php

namespace Com\TravelMates\Controllers;

class ImgurController extends \Com\TravelMates\Core\BaseController {
    
    public function subir() {
        try {
            $client_id = 'ef85bd54003330c';

            $model = new \Com\TravelMates\Models\ImgurModel($client_id);

            // Obtener la imagen subida desde el formulario
            $ruta = $_FILES['image']['tmp_name'];

            $url = $model->obtenerUrl($ruta);

            // Responder con la URL de la imagen subida
            echo "Imagen subida exitosamente: <a href='$url'>$url</a>";
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
        }
    }
}
