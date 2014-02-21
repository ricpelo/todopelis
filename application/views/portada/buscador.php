<h3>Buscador</h3>
<div>
  <?= form_open("/portal/usuarios/logout") ?>
    <p>Buscar:
    <?=  form_input('busqueda', ''); ?>
    <?= form_submit('buscar', 'Buscar') ?></p>
    
  <?= form_close() ?>
</div>
<hr/>