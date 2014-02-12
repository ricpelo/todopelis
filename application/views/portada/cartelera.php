<h2>Cartelera España</h2>
<div>
  <?php foreach ($peniculas as $penicula): ?>
    <div class="penicula" style="float: left; border: 1px solid black; width: 250px">
      <h3><?= anchor("portal/peniculas/ficha/{$penicula['id']}","{$penicula['titulo']}" ) ?></h3>
      <?php
      $imagen = array('src' => "{$penicula['cartel']}", 'height' => '250', 'width' => '200'); ?>
      <?= img($imagen) ?>
      <p>Estreno el: <?= $penicula['estreno']?></p>
    </div>
  <?php endforeach;?>
  <div style="clear: both;"></div>
</div>
<hr />
