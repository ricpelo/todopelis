<?= validation_errors() ?>
<?= form_open_multipart('/admin/paises/alta') ?>
  <?= form_label('Nombre: ', 'nombre') ?>
  <?= form_input('nombre', set_value('nombre')) ?><br/>
  <?= form_label('Bandera: ', 'bandera') ?>
  <input type="file" name="bandera" id="bandera" /><br/>
  <?= $error ?>
  <?= form_submit('alta', 'Alta') ?>
  <?= anchor("/admin/paises/index", 'Volver') ?>
<?= form_close() ?>
