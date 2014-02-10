<?php ob_start(); ?>
<section id="ficha">
  <h2 id="titulo"><?= $datos["titulo"] ?></h2>
  
  <nav id="menu_ficha">
    <?= anchor("/portal/peniculas/comentarios/{$datos['id']}", "Comentarios") ?>
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
      <div class="titulo_fila">
        <?= (count($paises) == 1) ? 'País:' : 'Países:' ?>
      </div>
      <div class="dato_fila">
        <?php foreach ($paises as $pais): ?>
          <div class="pais">
            <img src="<?= $pais['bandera']; ?>" alt="<?= $pais['nombre']; ?>" />
            <span class="nombre_pais"><?= $pais['nombre']; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">
        <?= (count($directores) == 1) ? 'Director:' : 'Directores:' ?>
      </div>
      <div class="dato_fila">
        <?php foreach ($directores as $director): ?>
          <span class="nombre_director">
            <?= anchor("/portal/personas/{$director['id_personas']}", $director['nombre']) ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="fila_ficha">
      <div class="titulo_fila">Reparto:</div>
      <div class="dato_fila">
        <?php foreach ($reparto as $actor): ?>
          <span class="nombre_actor">
            <?= anchor("/portal/personas/{$actor['id_personas']}", $actor['nombre']) ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
    <br /><br />
    <div class="fila_ficha">
      <div class="titulo_fila">Estreno:</div>
      <div class="dato_fila"><?= $datos['estreno']; ?></div>
    </div>
    <br /><br />
    <div class="fila_ficha">
      <div class="titulo_fila">
        <?= (count($generos) == 1) ? 'Género:' : 'Géneros:' ?>
      </div>
      <div class="dato_fila">
        <?php foreach ($generos as $genero): ?>
          <span class="nombre_genero"><?= $genero['nombre']; ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    <br /><br />
    <div class="fila_ficha">
      <div class="titulo_fila">Sinopsis:</div>
      <div class="dato_fila"><?= $datos['sinopsis']; ?></div>
    </div>
  </section>
  <br /><br />
  <section id="lateral_derecha">
    <?php
      $imagen = array('src' => "{$datos['cartel']}", 'height' => '250', 'width' => '200'); 
    ?>
    <?= img($imagen); ?>
  </section>
</section>
<?php ob_end_flush(); ?>