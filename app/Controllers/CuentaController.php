<?php

namespace Com\TravelMates\Controllers;

class CuentaController extends \Com\TravelMates\Core\BaseController {

    public function mostrar() {        
        $data = array(
            'titulo' => 'Cuenta',
            'breadcrumb' => ['Cuenta'],
            'usuario' => $_SESSION['user']
        );

        $this->view->showViews(array('templates/header.view.php', 'cuenta.view.php', 'templates/footer.view.php'), $data);
    }

    public function actualizarCuenta(array $post) {        
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $usermodel->actualizarUsuario($_SESSION['user']['id'], $post);
        $this->mostrar();
    }

}
