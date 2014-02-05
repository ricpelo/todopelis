<?php ob_start(); ?>
<section id="ficha">
  <h2 id="titulo"><?= $datos[0]["titulo"] ?></h2>
  
  <nav id="menu_ficha">
    <?= anchor("/portal/peniculas/ficha_de/{$datos[0]['id']}", "Ficha") ?>
    <?= anchor("/portal/peniculas/comentarios_de/{$datos[0]['id']}", "Ficha") ?>
  </nav>
  
  <section id="cuerpo_ficha">
    
    <div class="fila_ficha">
      <div class="titulo_fila">Año:</div>
      <div class="dato_fila"><?= $datos[0]['ano'] ?></div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Duración:</div>
      <div class="dato_fila"><?= $datos[0]['duracion'] ?> min.</div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila"><?= (count($paises) == 1) ? 'País:' : 'Países:' ?></div>
      <div class="dato_fila">
        <?php foreach ($paises as $pais): ?>
          <div class="pais">
            <img src="<?= $pais['bandera']; ?>" alt="<?= $pais['nombre']; ?>" class="bandera" />
            <span class="nombre_pais"><?= $pais['nombre']; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila"><?= (count($directores) == 1) ? 'Director:' : 'Directores:' ?></div>
      <div class="dato_fila">
        <?php foreach ($directores as $director): ?>
          <span class="nombre_director"><?= anchor("/portal/personas/{$director['id_personas']}", $director['nombre']) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Reparto:</div>
      <div class="dato_fila">
        <?php foreach ($reparto as $actor): ?>
          <span class="nombre_actor"><?= anchor("/portal/personas/{$actor['id_personas']}", $actor['nombre']) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Estreno:</div>
      <div class="dato_fila"><?= $datos[0]['estreno']; ?></div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila"><?= (count($generos) == 1) ? 'Género:' : 'Géneros:' ?></div>
      <div class="dato_fila">
        <?php foreach ($generos as $genero): ?>
          <span class="nombre_genero"><?= $genero['nombre']; ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Sinopsis:</div>
      <div class="dato_fila"><?= $datos[0]['sinopsis']; ?></div>
    </div>
  </section>
  
  <section id="lateral_derecha">
    <img src="<?= $datos[0]['cartel']; ?>" alt="cartel" id="cartel" />
  </section>
</section>
<?php ob_end_flush(); ?>