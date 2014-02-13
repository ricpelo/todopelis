<?= validation_errors() ?>
<?= form_open("portal/usuarios/editar/$id") ?>
  <?= form_label('Nombre:', 'usuario') ?>
  <?= form_input('usuario', set_value('usuario', $fila['usuario'])) ?><br/>
  <?= form_label('Correo:', 'email') ?>
  <?= form_input('email', set_value('email', $fila['email'])) ?><br/>
  <?= form_label('Contraseña:', 'password') ?>
  <?= form_password('password') ?><br/>
  <?= form_label('Confirmar contraseña:', 'password_confirm') ?>
  <?= form_password('password_confirm') ?><br/>
  <?= form_submit('editar', 'Editar') ?>
  <?= anchor("/usuarios/index", 'Volver') ?>
<?= form_close() ?>

