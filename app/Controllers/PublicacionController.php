<?php

namespace Com\TravelMates\Controllers;

class PublicacionController extends \Com\TravelMates\Core\BaseController {
    
    /**
     * Muetra la pantalla de subir nueva publicación
     *
     * @return void
     */
    public function mostrarNuevaPublicacion() {  
        $this->view->showViews(array('templates/header.view.php', 'nueva-publicacion.view.php', 'templates/footer.view.php'));
    }
    
    /**
     * Añade una nueva publicación a la bbdd
     *
     * @param  mixed $post
     * @param  mixed $files
     * @return void
     */
    public function crearNuevaPublicacion(array $post, array $files) {  
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $imgurModel = new \Com\TravelMates\Models\ImgurModel();

        $archivo = $files['imagen'];

        $post['url_img'] = $imgurModel->obtenerUrl($archivo);

        $result = $publicacionModel->nuevaPublicacion($post['url_img'], $_SESSION['user']['id'], $post['texto'], date_create('now')->format('Y-m-d H:i:s'));

        if ($result) {
            header('location:/');
        } else {
            header('location:/nueva-publicacion');
        }        
    }
    
    /**
     * Añade el me gusta a la tabla correspondiente
     *
     * @param  mixed $id_usuario
     * @param  mixed $id_publicacion
     * @return void
     */
    public function meGusta (int $id_usuario, int $id_publicacion) {
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $resultado = $publicacionModel->meGusta($id_usuario,$id_publicacion);
        echo json_encode(['success' => $resultado]);
    }
    
    /**
     * Elimina el me gusta de la publicacion y el usuario pasados como parámetro en la tabla me gusta
     *
     * @param  mixed $id_usuario
     * @param  mixed $id_publicacion
     * @return void
     */
    public function noMeGusta (int $id_usuario, int $id_publicacion) {
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $resultado = $publicacionModel->noMeGusta($id_usuario,$id_publicacion);
        echo json_encode(['success' => $resultado]);
    }
}