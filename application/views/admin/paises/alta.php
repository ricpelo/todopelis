<?= validation_errors() ?>
<?= form_open('/admin/paises/alta') ?>
  <?= form_label('Nombre: ', 'nombre') ?>
  <?= form_input('nombre', set_value('nombre')) ?><br/>
  <?= form_submit('alta', 'Alta') ?>
  <?= anchor("/admin/paises/index", 'Volver') ?>
<?= form_close() ?>
