<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Todopelis</title>
</head>
<body>
	<h1>Todopelis</h1>
  <?= form_open("/portal/usuarios/logout") ?>
    <p align="right">Usuario: <?= usuario_logueado() ?>
    <?= form_submit('logout', 'Logout') ?></p>
  <?= form_close() ?>
  <hr/>
  <?= $contents ?>
  <hr />
  <?= anchor("/portal", 'Inicio') ?>
</body>
</html>


