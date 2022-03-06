<?php
foreach ($alertas as $key => $mensajes) :
    foreach ($mensajes as $mensaje) :
?>
        <div class="contenedor-alerta alerta <?php echo $key ?>">
            <div class="texto-alerta">
                <?php echo $mensaje ?>
            </div>
            <?php if($key === "error"): ?>
                <div class="boton-cerrar-alerta-error">
            <?php else: ?>
                <div class="boton-cerrar-alerta-exito">
            <?php endif ?>
            
              <p>X</p>
            </div>
        </div>
<?php
        endforeach;
  endforeach;
?>