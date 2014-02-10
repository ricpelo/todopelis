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
    
    
    $this->load->view('admin/peniculas/index', $data);
  }

  
  
  function alta()
  {

    


    $reglas = array(
      array(
        'field' => 'titulo',
        'label' => 'Titulo',
        'rules' => 'trim|required|max_length[100]'
      ),
      array(
        'field' => 'ano',
        'label' => 'Año',
        'rules' => 'trim|numeric|max_length[4]'
      ),
       array(
        'field' => 'duracion',
        'label' => 'Duracion',
        'rules' => 'trim|numeric|max_length[3]'
      ),
        array(
        'field' => 'sinopsis',
        'label' => 'Sinopsis',
        'rules' => 'trim'
      ),
      array(
        'field' => 'cartel',
        'label' => 'Cartel',
        'rules' => 'trim'
      ),
       array(
        'field' => 'estreno',
        'label' => 'Estreno',
        'rules' => 'trim'
      ),
       
      array(
        'field' => 'dvd',
        'label' => 'DVD',
        'rules' => 'trim'
      )      
    );
    

    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('admin/peniculas/alta');
      $estrenoCompleta = $this->input->post('estreno');

      $cortadas = explode('/',$estrenoCompleta);

      var_dump($cortadas); // NOS QUEDAMOS AQUI !!!
    }
    else
    {
      $data['titulo'] = $this->input->post('titulo');
      $data['ano'] = $this->input->post('ano');
      $data['duracion'] = $this->input->post('duracion');
      $data['sinopsis'] = $this->input->post('sinopsis');
      $data['cartel'] = $this->input->post('cartel');
      $data['estreno'] = $this->input->post('estreno');
      $data['alta'] = $this->input->post('alta');
      $data['dvd'] = $this->input->post('dvd');

      $this->Penicula->alta($data);
      redirect('admin/peniculas/index');
    }
  }
/*
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
  
  function borrar($id = null)
  {
    if ($id == null) redirect("admin/peniculas/index");
    
    $data['id'] = $id;
    $this->load->view('admin/peniculas/borrar', $data);
  }
  
  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Penicula->borrar($id);
    }
    
    redirect('admin/peniculas/index');
  }
  
}

