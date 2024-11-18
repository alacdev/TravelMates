<?php

namespace Com\TravelMates\Controllers;

class CuentaController extends \Com\TravelMates\Core\BaseController {

    public function show() {        
        $data = array(
            'titulo' => 'Cuenta',
            'breadcrumb' => ['Cuenta'],
            'usuario' => $_SESSION['user']
        );

        $this->view->showViews(array('templates/header.view.php', 'cuenta.view.php', 'templates/footer.view.php'), $data);
    }

}
