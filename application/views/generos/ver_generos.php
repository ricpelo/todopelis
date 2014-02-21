<h2>Lista de Generos</h2>
<?= $info ?>
<?= form_open("/admin/generos/index") ?>
  <p align="center"><?= form_label('Busqueda:', 'nombre') ?>
  
  <?= form_input('nombre', $nombre) ?>
  <?= form_submit('buscar', 'Buscar') ?></p>
<?= form_close() ?>

<table border="1" style="margin:auto" width="50%">
  <thead style="background-color: red;">
    <th>ID</th><th>Nombre</th><th colspan="2">Acciones</th>
  </thead>
  <tbody>
    <?php foreach ($generos as $fila): ?>
      <tr align="center">
        <td><?= $fila['id'] ?></td>
        <td><?= $fila['nombre'] ?></td>
        <td><?= anchor("admin/generos/modificar/{$fila['id']}", 'Editar') ?></td>
        <td><?= anchor("admin/generos/borrar/{$fila['id']}", 'Borrar') ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<div style="text-align: center">
  <?= paginado($pag, $npags, $vista)?>
</div>
<p align="center"><?= anchor("admin/generos/alta", 'Insertar un nuevo Genero') ?></p>
