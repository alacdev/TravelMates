<?php

namespace Com\TravelMates\Controllers;

class InicioController extends \Com\TravelMates\Core\BaseController {

    public function index() {
        $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio']
        );

        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }

    public function showLogin() {
        $this->view->show('login.view.php');

    }

    public function showRegister() {
        $this->view->show('register.view.php');

    }

    public function processLogin(array $post) {
        $userModel = new \Com\TravelMates\Models\UsuarioSistemaModel();
        $user = $userModel->getUserByEmail($post['email']);
        if ($user != null) {
            if ($user['id_estado'] == 1) {
                if (password_verify($post['pass'], $user['pass'])) {
                    $_SESSION['user'] = $user;
                    header('location:/');
                } else {
                    $_SESSION['error_login'] = 'Datos incorrectos';
                    header('location:/login');
                }
            } else {
                $_SESSION['error_login'] = 'Datos incorrectos';
                header('location:/login');
            }
        } else {
            $_SESSION['error_login'] = 'Datos incorrectos';
            header('location:/login');
        }
    }
    
    public function processRegister(array $post) {
        // $userModel = new \Com\TravelMates\Models\UsuarioSistemaModel();
        // $user = $userModel->getUserByEmail($post['email']);
        // if ($user != null) {
        //     if ($user['id_estado'] == 1) {
        //         if (password_verify($post['pass'], $user['pass'])) {
        //             $_SESSION['user'] = $user;
        //             header('location:/');
        //         } else {
        //             $_SESSION['error_login'] = 'Datos incorrectos';
        //             header('location:/login');
        //         }
        //     } else {
        //         $_SESSION['error_login'] = 'Datos incorrectos';
        //         header('location:/login');
        //     }
        // } else {
        //     $_SESSION['error_login'] = 'Datos incorrectos';
        //     header('location:/login');
        // }
    }

    public function logout() {
        session_destroy();
        header('location:/login');
    }

}
