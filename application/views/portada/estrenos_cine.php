<h2>Próximamente en cines</h2>
	<div>
  	<?php foreach ($peniculas as $penicula): ?>
	    <div class="penicula" style="float: left; border: 1px solid black;">
	      <h3><?= $penicula['titulo']?></h3>
	      <?php
	      $cartel = $penicula['cartel']; 
	      $imagen = array('src' => "$cartel", 'height' => '250', 'width' => '200'); ?>
	      <?= img($imagen) ?>
	      <p><?= $penicula['estreno']?></p>
	    </div>
	  <?php endforeach;?>
	</div>
</body>