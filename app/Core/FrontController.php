<?php

namespace Com\TravelMates\Core;

use Steampixel\Route;

class FrontController {

    static function main() {

        session_start();       
        

        if (isset($_SESSION['user'])) {
            
            if ($_SESSION['user']['username'] == "admin") {
                Route::add('/gestion-de-usuarios', function () {
                    $controlador = new \Com\TravelMates\Controllers\UsuarioController();
                    $controlador->show();
                }, 'get');            
            }
            
            Route::add('/logout', function () {
                $controlador = new \Com\TravelMates\Controllers\InicioController();
                $controlador->logout();
            }, 'get');

            Route::add('/mapa', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->showMapa();
            }, 'get');

            Route::add('/mapa/get_marcadores', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->getMarcadores();
            }, 'get');

            Route::add('/mapa/add_marcador', function () {
                $controlador = new \Com\TravelMates\Controllers\MapaController();
                $controlador->addMarcador();
            }, 'post');
            
            Route::add('/chat', function () {
                $controlador = new \Com\TravelMates\Controllers\ChatController();
                $controlador->show();
            }, 'get');
        }

        Route::add('/login', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->showLogin();
        }, 'get');

        Route::add('/login', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->processLogin($_POST);
        }, 'post');

        Route::add('/register', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->showRegister();
        }, 'get');

        Route::add('/register', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->processRegister($_POST);
        }, 'post');
        
        Route::add('/cuenta', function () {
            $controlador = new \Com\TravelMates\Controllers\CuentaController();
            $controlador->show();
        }, 'get');

        Route::add('/', function () {
            $controlador = new \Com\TravelMates\Controllers\InicioController();
            $controlador->index();
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
