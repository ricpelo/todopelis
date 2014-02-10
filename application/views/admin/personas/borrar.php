<h3>¿Está seguro de querer borrar esta persona?</h3>
<?= form_open("admin/personas/hacer_borrado") ?>
  <?= form_hidden('id', $id) ?>
  <?= form_submit('si', 'Sí') ?>
  <?= anchor("/admin/personas/index", 'No') ?>
<?= form_close() ?>