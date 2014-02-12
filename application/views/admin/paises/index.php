<?= form_open("/admin/paises/index/") ?>
  <?= form_input('criterio', $criterio) ?>
  <?= form_submit('buscar', 'buscar') ?>
<?= form_close() ?>

<table border="1" style="margin:auto">
  <thead>
    <tr>
      <th>Paises</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <tr>
        <td><?= $fila['nombre'] ?></td>
        <td>
          <?= anchor("/admin/paises/editar/{$fila['id']}", "editar") ?>
          |
          <?= anchor("/admin/paises/borrar/{$fila['id']}", "borrar") ?>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<div style="text-align: center">
  <?= paginado($pag, $npags,$vista)?>
</div>


<?= anchor("/admin/paises/alta", 'Nuevo pais') ?><br />

<?= anchor("/admin/usuarios/index", 'Indice') ?>