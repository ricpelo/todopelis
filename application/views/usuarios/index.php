<h2>Lista de usuarios</h2>

<?= form_open("/usuarios/index") ?>
  <?= form_label('Columna:', 'columna') ?>
  <?= form_dropdown('columna', $opciones, $columna) ?>
  <?= form_input('criterio', $criterio) ?>
  <?= form_submit('buscar', 'Buscar') ?>
<?= form_close() ?>

<table border="1" style="margin:auto">
  <thead>
    <th>Usuario</th><th>e-mail</th><th colspan="2">Acciones</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <tr>
        <td><?= anchor("/tuits/tuits_de/{$fila['usuario']}",
                       $fila['usuario']) ?></td>
        <td><?= $fila['email'] ?></td>
        <td><?= anchor("/usuarios/editar/{$fila['id']}", 'Editar') ?></td>
        <td><?= anchor("/usuarios/borrar/{$fila['id']}", 'Borrar') ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?= anchor("/usuarios/alta", 'Insertar un nuevo usuario') ?>

