<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;


class LoginController
{
   public static function login(Router $router)
   {
      $alertas = [];
      $auth = [];

      if ($_SERVER['REQUEST_METHOD'] === "POST") {
         $auth = new Usuario($_POST);

         $alertas = $auth->validarLogin();

         if (empty($alertas)){
            $usuario = Usuario::where('email', $auth->email);

            if (!$usuario){
               Usuario::setAlerta('error', 'Usuario no encontrado');
            } else {
               if ($usuario->validarPasswordYConfirmado($auth->password)){
                  if (!isset($_SESSION)){
                     session_start();
                  }
                 
                 $_SESSION['login'] = true;
                 $_SESSION['id'] = $usuario->id;
                 $_SESSION['nombre'] = $usuario->nombre ." ". $usuario->apellido;
                 $_SESSION['email'] = $usuario->email;

                 if($usuario->admin === '0'){
                    header('location:/cita');
                 } else {
                    $_SESSION['admin'] = $usuario->admin ?? null;
                    header('location:/admin');
                 }


               } 

            }

         } 
      }
      $alertas = Usuario::getAlertas();

      $router->render('auth/login', [
         "alertas" => $alertas,
         "usuario" => $auth
      ]);
   }

   public static function logout()
   {
      if (!isset($_SESSION)){
         session_start();
      }

      $_SESSION = [];
      header('location:/');

   }

   public static function olvide(Router $router)
   {
      $alertas = [];

      if ($_SERVER['REQUEST_METHOD']==="POST"){
         $auth = new Usuario($_POST);
         $alertas = $auth->validarEmail();

         if(empty($alertas)){
            $usuario = Usuario::where('email', $auth->email);

            if($usuario && $usuario->confirmado==="1"){
               $usuario->crearToken();
               $usuario->guardar();
               $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
               $email->enviarInstrucciones();


               Usuario::setAlerta('exito', 'Revisa tu email, te hemos enviado las instrucciones para recuperar la contraseña.');
               $alertas = Usuario::getAlertas();
            } else {
               Usuario::setAlerta('error', "El usuario no existe o no se encuentra confirmado.");
               $alertas = Usuario::getAlertas();
            }

         }
      }

      $router->render('auth/olvide', [
         "alertas"=>$alertas
      ]);
   }

   public static function recuperar(Router $router)
   {
      $alertas = [];
      $error = false;

      $token = s($_GET['token']);
 
      $usuario = Usuario::where('token', $token);
      if(empty($usuario)){
         $error = true;
         Usuario::setAlerta('error', "Token no valido");
      }; 

      if($_SERVER['REQUEST_METHOD'] === "POST"){
         $password = new Usuario($_POST);

         $alertas = $password->validarPassword();

         if(empty($alertas)){
            $usuario->password = null;
            $usuario->password = $password->password;
            $usuario->token = null;
            $usuario->hashPassword();
            $resultado = $usuario->guardar();

            if ($resultado){
               header('Location: /');
            }
         }


      }

      $alertas = Usuario::getAlertas();

      $router->render('auth/recuperar-password', [
         "alertas"=>$alertas,
         "error"=>$error
      ]);
   }

   public static function crearCuenta(Router $router)
   {
      $usuario = new Usuario();
      $alertas = [];
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $usuario->sincronizar($_POST);
         $alertas = $usuario->validarNuevaCuenta();

         if (empty($alertas)) {
            $resultado = $usuario->existeUsuario();

            if ($resultado->num_rows) {
               $alertas = Usuario::getAlertas();
            } else {
               $usuario->hashPassword();

               $usuario->crearToken();

               $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
               $email->enviarMailConfirmacion();

               $resultado = $usuario->guardar();

               if ($resultado) {
                  header('location:/mensaje');
               }
            }
         }
      }
      
      $router->render('auth/crear-cuenta', [
         'usuario' => $usuario,
         'alertas' => $alertas
      ]);
   }

   public static function mensaje(Router $router)
   {
      $router->render('auth/mensaje');
   }

   public static function confirmarCuenta(Router $router)
   {
      $alertas = [];

      $token = s($_GET['token']);

      $usuario = Usuario::where('token', $token);

      if (empty($usuario)){
         Usuario::setAlerta('error', 'token no valido');   
      } else {
        $usuario->confirmado=1;
        $usuario->token='';        
        $usuario->guardar();
        Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');   
      }

      $alertas = Usuario::getAlertas();
      $router->render('auth/confirmar-cuenta', [
         'alertas' => $alertas
      ]);
   }

}
