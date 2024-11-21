<?php

namespace Com\TravelMates\Controllers;

class ChatController extends \Com\TravelMates\Core\BaseController {

    public function show() {  
        
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios']
            );

        $this->view->showViews(array('templates/header.view.php', 'chat.view.php', 'templates/footer.view.php'), $data);
    }

}

