<?php

namespace Com\TravelMates\Controllers;

class MapaController extends \Com\TravelMates\Core\BaseController
{

    /**
     * Muestra la pantalla de mapa
     *
     * @return void
     */
    public function mostrarMapa()
    {
        $this->view->showViews(['templates/header.view.php', 'mapa.view.php', 'templates/footer.view.php']);
    }

    /**
     * Obtiene los marcadores del usuario de la sesión desde la bbdd
     *
     * @return void
     */
    public function obtenerMarcadores()
    {
        $model = new \Com\TravelMates\Models\MapaModel();
        $marcadores = $model->obtenerMarcadores();
        echo json_encode($marcadores);
    }

    /**
     * Guarda los marcadores enviados mediante POST.
     *
     * @return void
     */
    public function guardarMarcadores()
    {
        $jsonBody = file_get_contents('php://input');        
        $marcadores = json_decode($jsonBody, true);

        if (is_array($marcadores) && count($marcadores) > 0) {
            $mapaModel = new \Com\TravelMates\Models\MapaModel();

            foreach ($marcadores as $marcador) {
                if (isset($marcador['latitud'], $marcador['longitud'], $marcador['mensaje'])) {
                    $latitud = $marcador['latitud'];
                    $longitud = $marcador['longitud'];
                    $mensaje = $marcador['mensaje'];

                    $mapaModel->nuevoMarcador($_SESSION['user']['id'],$latitud, $longitud, $mensaje);
                }
            }

            echo json_encode(['status' => 'success', 'message' => 'Marcadores guardados correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
        }
    }

}
