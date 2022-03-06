<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tus datos</p>

<?php 
  include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Ingresa tu email" name="email" autocomplete="off" />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Ingresa tu password" name="password" />
    </div>
    <div class="boton-submit">
       <input type="submit" class="boton" value="Iniciar Sesión" />
    </div>
    
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aun no tienes cuenta? Crear una</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
    
</div>
