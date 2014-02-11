<?= validation_errors() ?>
<?= form_open("portal/usuarios/login") ?>
  <?= form_label('Usuario:', 'usuario') ?>
  <?= form_input('usuario', set_value('usuario')) ?><br/>
  <?= form_label('Contraseña:', 'password') ?>
  <?= form_password('password') ?><br/>
  <?= form_submit('login', 'Login') ?>
<?= form_close() ?>
