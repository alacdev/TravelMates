<?php

namespace Com\TravelMates\Controllers;

class CuentaController extends \Com\TravelMates\Core\BaseController
{

    public function mostrar()
    {
        $data = array(
            'titulo' => 'Cuenta',
            'breadcrumb' => ['Cuenta'],
            'usuario' => $_SESSION['user']
        );

        $this->view->showViews(array('templates/header.view.php', 'cuenta.view.php', 'templates/footer.view.php'), $data);
    }

    public function actualizarCuenta(array $post, array $files)
    {
        $imgurModel = new \Com\TravelMates\Models\ImgurModel();

        $fotoPerfil = $files['url_img']['tmp_name'];
        $post['url_img'] = $imgurModel->obtenerUrl($fotoPerfil);

        $errores = $this->checkFormActualizarCuenta($post);
        if (count($errores) > 0) {
            $_SESSION['errores_cuenta'] = $errores;
            header('location:/cuenta');
        } else {
            $usermodel = new \Com\TravelMates\Models\UsuarioModel();
            $usermodel->actualizarUsuario($_SESSION['user']['id'], $post);
            $this->mostrar();
        }

    }

    private function checkFormActualizarCuenta(array $post): array
    {
        $userModel = new \Com\TravelMates\Models\UsuarioModel();
        $errores = [];

        if (empty($post['username'])) {
            $errores['username'] = 'Debe introducir un nombre de usuario.';
        } else
            if (!preg_match('/^[a-zA-Z0-9]{1,20}$/', $_POST['username'])) {
                $errores['username'] = 'El nombre de usuario debe contener únicamente letras y/o números.';
            } else
                if ($userModel->obtenerUsuarioPorUsername($post['username']) != null && $post['username'] != $_SESSION['user']['username']) {
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
                if ($userModel->obtenerUsuarioPorEmail($post['email']) != null && $post['email'] != $_SESSION['user']['email']) {
                    $errores['email'] = 'El email ya está en uso.';
                }

        if (!empty($post['pass_antigua'])) {
            if (!preg_match('/^ (?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $post['pass_antigua']))
                $errores['pass_antigua'] = 'La contraseña debe contener un mínimo de 7 caracteres, una mayúscula, una minúscula y un número.';
        } else
            if (!empty($post['pass_nueva'])) {
                $errores['pass_antigua'] = 'Debe introducir la nueva contraseña';
            }


        if (!empty($post['pass_nueva'])) {
            if (!preg_match('/^ (?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $post['pass_nueva'])) {
                $errores['pass_nueva'] = 'La contraseña debe contener un mínimo de 7 caracteres, una mayúscula, una minúscula y un número.';
            } else
                if ($post['pass_nueva'] != $post['confirm_pass_nueva']) {
                    $errores['confirm_pass_nueva'] = 'Las contraseñas deben coincidir.';
                } else
                    if (empty($post['pass_antigua'])) {
                        $errores['pass_antigua'] = 'Debe introducir la contraseña actual';
                    }
        }

        if (empty($post['residencia'])) {
            $errores['residencia'] = 'Debe introducir un país';
        }
        //        else if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,50}$/u', $post['residencia'])) {
//            $errores['residencia'] = 'Este campo solo puede contener letras, incluyendo acentos y la letra ñ.';
//        }

        return $errores;
    }

}
