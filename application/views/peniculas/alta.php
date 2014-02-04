<?= validation_errors() ?>
<?= form_open('/usuarios/alta') ?>
  <?= form_label('Nombre: ', 'nombre') ?>
  <?= form_input('nombre', set_value('nombre')) ?><br/>
  <?= form_label('Correo: ', 'email') ?>
  <?= form_input('email', set_value('email')) ?><br/>
  <?= form_label('Contraseña: ', 'password') ?>
  <?= form_password('password') ?><br/>
  <?= form_label('Confirmar contraseña: ', 'password_confirm') ?>
  <?= form_password('password_confirm') ?><br/>
  <?= form_submit('alta', 'Alta') ?>
  <?= anchor("/usuarios/index", 'Volver') ?>
<?= form_close() ?>

