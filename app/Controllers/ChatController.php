<?php

namespace Com\TravelMates\Controllers;

/**
 * ChatController
 */
class ChatController extends \Com\TravelMates\Core\BaseController
{

    /**
     * Función que muestra la pantalla de chat
     *
     * @return void
     */
    public function mostrar()
    {
        $this->view->showViews(array('templates/header.view.php', 'chat.view.php', 'templates/footer.view.php'));
    }

}

