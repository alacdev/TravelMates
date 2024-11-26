<?php

namespace Com\TravelMates\Controllers;

class UsuarioController extends \Com\TravelMates\Core\BaseController {

    public function mostrar() {  
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuarios' => $usermodel->getAll()
        );

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }

    public function mostrarGestionUsuarios() {  
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuarios' => $usermodel->getAll()
        );

        $this->view->showViews(array('templates/header.view.php', 'gestion-usuarios.view.php', 'templates/footer.view.php'), $data);
    }

    public function mostrarBuscarUsuarios() {  
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuariosRecomendados' => $usermodel->obtenerUsuariosCompatibles($_SESSION['user']['id'])
        );

        $this->view->showViews(array('templates/header.view.php', 'buscar-usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function buscarUsuarios(array $post) {  
        string $busqueda = $post['busqueda'];
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuariosRecomendados' => $usermodel->obtenerUsuariosCompatibles($_SESSION['user']['id']),
            'usuariosBusqueda' => $usermodel->buscarUsuarios($busqueda)
        );

        $this->view->showViews(array('templates/header.view.php', 'buscar-usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function eliminarUsuario(int $id_usuario) {
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $result = $usermodel->eliminarUsuario($id_usuario); 
        if (!$result) {
            //error
        }
        header("location:/gestion-usuarios");
    }

    public function mostrarEditarUsuario(int $id_usuario) {  
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuario' => $usermodel->obtenerUsuarioPorId($id_usuario)
        );

        $this->view->showViews(array('templates/header.view.php', 'editar-usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function editarUsuario(int $id_usuario) {
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $result = $usermodel->eliminarUsuario($id_usuario); 
        if (!$result) {
            //error
        }
        header("location:/gestion-usuarios");
    }

}

