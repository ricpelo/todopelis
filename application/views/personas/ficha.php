<?php ob_start(); ?>
<section id="Persona">
  <h2 id="nombre"><?= $datos["nombre"] ?></h2>
  <div class="fila_ficha">
    <div class="ano_nac">Año de nacimiento:</div>
    <div class="dato_fila"><?= $datos['ano'] ?></div>
  </div>
</section>
<?php ob_end_flush(); ?>