<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generos extends CI_Controller
{
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
    if ($this->session->flashdata($info))
    {
      $data['info'] = $this->session->flashdata($info);
    }
    else
    {
      $data['info'] = '';
    }
    $data['nombre'] = $genero; 
    $this->load->view('generos/ver_generos', $data);
  }
  
  function borrar($id)
  {
    if ($id != '')
    {
      $this->Genero->borrar($id);
    }
    else
    {
     redirect("/admin/generos/index"); 
    }
  }
  
  function modificar($id)
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[50]'
      ),
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['genero'] = $this->Genero->obtener($id);
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
    if (!$this->Genero->existe($nombre))
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
}

