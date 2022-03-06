<h1 class="nombre-pagina">Olvide mi password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php 
  include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Ingresa tu email">        
    </div>
    <div class="boton-submit">
        <input type="submit" value="Enviar instrucciones" class="boton" action="/olvide">
    </div>
    
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aun no tienes cuenta? Crear una</a>
</div>

