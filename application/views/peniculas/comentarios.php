<nav id="menu_ficha">
  <?= anchor("/portal/peniculas/ficha/{$penicula['id_penicula']}", "Ficha") ?>
</nav>

<?php foreach ($comentarios as $comentario): ?>
	<div style="border: 1px solid black; margin-top: 10px;">
	  <h3><?= $comentario['usuario'] ?></h3>
	  <p><?= $comentario['critica'] ?></p>
	</div>
<?php endforeach ?>

<?= paginado_comentarios($penicula['id_penicula'],
                         $penicula['pag'], 
                         $penicula['npags']) ?>