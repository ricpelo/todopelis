<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de fichas
 */
class Peniculas extends CI_Controller 
{
  
  
  function index()
  {

    if ($this->session->flashdata('info')){
      $data['info'] = $this->session->flashdata('info');
    }else{
      $data['info']='';
    }
    $data['peniculas'] = $this->Penicula->cartelera();
    $res = $this->load->view("portada/cartelera", $data, TRUE);
    
    $data['peniculas'] = $this->Penicula->estrenos_cine();
    $res .= $this->load->view("portada/estrenos_cine", $data, TRUE);
    
    $data['peniculas'] = $this->Penicula->estrenos_dvd();
    $res .= $this->load->view("portada/estrenos_dvd", $data, TRUE);
        
    $this->load->view('comunes/plantilla', array('contents' => $res));

  }
  
  function estrenos_cine()
  {
    $data['peniculas'] = $this->Penicula->estrenos_cine();
    $this->load->view("portada/estrenos_cine", $data);
  }
  
  function cartelera()
  {
    $data['peniculas'] = $this->Penicula->cartelera();
    $this->load->view("portada/cartelera", $data);
  }
  
  function estrenos_dvd()
  {
    $data['dvds'] = $this->Penicula->estrenos_dvd();
    return $this->load->view("portada/estrenos_dvd", $data, TRUE);
  }
  
  
  function ficha_de($id_penicula = null)
  {
    $data['peniculas'] = $this->Penicula->estrenos_dvd();
    $this->load->view("portada/estrenos_dvd", $data);
  }
  
  function ficha($id_penicula = null)
  {
    try
    {
      if ($id_penicula == null) throw new Exception("Película incorrecta");
      
      if ($this->session->flashdata('mensaje'))
      {
        $data['mensaje'] = $this->session->flashdata('mensaje');
      }
      else
      {
      	$data['mensaje'] = '';
      }
      

      $data['datos'] = $this->Penicula->obtener_datos($id_penicula);
      $data['directores'] = $this->Penicula->obtener_directores($id_penicula);
      $data['reparto'] = $this->Penicula->obtener_reparto($id_penicula);
      $data['generos'] = $this->Genero->obtener_generos($id_penicula);
      $data['paises'] = $this->Penicula->obtener_paises($id_penicula);
      
      $this->template->load('comunes/plantilla', 'peniculas/ficha', $data);
    }
    catch (Exception $e)
    {
      $data['mensaje'] = $e->getMessage();
      
      $this->template->load('comunes/plantilla', 'comunes/error', $data);
    }
  }
  
  
  
}
