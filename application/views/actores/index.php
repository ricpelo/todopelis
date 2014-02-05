<h2>Lista de actores</h2>

<?= form_open("/admin/actores/index") ?>
  <?= form_label('Columna:', 'columna') ?>
  <?= form_dropdown('columna', $opciones, $columna) ?>
  <?= form_input('criterio', $criterio) ?>
  <?= form_submit('buscar', 'Buscar') ?>
<?= form_close() ?>

<table border="1" style="margin:auto">
  <thead>
    <th>Actor</th><th colspan="2">Acciones</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <tr>
        <td>$fila['usuario']?></td>
        <td><?= anchor("/admin/actores/editar/{$fila['id']}", 'Editar') ?></td>
        <td><?= anchor("/admin/actores/borrar/{$fila['id']}", 'Borrar') ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?= anchor("/admin/actores/alta", 'Insertar un nuevo actor') ?>