
<h2>Proximos estrenos en cine</h2>
<div>
  <?php foreach ($peniculas as $penicula): ?>
    <div class="penicula" style="float: left; border: 1px solid black;">
      <h3><?= anchor("portal/peniculas/fichas/{$penicula['id']}","{$penicula['titulo']}" ) ?></h3>
      <?php
      $cartel = $penicula['cartel']; 
      $imagen = array('src' => "{$penicula['cartel']}", 'height' => '250', 'width' => '200'); ?>
      <?= img($imagen) ?>
      <p>Estreno el: <?= $penicula['estreno']?></p>
    </div>
  <?php endforeach;?>
</div>
<hr />
