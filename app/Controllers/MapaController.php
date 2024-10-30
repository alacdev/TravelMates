<?php

namespace Com\TravelMates\Controllers;

class MapaController extends \Com\TravelMates\Core\BaseController {

    public function showMapa() {
        $this->view->showViews(array('templates/header.view.php', 'mapa.view.php', 'templates/footer.view.php'));
    }

    

}
