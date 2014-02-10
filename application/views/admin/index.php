<?= $this->load->helper('url');?>

<h1>Menu Principal</h1>

<?= anchor("/admin/peniculas/index", 'Gestionar Peniculas') ?>
<br />
<?= anchor("/portal/usuarios/administrar", 'Gestionar Usuarios') ?>
<br />
<?= anchor("/admin/personas/index", 'Gestionar Personas') ?>
<br />
<?= anchor("/admin/paises/index", 'Gestionar Paises') ?>
<br />
<?= anchor("/admin/cargos/index", 'Gestionar Cargos') ?>
<br />
<?= anchor("/admin/generos/index", 'Gestionar Generos') ?>
<br />