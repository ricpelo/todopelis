<h2>Alta generos</h2>
<?= validation_errors() ?>
<?= form_open("admin/generos/alta"); ?>
  <?= form_label("Nombre", "nombre"); ?>
  <?= form_input("nombre", $genero); ?>
  <?= form_submit("alta", "Alta") ?>
<?= form_close(); ?>