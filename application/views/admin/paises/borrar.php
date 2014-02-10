<h3>¿Está seguro de querer borrar este país?</h3>
<?= form_open("admin/paises/hacer_borrado") ?>
  <?= form_hidden('id', $id) ?>
  <?= form_submit('si', 'Sí') ?>
  <?= anchor("/admin/paises/index", 'No') ?>
<?= form_close() ?>