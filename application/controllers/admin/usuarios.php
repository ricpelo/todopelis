<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
	function __construct()
  {
    parent::__construct();
    $d = $this->uri->segment(1);

    if ($d == 'admin')
    {
      if (!$this->Usuario->logueado())
      {
        redirect('/portal/usuarios/login');
      }
      if(!$this->Usuario->admin())
      {
        redirect('/portal');
      }
    }
  
  }
  public function index()
  {
    $this->template->load('comunes/plantilla', 'admin/index');
  }

  function indexGestion()
  {
    $criterio = trim($this->input->post('criterio'));
    $columna = trim($this->input->post('columna'));

    $res = $this->Usuario->buscar($columna, $criterio);

    if ($criterio == FALSE) $criterio = '';
    if ($columna == FALSE) $columna = 'usuario';

    $opciones = array('usuario' => 'Nombre', 'email' => 'e-mail');
    
    $data['filas'] = $res;
    $data['opciones'] = $opciones;
    $data['columna'] = $columna;
    $data['criterio'] = $criterio;

    if ($this->session->flashdata('info'))
    {
      $data['info'] = $this->session->flashdata('info');
    }
    else
    {
      $data['info'] = '';
    }
    
    $this->template->load('comunes/plantilla', '/admin/usuarios/index', $data);
  }

  function editar($id)
  {
    $reglas = array(
      array(
        'field' => 'usuario',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[15]|callback__usuario_unico[$id]"
      ),
      array(
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => 'trim|matches[password_confirm]'
      ),
      array(
        'field' => 'password_confirm',
        'label' => 'Confirmar contraseña',
        'rules' => 'trim'
      ),
      array(
        'field' => 'email',
        'label' => 'Correo',
        'rules' => 'trim|max_length[75]|valid_email'
      )
    );

    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['id'] = $id;
      $data['fila'] = $this->Usuario->obtener($id);
      $this->template->load('comunes/plantilla', 'admin/usuarios/editar', $data);
    }
    else
    {
      $usuario = $this->input->post('usuario');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $this->session->set_flashdata('info', 'Usuario editado correctamente');
      $this->Usuario->editar($usuario, $email, $password, $id);
      
      redirect('admin/usuarios/indexGestion');      
    }
  }
  function borrar($id = null)
  {
    if ($id == null) redirect("admin/usuarios/index");
    
    $data['id'] = $id;
    $this->template->load('comunes/plantilla', 'admin/usuarios/borrar', $data);
  }
  
  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Usuario->borrar($id);
    }
    $this->session->set_flashdata('info', 'Usuario borrado correctamente');
    redirect('admin/usuarios/indexGestion');
  }
}
