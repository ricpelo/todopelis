<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Personas extends CI_Controller {
  public function index()
  {
    $criterio = trim($this->input->post('criterio'));

    $res = $this->Persona->todos();

    if ($criterio == FALSE) $criterio = '';

    $opciones = array('nombre' => 'Nombre');
    
    $data['filas'] = $res;
    $data['criterio'] = $criterio;
    
    $this->load->view('admin/personas/index', $data);  }
}
