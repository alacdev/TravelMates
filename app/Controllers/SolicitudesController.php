<?php

namespace Com\TravelMates\Controllers;

use Com\TravelMates\Models\SolicitudesModel;

class SolicitudesController extends \Com\TravelMates\Core\BaseController {
    public function mostrarSolicitudesRecibidas()
    {
        $solicitudesModel = new SolicitudesModel();
        $data = array(
            'solicitudesRecibidas' => $solicitudesModel->obtenerSolicitudesRecibidas($_SESSION['user']['id'])
        );
        
        $this->view->showViews(array('templates/header.view.php', 'solicitudes-recibidas.view.php', 'templates/footer.view.php'), $data);
    }

    public function aceptarSolicitud(int $id_solicitud) {
        $solicitudesModel = new SolicitudesModel();
        $respuesta = $solicitudesModel->aceptarSolicitud($id_solicitud);
        if ($respuesta) {
            header('location:/solicitudes-recibidas');
        } else {
            echo '<script>alert("Hubo un error al aceptar la solicitud");</script>';
        }

    }

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