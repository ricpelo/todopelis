<?= form_open("/admin/personas/index/") ?>
  <?= form_input('criterio', $criterio) ?>
  <?= form_submit('buscar', 'buscar') ?>
<?= form_close() ?>

<table border="1" style="margin:auto">
	<thead>
		<tr>
			<th>Personas</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	  <?php foreach ($filas as $fila): ?>
			<tr>
			  <td><?= $fila['nombre'] ?></td>
			  <td>
			    <?= anchor("/admin/personas/editar/{$fila['id']}", "editar") ?>
			    |
			    <?= anchor("/admin/personas/borrar/{$fila['id']}", "borrar") ?>
			  </td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<div style="text-align: center">
	<?= paginado($pag, $npags, $vista)?>
</div>


<?= anchor("/admin/personas/alta", 'Nueva persona') ?><br />

<?= anchor("/admin/usuarios/index", "Volver") ?>
