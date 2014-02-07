<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends CI_Controller
{
  public function index()
  {
    $this->load->model('Persona');
    
    $criterio = trim($this->input->post('criterio'));

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
        'rules' => 'trim|greater_than[0]'
      )
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

