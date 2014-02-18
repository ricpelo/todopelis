<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>


<?= form_open_multipart("admin/peniculas/subir_cartel/$id");?>
<?= form_label('Cartel:','cartel');?>
<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>