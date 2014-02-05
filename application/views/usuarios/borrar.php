<h3>¿Está seguro de querer borrar ese usuario?</h3>
<?= form_open("/usuarios/hacer_borrado") ?>
  <?= form_hidden('id', $id) ?>
  <?= form_submit('si', 'Sí') ?>
  <?= anchor("/usuarios/index", 'No') ?>
<?= form_close() ?>

