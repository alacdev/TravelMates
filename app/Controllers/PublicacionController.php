<?php

namespace Com\TravelMates\Controllers;

class PublicacionController extends \Com\TravelMates\Core\BaseController {

    public function mostrarNuevaPublicacion() {  
        $this->view->showViews(array('templates/header.view.php', 'nueva-publicacion.view.php', 'templates/footer.view.php'));
    }

    public function crearNuevaPublicacion(array $post, array $files) {  
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $imgurModel = new \Com\TravelMates\Models\ImgurModel();

        $imagen = $files['imagen']['tmp_name'];

        $post['url_img'] = $imgurModel->obtenerUrl($imagen);

        // Guardar la nueva publicación
        $result = $publicacionModel->nuevaPublicacion($post['url_img'], $_SESSION['user']['username'], $post['texto'], date_create('now')->format('Y-m-d H:i:s'));

        // Redirigir en función del resultado
        if ($result) {
            header('location:/');
        } else {
            // Error al publicar
            header('location:/nueva-publicacion');
        }        
    }


}