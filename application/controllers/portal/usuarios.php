<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $d = $this->uri->segment(1);
    $c = $this->uri->segment(2);
    $m = $this->uri->segment(3);

    if ($d != 'portal' || $c != 'usuarios' || $m != 'login' && $m != 'alta')
    {
     	if (!$this->Usuario->logueado())
      {
        redirect('/portal/usuarios/login');
      }
    }
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('/portal');
  }
  
  function login()
  {
    $usuario = $this->input->post('usuario');
  
    $reglas = array(
      array(
        'field' => 'usuario',
        'label' => 'Usuario',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => "trim|required|callback__usuario_existe[$usuario]"
      ),
    );
    


    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('usuarios/login');
    }
    else
    {
      $id = $this->Usuario->obtener_id($usuario);
      $this->session->set_userdata('id_login', $id);
      $data['id_usuario'] = $id;
      if ($this->Usuario->admin($id)){
        redirect('/admin/usuarios/index');
      }
      else
      {
      redirect('/portal');
      }
    }
  }
  
  function _usuario_existe($password, $usuario)
  {
    if ($this->Usuario->existe($usuario, $password))
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_usuario_existe',
                                          'Usuario o contraseña incorrectos');
      return FALSE;
    }
  }
  function _comprobar_minusculas($valor)
  {
    if (strtolower($valor) == $valor)
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_comprobar_minusculas',
                  'El campo %s debe estar en minúsculas');
      return FALSE;
    }
  }

  function index()
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

    $this->template->load('comunes/plantilla', '/usuarios/index', $data);
  }

  function _usuario_unico($valor, $id)
  {
    if ($this->Usuario->comprobar_nombre($valor, $id))
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_usuario_unico',
                       'Ya existe un usuario con ese nombre');
      return FALSE;
    }
  }
 
  function alta()
  {

    if (!$this->Usuario->logueado()){
      $reglas = array(
        array(
          'field' => 'nombre',
          'label' => 'Nombre',
          'rules' => 'trim|required|max_length[15]|is_unique[usuarios.usuario]|callback__comprobar_minusculas'
        ),
        array(
          'field' => 'email',
          'label' => 'Correo',
          'rules' => 'trim|required|max_length[75]|valid_email'
        ),
        array(
          'field' => 'password',
          'label' => 'Contraseña',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'password_confirm',
          'label' => 'Confirmar contraseña',
          'rules' => 'trim|required|matches[password]'
        )      
      );
      
      $this->form_validation->set_rules($reglas);
      
      if ($this->form_validation->run() == FALSE)
      {
        $this->template->load('comunes/plantilla', 'usuarios/alta');
      }
      else
      {
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->Usuario->alta($nombre, $password, $email);
        $this->session->set_flashdata('info', 'Creado correctamente, puede loguearse.');
        redirect('portal');
      }
    }else{
      $this->session->set_flashdata('info', 'Acceso denegado');
      redirect('portal/');
    }
  }
  
}

