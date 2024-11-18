<?php

namespace Com\TravelMates\Controllers;

class UsuarioController extends \Com\TravelMates\Core\BaseController {

    public function show() {  
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuarios' => $usermodel->getAll()
        );

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }

}

