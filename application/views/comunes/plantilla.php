<h2>Todopelis</h2>
<?= form_open("/portal/usuarios/logout") ?>
  <p align="right">Usuario: <?= usuario_logueado() ?>
  <?= form_submit('logout', 'Logout') ?></p>
<?= form_close() ?>
<?= $contents ?>
<hr/>
<?= anchor("/portal/usuarios/index", 'Inicio') ?>