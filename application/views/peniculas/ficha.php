<section id="ficha">
  <h2 id="titulo"><?= $datos['titulo'] ?></h2>
  
  <nav id="menu_ficha">
    <?= anchor("/portal/peniculas/ficha_de/{$datos['id_penicula']}", "Ficha") ?>
    <?= anchor("/portal/peniculas/comentarios_de/{$datos['id_penicula']}", "Ficha") ?>
  </nav>
  
  <section id="cuerpo_ficha">
    
    <div class="fila_ficha">
      <div class="titulo_fila">Año:</div>
      <div class="dato_fila"><?= $datos['ano'] ?></div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Duración:</div>
      <div class="dato_fila"><?= $datos['duracion'] ?> min.</div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila"><?= ($paises.length == 1) ? 'País:' : 'Países:' ?></div>
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
      <div class="titulo_fila"><?= ($directores.length == 1) ? 'Director:' : 'Diresctores:' ?></div>
      <div class="dato_fila">
        <?php foreach ($directores as $director): ?>
          <span class="nombre_director"><?= anchor("/portal/personas/{$director['id']}", $director['nombre']) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Reparto:</div>
      <div class="dato_fila">
        <?php foreach ($reparto as $actor): ?>
          <span class="nombre_actor"><?= anchor("/portal/personas/{$actor['id']}", $actor['nombre']) ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Estreno:</div>
      <div class="dato_fila"><?= $datos['estreno_format']; ?></div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila"><?= ($generos.length == 1) ? 'Género:' : 'Géneros:' ?></div>
      <div class="dato_fila">
        <?php foreach ($generos as $genero): ?>
          <span class="nombre_genero"><?= $genero['nombre']; ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Sinopsis:</div>
      <div class="dato_fila"><?= $datos['sinopsis']; ?></div>
    </div>
  </section>
  
  <section id="lateral_derecha">
    <img src="<?= $datos['cartel']; ?>" alt="cartel" id="cartel" />
  </section>
</section>
