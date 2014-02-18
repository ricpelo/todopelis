<?php echo $error;?>

<?php $this->load->helper('html'); ?>

<?php echo form_open_multipart("admin/paises/editar_bandera/$id");?>
  <input type="file" name="bandera" /><br />
  <?= ($bandera == null) ? 'El país no tiene asociado una bandera' : img($bandera) ?>
  
  <br />
  
  <input type="submit" value="Añadir bandera" /><br />
  <?= anchor("/admin/paises/index", 'Omitir') ?>
</form>