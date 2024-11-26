<?php

namespace Com\TravelMates\Core;

use Steampixel\Route;

class FrontController {

    static function main() {

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
                    $controlador->editarUsuario($id_usuario);
                }, 'post');   
                
                //TODO: Hacer funciones para eliminar o lo que sea.                
            }

            Route::add('/cuenta', function () {
                $controlador = new \Com\TravelMates\Controllers\CuentaController();
                $controlador->mostrar();
            }, 'get');

            Route::add('/actualizar-cuenta', function () {
                $controlador = new \Com\TravelMates\Controllers\CuentaController();
                $controlador->actualizarCuenta($_POST);
            }, 'post');

            Route::add('/buscar-usuario', function () {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->mostrarBuscarUsuarios();
            }, 'get'); 

            Route::add('/buscar-usuario', function () {
                $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                $controlador->buscarUsuarios($_POST);
            }, 'post'); 

            Route::add('/mapa', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->mostrarMapa();
            }, 'get');

            Route::add('/mapa/get_marcadores', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->obtenerMarcadores();
            }, 'get');

            Route::add('/mapa/add_marcador', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->nuevoMarcador();
            }, 'post');
            
            Route::add('/chat', function () {
                $controlador = new \Com\TravelMates\Controllers\ChatController();
                $controlador->mostrar();
            }, 'get');

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

        Route::add('/', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->inicio();
        }, 'get');

        Route::pathNotFound(function () {
            header('location:/');
        });

        Route::methodNotAllowed(function () {
            $controller = new \Com\TravelMates\Controllers\ErroresController();
            $controller->error405();
        });

        Route::run();
    }

}
