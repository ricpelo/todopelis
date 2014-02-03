<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de fichas
 */
class Peniculas extends CI_Controller 
{
	

  function index()
  {
    $this->load->model('Penicula');
    $data['peniculas'] = $this->Penicula->cartelera();
    $this->load->view("cartelera", $data);
  }
}
