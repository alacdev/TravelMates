<?php

namespace Com\TravelMates\Controllers;

class PublicacionController extends \Com\TravelMates\Core\BaseController {

    public function mostrarNuevaPublicacion() {  
        $this->view->showViews(array('templates/header.view.php', 'nueva-publicacion.view.php', 'templates/footer.view.php'));
    }

    public function crearNuevaPublicacion(array $post, array $files) {  
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $imgurModel = new \Com\TravelMates\Models\ImgurModel();

        $archivo = $files['imagen'];

        $post['url_img'] = $imgurModel->obtenerUrl($archivo);

        $result = $publicacionModel->nuevaPublicacion($post['url_img'], $_SESSION['user']['username'], $post['texto'], date_create('now')->format('Y-m-d H:i:s'));

        if ($result) {
            header('location:/');
        } else {
            header('location:/nueva-publicacion');
        }        
    }

    public function meGusta (int $id_usuario, int $id_publicacion) {
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $resultado = $publicacionModel->meGusta($id_usuario,$id_publicacion);
        echo json_encode(['success' => $resultado]);
    }

    public function noMeGusta (int $id_usuario, int $id_publicacion) {
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $resultado = $publicacionModel->noMeGusta($id_usuario,$id_publicacion);
        echo json_encode(['success' => $resultado]);
    }
}