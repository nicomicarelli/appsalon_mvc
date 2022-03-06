<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;
use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class AdminController{
    public static function index(Router $router){
        if (!isset($_SESSION)){
            session_start();
          }
          isAuth();

          isAdmin();
          
          $fecha = $_GET['fecha'] ?? $fecha = date('Y-m-d');
          $fechas = explode('-', $fecha);
          if(count($fechas) === 3){
            if (!checkdate($fechas[1], $fechas[2], $fechas[0])){
              header('location: /404');          
            }
        }
                 
          $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
          $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
          $consulta .= " FROM citas  ";
          $consulta .= " LEFT OUTER JOIN usuarios ";
          $consulta .= " ON citas.usuarioId=usuarios.id  ";
          $consulta .= " LEFT OUTER JOIN citasServicios ";
          $consulta .= " ON citasServicios.citaId=citas.id ";
          $consulta .= " LEFT OUTER JOIN servicios ";
          $consulta .= " ON servicios.id=citasServicios.servicioId ";
          $consulta .= " WHERE fecha =  '${fecha}' ";

          $citas = AdminCita::SQL($consulta);
        
         
        $router->render('admin/index', [
           "nombre"=>$_SESSION['nombre'],
           "citas"=>$citas,
           "fecha"=>$fecha
        ]);
    }

}

