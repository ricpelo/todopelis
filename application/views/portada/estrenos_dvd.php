<h2>Proximos estrenos en DVD</h2>
<div>
  <?php foreach ($dvds as $dvd): ?>
    <div class="penicula" style="float: left; border: 1px solid black;">
      <h3><?= $dvd['titulo']?></h3>
      <?php
      $cartel = $dvd['cartel']; 
      $imagen = array('src' => "$cartel", 'height' => '250', 'width' => '200'); ?>
      <?= img($imagen) ?>
      <p><?= $dvd['dvd']?></p>
    </div>
  <?php endforeach;?>
</div>