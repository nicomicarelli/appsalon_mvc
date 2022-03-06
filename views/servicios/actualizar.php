<h1 class="nombre-pagina">Modificar Servicio</h1>
<p class="descripcion-pagina">Modifica los datos para modificar el servicio</p>

<?php @include_once __DIR__ . "/../templates/barra.php" ?>
<?php @include_once __DIR__ . "/../templates/alertas.php" ?>

<form method="POST" class="formulario">

<?php @include_once "formulario.php" ?>


<div class="boton-submit">
<input type="submit" class="boton" value="Guardar">
</div>
</form>