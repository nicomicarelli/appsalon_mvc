<?php

namespace Controllers;

use Model\Usuario;
use Model\Servicio;
use MVC\Router;
use Classes\Email;


class ServicioController {
    public static function index(Router $router){
        if (!isset($_SESSION)){
            session_start();
          }
          isAuth();
          isAdmin();

        $alertas=[];
        $servicios = Servicio::all();

        $router->render('servicios/index', [
           "alertas"=>$alertas,
           "servicios"=>$servicios, 
           "id" => $_SESSION['id'],
           "nombre"=>$_SESSION['nombre']
        ]);
    }
    public static function crear(Router $router){
        if (!isset($_SESSION)){
            session_start();
          }
          isAuth();
          isAdmin();


        $servicio = new Servicio;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD']==="POST"){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
 
           if(empty($alertas)){
               $servicio->guardar();
               header('location:/servicios');
           }  
        }

          $router->render('servicios/crear', [
            "servicio"=>$servicio,
            "alertas"=>$alertas,
            "id" => $_SESSION['id'],
            "nombre"=>$_SESSION['nombre']
         ]);
    }
    public static function actualizar(Router $router){
        if (!isset($_SESSION)){
            session_start();
          }
        isAuth();
        isAdmin();

        $alertas=[];
        $servicio = new Servicio;
        
        $id=$_GET['id'];

        if (is_numeric($id)){
          $servicio = Servicio::find(s($id));
        } else {
            header('location:/servicios');
            return;
        }
        

        if ($_SERVER['REQUEST_METHOD']==="POST"){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
         
            if(empty($alertas)){
                $servicio->guardar();
                header('location:/servicios');
            }  
        }

          $router->render('servicios/actualizar', [
            "servicio"=>$servicio,
            "alertas"=>$alertas,
            "id" => $_SESSION['id'],
            "nombre"=>$_SESSION['nombre']
         ]);
    }
    public static function eliminar(){
        isAuth();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD']==="POST"){
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('location:/servicios');
        }
    }
}

