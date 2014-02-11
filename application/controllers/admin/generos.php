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
    $data['nombre'] = $genero; 
    $this->load->view('generos/ver_generos', $data);
  }
}

