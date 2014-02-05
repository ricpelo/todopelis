<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Cartelera</title>
</head>
<body>
	<h2>cartelera España</h2>
	<div>
	  <?php foreach ($peniculas as $penicula): ?>
	    <div class="penicula" style="float: left; border: 1px solid black;">
	      <h3><?= anchor("portal/peniculas/fichas_de/{$penicula['id']}","{$penicula['titulo']}" ) ?></h3>
	      <?php
	      $cartel = $penicula['cartel']; 
	      $imagen = array('src' => "{$penicula['cartel']}", 'height' => '250', 'width' => '200'); ?>
	      <?= img($imagen) ?>
	      <p>Estreno el: <?= $penicula['estreno']?></p>
	    </div>
	  <?php endforeach;?>
	</div>

	<h2>Proximos estrenos en cine</h2>
	<div>
	  <?php foreach ($estrenosCine as $estrenosCine): ?>
	    <div class="penicula" style="float: left; border: 1px solid black;">
	      <h3><?= $estrenosCine['titulo']?></h3>
	      <?php
	      $cartel = $estrenosCine['cartel']; 
	      $imagen = array('src' => "$cartel", 'height' => '250', 'width' => '200'); ?>
	      <?= img($imagen) ?>
	      <p><?= $estrenosCine['estreno']?></p>
	    </div>
	  <?php endforeach;?>
	</div>

	<h2>Proximos estrenos en DVD</h2>
	<div>
	  <?php foreach ($dvds as $dvds): ?>
	    <div class="penicula" style="float: left; border: 1px solid black;">
	      <h3><?= $dvds['titulo']?></h3>
	      <?php
	      $cartel = $dvds['cartel']; 
	      $imagen = array('src' => "$cartel", 'height' => '250', 'width' => '200'); ?>
	      <?= img($imagen) ?>
	      <p><?= $dvds['estreno']?></p>
	    </div>
	  <?php endforeach;?>
	</div>
</body>
</html>