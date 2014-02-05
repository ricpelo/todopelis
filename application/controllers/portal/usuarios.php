<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $c = $this->uri->segment(1);
    $m = $this->uri->segment(2);

    if ($c != 'usuarios' || $m != 'login')
    {
      if (!$this->Usuario->logueado())
      {
        redirect('usuarios/login');
      }
    }
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('usuarios/login');
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
      redirect('tuits/index');
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
  
  function borrar($id = null)
  {
    if ($id == null) redirect("/usuarios/index");
    
    $data['id'] = $id;
    $this->template->load('comunes/plantilla', 'usuarios/borrar', $data);
  }
  
  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Usuario->borrar($id);
    }
    
    redirect('usuarios/index');
  }
  
  function alta()
  {
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
      redirect('usuarios/index');
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
    
    $this->template->load('comunes/plantilla', 'usuarios/index', $data);
  }

  function seguidores($seguido = null)
  {
    try
    {
      if ($seguido == null)
      {
        throw new Exception("No se ha indicado ningún nombre de usuario");
      }

      $id = $this->Usuario->obtener_id($seguido);
        
      if ($id == FALSE)
      {
        throw new Exception("No existe ningún usuario con ese nombre");
      }

      $data['seguidores'] = $this->Usuario->seguidores_de($id);
      $data['seguido'] = $seguido;
      $this->template->load('comunes/plantilla', 'usuarios/seguidores', $data);
    }
    catch (Exception $e)
    {
      $data['mensaje'] = $e->getMessage();
      $this->load->view('comunes/error', $data);
    }
  }
  
  function seguir()
  {
    $this->seguir_o_no_seguir('seguir');
  }

  function dejar_de_seguir()
  {
    $this->seguir_o_no_seguir('dejar_de_seguir');
  }
  
  function seguir_o_no_seguir($op)
  {
    $id = $this->input->post('id');
    if ($id == FALSE) redirect("/usuarios/index");
    $id_login = $this->session->userdata('id_login');
    call_user_func(array($this->Usuario, $op), $id_login, $id);
    $nombre = $this->Usuario->obtener_nombre($id);
    redirect("/tuits/tuits_de/$nombre");
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
      $this->template->load('comunes/plantilla', 'usuarios/editar', $data);
    }
    else
    {
      $usuario = $this->input->post('usuario');
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $this->Usuario->editar($usuario, $email, $password, $id);
      
      redirect('usuarios/index');      
    }
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
}

