<h2>Modificar generos</h2>

<?= validation_errors();?>
<?= form_open("admin/generos/modificar/$id"); ?>
  <?= form_label("Nombre", "nombre"); ?>
  <?= form_input("nombre", $nombre); ?>
  <?= form_submit("modificar", "Modificar") ?>
<?= form_close(); ?>
