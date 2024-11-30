<?php

namespace Com\TravelMates\Controllers;

use Com\TravelMates\Models\InteresesModel;

class UsuarioController extends \Com\TravelMates\Core\BaseController
{
    public function mostrarUsuario(int $idUsuario)
    {
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuario' => $usermodel->obtenerUsuarioPorId($idUsuario),
            'publicaciones' => $publicacionModel->obtenerPublicacionesPorIdUsuario($idUsuario) 
        );

        $this->view->showViews(array('templates/header.view.php', 'usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function mostrarGestionUsuarios()
    {
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuarios' => $usermodel->obtenerTodos()
        );

        $this->view->showViews(array('templates/header.view.php', 'gestion-usuarios.view.php', 'templates/footer.view.php'), $data);
    }

    public function mostrarBuscarUsuarios()
    {
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'usuariosRecomendados' => $usermodel->obtenerUsuariosCompatibles($_SESSION['user']['id'])
        );

        $this->view->showViews(array('templates/header.view.php', 'buscar-usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function buscarUsuarios(array $post)
    {
        $userModel = new \Com\TravelMates\Models\UsuarioModel();
        $amistadesModel = new \Com\TravelMates\Models\AmistadesModel();
        $busqueda = $post['busqueda'];
        $usuariosBusqueda = $userModel->buscarUsuarios($_SESSION['user']['id'], $busqueda);
        foreach ($usuariosBusqueda as &$usuario) {
            $usuario['solicitud_enviada'] = $amistadesModel->verificarSolicitud($_SESSION['user']['id'], $usuario['id']);
        }

        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuariosRecomendados' => $userModel->obtenerUsuariosCompatibles($_SESSION['user']['id']),
            'usuariosBusqueda' => $usuariosBusqueda
        );
        
        $this->view->showViews(array('templates/header.view.php', 'buscar-usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function enviarSolicitudAmistad(int $id_receptor)
    {
        $model = new \Com\TravelMates\Models\AmistadesModel();
        $resultado = $model->enviarSolicitudAmistad($_SESSION['user']['id'], $id_receptor);
        echo json_encode(['success' => $resultado]);
    }

    public function cancelarSolicitudAmistad(int $id_receptor)
    {
        $model = new \Com\TravelMates\Models\AmistadesModel();
        $resultado = $model->cancelarSolicitudAmistad($_SESSION['user']['id'], $id_receptor);
        echo json_encode(['success' => $resultado]);
    }

    public function eliminarUsuario(int $id_usuario)
    {
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $result = $usermodel->eliminarUsuario($id_usuario);
        if (!$result) {
            //error
        } else {
            $interesesModel = new InteresesModel();
            $interesesModel->eliminarInteresesUsuario($id_usuario);
        }
        header("location:/gestion-usuarios");
    }

    public function mostrarEditarUsuario(int $id_usuario)
    {
        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Gestión de usuarios'],
            'usuario' => $usermodel->obtenerUsuarioPorId($id_usuario)
        );

        $this->view->showViews(array('templates/header.view.php', 'editar-usuario.view.php', 'templates/footer.view.php'), $data);
    }

    public function editarUsuario(int $id_usuario, array $post, array $files)
    {
        if (!empty($files['url_img']['tmp_name'])) {
            $imgurModel = new \Com\TravelMates\Models\ImgurModel();
            $post['url_img'] = $imgurModel->obtenerUrl($files['url_img']);
        }

        $usermodel = new \Com\TravelMates\Models\UsuarioModel();
        $usuario = $usermodel->obtenerUsuarioPorId($id_usuario);
        $errores = $this->checkFormEditarUsuario($usuario, $post);

        if (count($errores) == 0) {
            if (empty($post['pass'])) {
                unset($post['pass']);
            }
            $result = $usermodel->actualizarUsuario($id_usuario, $post);
            if ($result) {
                header("Location: /editar-usuario/" . $id_usuario);
            }
        }
    }

    private function checkFormEditarUsuario(array $usuario, array $post): array
    {
        $userModel = new \Com\TravelMates\Models\UsuarioModel();
        $errores = [];

        if (empty($post['username'])) {
            $errores['username'] = 'Debe introducir un nombre de usuario.';
        } else
            if (!preg_match('/^[a-zA-Z0-9]{1,20}$/', $_POST['username'])) {
                $errores['username'] = 'El nombre de usuario debe contener únicamente letras y/o números.';
            } else
                if ($userModel->obtenerUsuarioPorUsername($post['username']) != null && $post['username'] != $usuario['username']) {
                    $errores['username'] = 'El nombre de usuario ya está en uso.';
                }

        if (empty($post['nombre_completo'])) {
            $errores['nombre_completo'] = 'Debe introducir un nombre.';
        } else
            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/u', $_POST['nombre_completo'])) {
                $errores['nombre_completo'] = 'El nombre debe contener únicamente letras, incluyendo acentos, la letra ñ y espacios.';
            }

        if (empty($post['email'])) {
            $errores['email'] = 'Debe introducir un email.';
        } else
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'Debe introducir un email válido.';
            } else
                if ($userModel->obtenerUsuarioPorEmail($post['email']) != null && $post['email'] != $usuario['email']) {
                    $errores['email'] = 'El email ya está en uso.';
                }

        if (!empty($post['pass'])) {
            if (!preg_match('/^ (?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $post['pass_antigua'])) {
                $errores['pass'] = 'La contraseña debe contener un mínimo de 7 caracteres, una mayúscula, una minúscula y un número.';
            }
        }

        if (empty($post['residencia'])) {
            $errores['residencia'] = 'Debe introducir un país';
        }

        return $errores;
    }

}

