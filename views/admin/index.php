<h1 class="nombre-pagina">Panel de Administración</h1>

<?php
include_once __DIR__ . "/../templates/barra.php";
?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" min="2018-01-01" value=<?php echo $fecha?>>
        </div>
    </form>
    <?php if(count($citas)===0){
        echo "<h2>No hay citas para esta fecha</h2>";
    } ?>


    <div id="citas-admin">
        <ul class="citas">
            <?php
            $idCita = '';
            foreach ($citas as $key=>$cita) {
                if ($idCita !== $cita->id) {
                    $total = 0;
            ?>
                    <li>
                        <p>ID: <span><?php echo $cita->id ?></span>
                        <p>Hora: <span><?php echo $cita->hora ?></span>
                        <p>Cliente: <span><?php echo $cita->cliente ?></span>
                        <p>Email: <span><?php echo $cita->email ?></span>
                        <p>Telefono: <span><?php echo $cita->telefono ?></span>
                        <h3>Servicios</h3>
                    <?php  } 
                     $idCita = $cita->id;
                    ?>
                    <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio ?></p>
                    <?php
                      $total += $cita->precio;
                      $actual = $cita->id;
                      $proximo = $citas[$key+1]->id ?? 0; 
                      if(esUltimo($actual, $proximo)){ ?>
                        <p class="total">Total: $ <span><?php echo $total?></span></p>                         
                        <form action="/api/eliminar" method="POST">
                            <input type="hidden" name="id" value=<?php echo $cita->id ?>>
                            <div class="boton-submit">
                            <input type="submit" class="boton-eliminar boton" value="Eliminar">
                            </div>
                            
                        </form>
                   <?php

            }} ?>
            </li>
        </ul>

    </div>
</div>

<?php 
  $script = "<script src='/build/js/buscador.js'></script>"
?>