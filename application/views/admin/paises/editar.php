<?= validation_errors() ?>
<?= form_open("/admin/paises/editar/$id") ?>
  <?= form_label('Nombre:', 'nombre') ?>
  <?= form_input('nombre', set_value('nombre', $nombre)) ?><br/>
  <?= form_submit('editar', 'Editar') ?>
  <?= anchor("/admin/paises/index", 'Volver') ?>
<?= form_close() ?>