<?php

namespace Com\TravelMates\Controllers;

use Com\TravelMates\Models\PublicacionesModel;

class InicioController extends \Com\TravelMates\Core\BaseController
{

    public function inicio()
    {
        $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio']
        );

        $publicacionModel = new \Com\TravelMates\Models\PublicacionModel();
        $publicaciones = $publicacionModel->obtenerPublicaciones();
        foreach ($publicaciones as &$publicacion) {
            $publicacion['me_gusta'] = $publicacionModel->verificarMeGusta($_SESSION['user']['id'], $publicacion['id']);
        }

        if (isset($_SESSION['user'])) {
            $data['publicaciones'] = $publicaciones;
        }        

        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }

    public function mostrarLogin()
    {
        $this->view->show('login.view.php');
    }

    public function mostrarRegistro()
    {
        $model = new \Com\TravelMates\Models\InteresesModel();
        $data = array(
            'intereses' => $model->obtenerTodos()
        );
        $this->view->show('register.view.php', $data);
    }

    public function iniciarSesion(array $post)
    {
        $userModel = new \Com\TravelMates\Models\UsuarioModel();
        $user = $userModel->obtenerUsuarioPorUsername($post['username']);
        if ($user != null) {
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
    }

    public function registrar(array $post)
    {
        $errores = $this->checkRegisterForm($post);
        if (count($errores) > 0) {
            $_SESSION['errores_register'] = $errores;
            header('location:/register');
        } else {
            //Hashear contraseña
            $hashpass = password_hash($post['pass'], PASSWORD_DEFAULT);
            unset($post['pass']);
            unset($post['confirm_pass']);
            $post['pass'] = $hashpass;

            if (isset($post['intereses'])) {
                $intereses = $post['intereses'];
            }
            
            $userModel = new \Com\TravelMates\Models\UsuarioModel();
            $interesesModel = new \Com\TravelMates\Models\InteresesModel();
            if ($userModel->addUser($post)) {
                $user = $userModel->obtenerUsuarioPorEmail($post['email']);
                if (!empty($intereses)) {
                    foreach ($intereses as $interes) {
                        $interesesModel->addInteresUsuario($user['id'], $interes);
                    }
                }
                $_SESSION['user'] = $user;
                header('location:/');
            } else {
                $_SESSION['errores_register'] = "Fallo en la inserción";
                header('location:/register');
            }
        }
    }


    private function checkRegisterForm(array $post): array
    {
        $userModel = new \Com\TravelMates\Models\UsuarioModel();
        $errores = [];
        if (empty($post['username'])) {
            $errores['username'] = 'Debe introducir un nombre de usuario.';
        } else
            if (!preg_match('/^[a-zA-Z0-9]{1,20}$/', $_POST['username'])) {
                $errores['username'] = 'El nombre de usuario debe contener únicamente letras y/o números.';
            } else
                if ($userModel->obtenerUsuarioPorUsername($post['username']) != null) {
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
                if ($userModel->obtenerUsuarioPorEmail($post['email']) != null) {
                    $errores['email'] = 'El email ya está en uso.';
                }

        if (empty($post['pass'])) {
            $errores['pass'] = 'Debe introducir una contraseña.';
        } else
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $post['pass'])) {
                $errores['pass'] = 'La contraseña debe contener un mínimo de 7 caracteres, una mayúscula, una minúscula y un número.';
            }

        if ($post['confirm_pass'] != $post['pass']) {
            $errores['confirm_pass'] = 'Las contraseñas deben coincidir.';
        }

        if (empty($post['residencia'])) {
            $errores['residencia'] = 'Debe introducir un país';
        }
        //        else if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,50}$/u', $post['residencia'])) {
//            $errores['residencia'] = 'Este campo solo puede contener letras, incluyendo acentos y la letra ñ.';
//        }

        if (!preg_match('/^[a-zA-Z]{1,50}$/', $post['sexo'])) {
            $errores['sexo'] = 'Debe seleccionar una opción de la lista.';
        }

        return $errores;
    }

    public function logout()
    {
        session_destroy();
        header('location:/');
    }

}
