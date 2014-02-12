<h2>Lista de usuarios</h2>

<?= form_open("portal/usuarios/index") ?>
  <?= form_label('Columna:', 'columna') ?>
  <?= form_dropdown('columna', $opciones, $columna) ?>
  <?= form_input('criterio', $criterio) ?>
  <?= form_submit('buscar', 'Buscar') ?>
<?= form_close() ?>

<table border="1" style="margin:auto">
  <thead>
    <th>Usuario</th><th>e-mail</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <tr>
        <td><?= $fila['usuario'] ?></td>
        <td><?= $fila['email'] ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>


