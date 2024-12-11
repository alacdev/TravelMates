<?php

namespace Com\TravelMates\Core;

use Steampixel\Route;

class FrontController
{

    static function main()
    {

        session_start();


        if (isset($_SESSION['user'])) {

            if ($_SESSION['user']['username'] == "admin") {
                Route::add('/gestion-usuarios', function () {
                    $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                    $controlador->mostrarGestionUsuarios();
                }, 'get');

                Route::add('/eliminar-usuario/([0-9]+)', function ($id_usuario) {
                    $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                    $controlador->eliminarUsuario($id_usuario);
                }, 'post');

                Route::add('/editar-usuario/([0-9]+)', function ($id_usuario) {
                    $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                    $controlador->mostrarEditarUsuario($id_usuario);
                }, 'get');

                Route::add('/editar-usuario/([0-9]+)', function ($id_usuario) {
                    $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                    $controlador->editarUsuario($id_usuario,$_POST, isset($_FILES) && !empty($_FILES) ? $_FILES : []);
                }, 'post');

            }

            Route::add('/', function () {
                $controlador = new \Com\TravelMates\Controllers\InicioController();
                $controlador->inicio();
            }, 'get');

            Route::add('/usuario/([0-9]+)', function ($id_usuario) {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->mostrarUsuario($id_usuario);
            }, 'get');

            Route::add('/me-gusta/([0-9]+)', function ($id_publicacion) {
                $controlador = new \Com\TravelMates\Controllers\PublicacionController();
                $controlador->meGusta($_SESSION['user']['id'], $id_publicacion);
            }, 'post');
            
            Route::add('/no-me-gusta/([0-9]+)', function ($id_publicacion) {
                $controlador = new \Com\TravelMates\Controllers\PublicacionController();
                $controlador->noMeGusta($_SESSION['user']['id'], $id_publicacion);
            }, 'post');

            Route::add('/cuenta', function () {
                $controlador = new \Com\TravelMates\Controllers\CuentaController();
                $controlador->mostrar();
            }, 'get');

            Route::add('/amigos', function () {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->mostrarAmigos();
            }, 'get');

            Route::add('/actualizar-cuenta', function () {
                $controlador = new \Com\TravelMates\Controllers\CuentaController();
                $controlador->actualizarCuenta($_POST, isset($_FILES) && !empty($_FILES) ? $_FILES : []);
            }, 'post');

            Route::add('/solicitudes-recibidas', function () {
                $controlador = new \Com\TravelMates\Controllers\SolicitudesController();
                $controlador->mostrarSolicitudesRecibidas();
            }, 'get');

            Route::add('/aceptar-solicitud/([0-9]+)', function ($id_solicitud) {
                $controlador = new \Com\TravelMates\Controllers\SolicitudesController();
                $controlador->aceptarSolicitud($id_solicitud);
            }, 'get');

            Route::add('/rechazar-solicitud/([0-9]+)', function ($id_solicitud) {
                $controlador = new \Com\TravelMates\Controllers\SolicitudesController();
                $controlador->rechazarSolicitud($id_solicitud);
            }, 'get');

            Route::add('/buscar-usuario', function () {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->mostrarBuscarUsuarios();
            }, 'get');

            Route::add('/buscar-usuario', function () {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->buscarUsuarios($_POST);
            }, 'post');

            Route::add('/buscar-usuario/([^/]+)', function ($busqueda) {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->buscarUsuarios($post['busqueda'] = $busqueda);
            }, 'post');

            Route::add('/enviar-solicitud/([0-9]+)', function ($id_receptor) {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->enviarSolicitudAmistad($id_receptor);
            }, 'post');

            Route::add('/cancelar-solicitud/([0-9]+)', function ($id_receptor) {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->cancelarSolicitudAmistad($id_receptor);
            }, 'post');

            Route::add('/mapa', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->mostrarMapa();
            }, 'get');

            Route::add('/mapa/get-marcadores', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->obtenerMarcadores();
            }, 'get');

            Route::add('/mapa/add-marcador', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->nuevoMarcador();
            }, 'post');

            // Route::add('/chat', function () {
            //     $controlador = new \Com\TravelMates\Controllers\ChatController();
            //     $controlador->mostrar();
            // }, 'get');

            Route::add('/nueva-publicacion', function () {
                $controlador = new \Com\TravelMates\Controllers\PublicacionController();
                $controlador->mostrarNuevaPublicacion();
            }, 'get');

            Route::add('/nueva-publicacion', function () {
                $controlador = new \Com\TravelMates\Controllers\PublicacionController();
                $controlador->crearNuevaPublicacion($_POST, $_FILES);
            }, 'post');

            Route::add('/logout', function () {
                $controlador = new \Com\TravelMates\Controllers\InicioController();
                $controlador->logout();
            }, 'get');

            Route::pathNotFound(function () {
                header('location:/');
            });
        }

        Route::add('/login', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->mostrarLogin();
        }, 'get');

        Route::add('/login', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->iniciarSesion($_POST);
        }, 'post');

        Route::add('/register', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->mostrarRegistro();
        }, 'get');

        Route::add('/register', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->registrar($_POST);
        }, 'post');

        Route::pathNotFound(function () {
            header('location:/login');
        });

        Route::methodNotAllowed(function () {
            $controller = new \Com\TravelMates\Controllers\ErroresController();
            $controller->error405();
        });

        Route::run();
    }

}
