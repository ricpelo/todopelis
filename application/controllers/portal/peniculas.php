<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de fichas
 */
class Peniculas extends CI_Controller 
{
  function cartelera()
  {
    $data['peniculas'] = $this->Penicula->cartelera();

    $this->load->view("portada/cartelera", $data);

  }
  
  function estrenos_dvd()
  {
    $data['peniculas'] = $this->Penicula->estrenos_dvd();
    $this->load->view("portada/estrenos_dvd", $data);

  }
  
  function ficha($id_penicula = null)
  {
    try
    {
      if ($id_penicula == null) throw new Exception("Película incorrecta");
    
      $datos = $this->Penicula->obtener_datos($id_penicula);
      $directores = $this->Penicula->obtener_directores($id_penicula);
      $reparto = $this->Penicula->obtener_reparto($id_penicula);
      $generos = $this->Penicula->obtener_generos($id_penicula);
      $paises = $this->Penicula->obtener_paises($id_penicula);
      
      $data['datos'] = $datos;
      $data['directores'] = $directores;
      $data['reparto'] = $reparto;
      $data['generos'] = $generos;
      $data['paises'] = $paises;
      
      $this->load->view('peniculas/ficha', $data);
    }
    catch (Exception $e)
    {
      $data['mensaje'] = $e->getMessage();
      
      $this->load->view('comunes/error', $data);
    }
  }
  
  function comentarios($id_penicula = null)
  {
    
  }
  
}
