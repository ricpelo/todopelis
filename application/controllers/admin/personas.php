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
}

