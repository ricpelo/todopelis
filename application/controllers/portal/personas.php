<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends CI_Controller
{
  
  function ficha($id_persona = null)
  {
    $this->load->model('Persona');
    try
    {
      if ($id_persona == null) throw new Exception("Persona incorrecta");

      $data['datos'] = $this->Persona->obtener($id_persona);
      $res = $this->Persona->participa($id_persona);
      //$data['persona'] = $id_persona;
      if ($res) {
        $data['participa'] = $res;
      }
      else
      {
        throw new Exception("Pelis vacias");
      }
      $this->load->view('personas/ficha', $data);
    }
    catch (Exception $e)
    {
      $data['mensaje'] = $e->getMessage();
      
      $this->load->view('comunes/error', $data);
    }
  }
}