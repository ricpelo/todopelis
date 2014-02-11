<h2>Modificar generos</h2>

<?= form_open("admin/generos/modificar"); ?>
  <?= form_label("Nombre", "nombre"); ?>
  <?= form_input("nombre", $genero['nombre']); ?>
  <?= form_submit("modificar", "Modificar") ?>
<?= form_close(); ?>
