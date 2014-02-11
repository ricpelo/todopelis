<?= validation_errors() ?>

<h1> Editar peniculas </h1>
<?= form_open("/admin/peniculas/editar/$id") ?>
  <?= form_label('Titulo: ', 'titulo') ?>
  <?= form_input('titulo', set_value('titulo',$fila['titulo'])) ?><br/>

  <?= form_label('Año: ', 'ano') ?>
  <?= form_input('ano', set_value('ano',$fila['ano'])) ?><br/>

  <?= form_label('Duracion: ', 'duracion') ?>
  <?= form_input('duracion', set_value('duracion',$fila['duracion'])) ?><br/>

  <?= form_label('Sinopsis: ', 'sinopsis') ?>
  <?= form_input('sinopsis', set_value('sinopsis',$fila['sinopsis'])) ?><br/>

  <?= form_label('Cartel ', 'cartel') ?>
  <?= form_input('cartel', set_value('cartel',$fila['cartel'])) ?><br/>

  <?= form_label('Estreno (DD-MM-YYYY): ', 'estreno') ?>
  <?= form_input('estreno', set_value('estreno',$fila['estreno_format'])) ?><br/>

  <?= form_label('DVD (DD-MM-YYYY): ', 'dvd') ?>
  <?= form_input('dvd', set_value('dvd',$fila['dvd_format'])) ?><br/>

  <?= form_submit('enviar', 'Enviar') ?>
  <?= anchor("/admin/peniculas", 'Volver') ?>
<?= form_close() ?>

