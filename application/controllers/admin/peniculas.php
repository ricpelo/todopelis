<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peniculas extends CI_Controller
{
  
  function index()
  {
   
    $nombre = trim($this->input->post('nombre'));

    if($nombre == FALSE || $nombre == '')
      $res = $this->Penicula->todas();
    else
      $res = $this->Penicula->buscar($nombre);  
    
    $data['filas'] = $res;
    $data['nombre'] = $nombre;
    
    
    $this->load->view('peniculas/index', $data);
  }

  
  /*
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
  }*/

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

  /*function _comprobar_minusculas($valor)
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
  }*/

  
 
  /*
  function editar($id)
  {
    $reglas = array(
      array(
        'field' => 'usuario',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[15]|callback__penicula_unica[$id]"
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
  
  function _penicula_unica($valor, $id)
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
  }*/
}

