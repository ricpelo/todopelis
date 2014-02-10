<h3>¿Está seguro de querer borrar ese usuario?</h3>
<?= form_open("portal/usuarios/hacer_borrado") ?>
  <?= form_hidden('id', $id) ?>
  <?= form_submit('si', 'Sí') ?>
  <?= anchor("portal/usuarios/index", 'No') ?>
<?= form_close() ?>

