<?php

namespace Com\TravelMates\Controllers;

class MapaController extends \Com\TravelMates\Core\BaseController
{

    public function mostrarMapa()
    {
        $this->view->showViews(['templates/header.view.php', 'mapa.view.php', 'templates/footer.view.php']);
    }

    public function obtenerMarcadores()
    {
        $model = new \Com\TravelMates\Models\MapaModel();
        $marcadores = $model->obtenerMarcadores();
        echo json_encode($marcadores);
    }

    public function nuevoMarcador()
    {
        if (isset($_SESSION['user'], $_POST['latitud'], $_POST['longitud'], $_POST['mensaje'])) {
            $id_usuario = $_SESSION['user']['id'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $mensaje = $_POST['mensaje'];

            $model = new \Com\TravelMates\Models\MapaModel();
            $resultado = $model->nuevoMarcador($id_usuario, $latitud, $longitud, $mensaje);

            echo json_encode(['status' => $resultado ? 'success' : 'error']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

}
