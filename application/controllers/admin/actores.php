<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actores extends CI_Controller {
  public function index()
  {
    $criterio = trim($this->input->post('criterio'));
    $columna = trim($this->input->post('columna'));

    $res = $this->Actor-> ;

    if ($criterio == FALSE) $criterio = '';
    if ($columna == FALSE) $columna = 'usuario';

    $opciones = array('usuario' => 'Nombre', 'email' => 'e-mail');
    
    $data['filas'] = $res;
    $data['opciones'] = $opciones;
    $data['columna'] = $columna;
    $data['criterio'] = $criterio;
    
    $this->template->load('comunes/plantilla', 'usuarios/index', $data);  }
}
