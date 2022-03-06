<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena los campos para crear un nuevo servicio</p>

<?php @include_once __DIR__ . "/../templates/barra.php" ?>
<?php @include_once __DIR__ . "/../templates/alertas.php" ?>

<form action="/servicios/crear" method="POST" class="formulario">

<?php @include_once "formulario.php" ?>


<div class="boton-submit">
<input type="submit" class="boton" value="Guardar">
</div>
</form>