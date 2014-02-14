<h2>Lista de peniculas</h2>
<?= $cartel ?>
<?= $alta ?>
<?= $borrar?>
<?= form_open("/admin/peniculas/index") ?>
  <p align="center"><?= form_label('Busqueda:', 'buscar') ?>
  
  <?= form_input('nombre', $nombre) ?>
  <?= form_submit('buscar', 'Buscar') ?></p>
<?= form_close() ?>

<table border="1" style="margin:auto" width="50%">
  <thead style="background-color: red;">
    <th>Titulo</th><th>Fecha alta</th><th colspan="3">Acciones</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <tr align="center">
        <td><?= $fila['titulo'] ?></td>
        <td><?= $fila['alta_format'] ?></td>
        <td><?= anchor("admin/peniculas/editar/{$fila['id']}", 'Editar') ?></td>
        <td><?= anchor("admin/peniculas/borrar/{$fila['id']}", 'Borrar') ?></td>
        <td><?= anchor("admin/peniculas/subir_cartel/{$fila['id']}", 'Cartel') ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<p align="center"><?= anchor("admin/peniculas/alta", 'Insertar un nueva penicula') ?></p>

