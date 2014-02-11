<h3>¿Está seguro de querer borrar esta penicula?</h3>
<?= form_open("/admin/peniculas/hacer_borrado") ?>
  <?= form_hidden('id', $id) ?>
  <?= form_submit('si', 'Sí') ?>
  <?= anchor("/admin/peniculas/index", 'No') ?>
<?= form_close() ?>

