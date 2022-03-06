<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;


class CitaController {
    public static function index(Router $router){
        if (!isset($_SESSION)){
          session_start();
        }
        isAuth();

        $alertas=[];
        $router->render('cita/index', [
           "alertas"=>$alertas,
           "id" => $_SESSION['id'],
           "nombre"=>$_SESSION['nombre']
        ]);
    }
}

