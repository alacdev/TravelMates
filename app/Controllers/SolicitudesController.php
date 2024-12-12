<?php

namespace Com\TravelMates\Controllers;

use Com\TravelMates\Models\SolicitudesModel;

class SolicitudesController extends \Com\TravelMates\Core\BaseController {    

    /**
     * Muestra la pantalla de solicitudes
     *
     * @return void
     */
    public function mostrarSolicitudesRecibidas()
    {
        $solicitudesModel = new SolicitudesModel();
        $data = array(
            'solicitudesRecibidas' => $solicitudesModel->obtenerSolicitudesRecibidas($_SESSION['user']['id'])
        );
        
        $this->view->showViews(array('templates/header.view.php', 'solicitudes-recibidas.view.php', 'templates/footer.view.php'), $data);
    }
    
    /**
     * Acepta la solicitud pasada como parámetro
     *
     * @param  mixed $id_solicitud
     * @return void
     */
    public function aceptarSolicitud(int $id_solicitud) {
        $solicitudesModel = new SolicitudesModel();
        $respuesta = $solicitudesModel->aceptarSolicitud($id_solicitud);
        if ($respuesta) {
            header('location:/solicitudes-recibidas');
        } else {
            echo '<script>alert("Hubo un error al aceptar la solicitud");</script>';
        }

    }
    
    /**
     * Rechaza la solicitud pasada como parámetro
     *
     * @param  mixed $id_solicitud
     * @return void
     */
    public function rechazarSolicitud(int $id_solicitud) {
        $solicitudesModel = new SolicitudesModel();
        $respuesta = $solicitudesModel->rechazarSolicitud($id_solicitud);
        if ($respuesta) {
            header('location:/solicitudes-recibidas');
        } else {
            echo '<script>alert("Hubo un error al rechazar la solicitud");</script>';
        }
        
    }
}