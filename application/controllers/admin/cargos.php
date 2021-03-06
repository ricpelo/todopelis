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

    if ($genero != '')
    {
      $data['generos'] = $this->Genero->todos();  
    }
    else
    {
      $data['generos'] = $this->Genero->buscar($genero);
    }
    $data['nombre'] = $genero; 
    $this->template->load('comunes/plantilla', 'generos/ver_generos', $data);
  }
  
  function borrar($id)
  {
    if ($id != '')
    {
      $this->Genero->borrar($id);
    }
    redirect("/admin/generos/index"); 
  
  }
  
  function modificar($id)
  {
    $genero = trim($this->input->post('nombre'));
   
    
    if ($genero == FALSE || $genero == '')
    {
      $data['genero'] = $this->Genero->obtener($id);
      
      $this->load->view("generos/modificar", $data);  
    }
    else 
    {
      $this->Genero->modificar($id, $genero);
    }
    
  }

  function alta($genero = '')
  {
    $genero = trim($this->input->post('nombre'));

    if ($genero == FALSE || $genero == '')
    {
      $data['genero'] = '';
      $this->load->view("generos/alta",$data);
    }
    else
    {
      $this->Genero->alta($genero);

      redirect("/admin/generos/index"); 
    }

  }
}

