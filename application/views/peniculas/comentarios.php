<nav id="menu_ficha">
  <?= anchor("/portal/peniculas/ficha/{$penicula['id_penicula']}", "Ficha") ?>
</nav>

<?php foreach ($comentarios as $comentario): ?>
	<div style="border: 1px solid black; margin-top: 10px;">
	  <h3><?= $comentario['usuario'] ?></h3>
	  <p><?= $comentario['critica'] ?></p>
	
	  <?= eliminar_comentario($usuario, $comentario['id_usuarios'], 
	                         $comentario['id'], $penicula['id_penicula']) ?>
	</div>                         
<?php endforeach ?>



<br />

<?= paginado_comentarios($penicula['id_penicula'],
                         $pag, 
                         $npags) ?>