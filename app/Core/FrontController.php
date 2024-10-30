<?php

namespace Com\TravelMates\Core;

use Steampixel\Route;

class FrontController {

    static function main() {

        session_start();

        Route::add('/login',
                function () {
                    $controlador = new \Com\TravelMates\Controllers\InicioController();
                    $controlador->showLogin();
                }
                , 'get');
        Route::add('/login',
                function () {
                    $controlador = new \Com\TravelMates\Controllers\InicioController();
                    $controlador->processLogin($_POST);
                }
                , 'post');

        Route::add('/logout',
                function () {
                    $controlador = new \Com\TravelMates\Controllers\InicioController();
                    $controlador->logout();
                }
                , 'get');

        Route::add('/',
                function () {
                    $controlador = new \Com\TravelMates\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');
                
        Route::add('/mapa',
                function () {
                    $controlador = new \Com\TravelMates\Controllers\MapaController();
                    $controlador->showMapa();
                }
                , 'get');        

//        Route::pathNotFound(
//                function () {
//                    $controller = new \Com\TravelMates\Controllers\ErroresController();
//                    $controller->error404();
//                }
//        );

        Route::pathNotFound(
                function () {
                    header('location:/');
                }
        );

        Route::methodNotAllowed(
                function () {
                    $controller = new \Com\TravelMates\Controllers\ErroresController();
                    $controller->error405();
                }
        );

        Route::run();
    }

}
