<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends CI_Controller
{
  function index()
  {
    $this->load->model('Persona');
    
    $criterio = trim(strtolower($this->input->post('criterio')));

    if ($criterio == FALSE){
      $criterio = '';
      $res = $this->Persona->todos();
    }
    else{
      $res = $this->Persona->por_nombre($criterio);
    }
    
    $data['filas'] = $res;
    $data['criterio'] = $criterio;
    
    $this->load->view('admin/personas/index', $data);  

  }
  
  function alta()
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[100]|callback__comprobar_minusculas'
      ),
      array(
        'field' => 'ano',
        'label' => 'Año',
        'rules' => 'trim|numeric|max_length[4]'
      )
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('admin/personas/alta');
    }
    else
    {
      $nombre = $this->input->post('nombre');
      $ano = $this->input->post('ano');
      $this->Persona->alta($nombre, $ano);
      redirect('admin/personas/index');
    }
  }

  function borrar($id = null)
  {
    if ($id == null) redirect('/admin/personas/index');

    $data['id'] = $id;
    $this->load->view('/admin/personas/borrar',$data);    
  }

  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Persona->borrar($id);
    }
    
    redirect('admin/personas/index');
  }
  
  function editar($id)
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[100]"
      ),
      
      array(
        'field' => 'ano',
        'label' => 'Año de nacimiento',
        'rules' => 'trim|numeric|max_length[4]|greater_than[0]'
      ),
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['id'] = $id;
      $data['fila'] = $this->Persona->obtener($id);
      $this->load->view('admin/personas/editar', $data);
    }
    else
    {
      $nombre = $this->input->post('nombre');
      $ano = $this->input->post('ano');
      $this->Persona->editar($id, $nombre, $ano);     
      redirect('admin/personas/index');
    }
  }
}

