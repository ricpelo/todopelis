
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Todopelis</title>
</head>
<body>
    <?php
      $imagen = array('src' => "/uploads/todopelisBueno.jpeg", 'height' => '100', 'width' => '1000'); 
    ?><!--by ibañez xD -->
    <?= img($imagen); ?>
  
   <?= form_open("/portal/usuarios/logout") ?>

    <?php if (get_instance()->Usuario->logueado()): ?>
      <p align="right">Usuario: <?= usuario_logueado() ?>
      <?= form_submit('logout', 'Logout') ?></p>
    <?php else: ?>
      <p align = "right">¿No tienes cuenta? <?= anchor("/portal/usuarios/alta", "Registrate") ?></p>
      <p align="right"><?= form_submit('login', 'Login') ?></p>
    <?php endif ?>   
  <?= form_close() ?>
  <hr/>
  <div>
    <h3>Buscador</h3>

      <?= form_open("/portal/peniculas/buscar") ?>
        <p>Buscar:
        <?=  form_input('busqueda', ''); ?>
        <?= form_submit('buscar', 'Buscar') ?></p>   
      <?= form_close() ?>
  </div>

  <hr/>
  <?= $contents ?>
  <hr />
  <?= anchor("/portal", 'Inicio'); ?> 
  <?php if($this->Usuario->logueado()): ?>
    <?php if($this->Usuario->admin()): ?>
      <?= anchor("/admin/usuarios", 'Menu Principal');?>
    <?php endif ?>
  <?php endif ?>
</body>
</html>
