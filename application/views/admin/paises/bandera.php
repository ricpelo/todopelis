<h1>¿Desea añadir una bandera al pais $nombre?</h1>
<?= form_open_multipart('admin/paises/alta_bandera');?>
<input type="file" name="bandera" id="bandera"/>
<?= $error?> <br />
<?= form_submit('enviar', 'Subir');?>
<?= anchor('admin/paises/index', 'Indice Paises');?>
<?= form_hidden('nombre', $nombre);?>
<?= form_close();?>
