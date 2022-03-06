<h1 class="nombre-pagina">Restablece tu password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php 
  include_once __DIR__ . "/../templates/alertas.php";

  if ($error){
      return null;
  }
?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu password">        
    </div>
    <input type="submit" value="Restablecer password" class="boton" action="/recuperar">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aun no tienes cuenta? Crear una</a>
</div>
