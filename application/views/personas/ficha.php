<?php ob_start(); ?>
<section id="Persona">
  <h2 id="nombre"><?= $datos["nombre"] ?></h2>
  <section class="datos">
    <div class="etiqueta">Año de nacimiento:</div>
    <div class="dato"><?= $datos['ano'] ?></div>
  </section>
  <section>
      <?php foreach ($participa as $peli): ?>
        <div class="participa">
           <?= anchor("/portal/peniculas/ficha/{$peli['id_peniculas']}", $peli['titulo']) ?>
          <span class="rol"> Como: <?= $peli['cargo']; ?></span>
          <span class="fecha"> --- <?= $peli['ano']; ?></span>
        </div>
      <?php endforeach; ?>
  </section>
</section>
<?php ob_end_flush(); ?>