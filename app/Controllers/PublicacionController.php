<?php

namespace Com\TravelMates\Controllers;

class PublicacionController extends \Com\TravelMates\Core\BaseController {

    public function mostrarNuevaPublicacion() {  
        $this->view->showViews(array('templates/header.view.php', 'nueva-publicacion.view.php', 'templates/footer.view.php'));
    }

    public function crearNuevaPublicacion(array $post) {  
        $model = new \Com\TravelMates\Models\PublicacionModel();
        $post['url_img'];
        bool result = $model->nuevaPublicacion($post['url_img'], $post['texto'], $post['fecha']);
        if (result) {
            header('location:/');
        } else {
            //error al publicar
            header('location:/nueva-publicacion');
        }        
    }

}