<h2>Proximos estrenos en DVD</h2>

  <?php foreach ($peniculas as $penicula): ?>
    <div class="penicula" style="float: left; border: 1px solid black;">
      <h3><?= anchor("portal/peniculas/ficha/{$penicula['id']}","{$penicula['titulo']}" ) ?></h3>
      <?php
      $imagen = array('src' => "{$penicula['cartel']}", 'height' => '250', 'width' => '200'); ?>
      <?= img($imagen) ?>
      <p> A la venta el: <?= $penicula['dvd']?></p>
    </div>
  <?php endforeach;?>
    <div style="clear: both;"></div>
</div>
<hr />
