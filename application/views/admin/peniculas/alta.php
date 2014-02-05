<?= validation_errors() ?>
<?= form_open('admin/peniculas/alta') ?>
  <?= form_label('Titulo: ', 'titulo') ?>
  <?= form_input('titulo', set_value('titulo')) ?><br/>

  <?= form_label('Año: ', 'ano') ?>
  <?= form_input('ano', set_value('ano')) ?><br/>

  <?= form_label('Duracion: ', 'duracion') ?>
  <?= form_input('duracion', set_value('duracion')) ?><br/>

  <?= form_label('Sinopsis: ', 'sinopsis') ?>
  <?= form_input('sinopsis', set_value('sinopsis')) ?><br/>

  <?= form_label('Cartel ', 'cartel') ?>
  <?= form_input('cartel', set_value('cartel')) ?><br/>

  <?= form_label('Estreno: ', 'estreno') ?>
  <?= form_input('estreno', set_value('estreno')) ?><br/>

  <?= form_label('DVD: ', 'dvd') ?>
  <?= form_input('dvd', set_value('dvd')) ?><br/>

  <?= form_submit('enviar', 'Enviar') ?>
  <?= anchor("admin/peniculas/index", 'Volver') ?>
<?= form_close() ?>

