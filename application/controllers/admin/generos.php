<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generos extends CI_Controller
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
  function index()
  {
    $genero = trim($this->input->post('nombre'));

    if ($genero == '')
    {
      $data['generos'] = $this->Genero->todos();  
    }
    else
    {
      $data['generos'] = $this->Genero->buscar($genero);
    }
    if ($this->session->flashdata('info'))
    {
      $data['info'] = $this->session->flashdata('info');
    }
    else
    {
      $data['info'] = '';
    }
    $data['nombre'] = $genero; 
    $this->template->load('comunes/plantilla', 'generos/ver_generos', $data);
  }
  
  function borrar($id)
  {
    if ($id != '')
    {
      $this->Genero->borrar($id);
      redirect("/admin/generos/index"); 
    }

    redirect("/admin/generos/index"); 
  
  }
  
  function modificar($id)
  {
    $genero = $this->Genero->obtener($id);
    $nombre = $genero['nombre'];
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[50]|callback__generos_existe[$nombre]"
      ),
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['nombre'] = $nombre;
      $data['id'] = $id;
      $this->load->view("generos/modificar", $data);  
    }
    else 
    {
      $genero = trim($this->input->post('nombre'));
      $this->Genero->modificar($id, $genero);
      $this->session->set_flashdata('info', 
                                    'El genero se modificó correctamente');
      redirect('admin/generos/index');
    }
  }
  
  function _genero_existe($nombre)
  {
    if ($this->Genero->existe($nombre))
    {
      $this->form_validation->set_message('_genero_existe',
                                          'El genero ya existe');
      return FALSE;
    }
    else 
    {
      return TRUE;
    }
  }

  function alta($genero = '')
  {
    
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[50]|callback__generos_existe($nombre)'
      )
    );

    $this->form_validation->set_rules($reglas);

    if ($this->form_validation->run() == FALSE)
    {

      $data['genero'] = '';
      $this->load->view('generos/alta', $data); 
    }
    else
    {
      $genero = $this->input->post('nombre');
      $this->Genero->alta($genero);
      $this->session->set_flashdata('info','se insertó correctamente');
      redirect("admin/generos/index"); 

    }
  }
}

