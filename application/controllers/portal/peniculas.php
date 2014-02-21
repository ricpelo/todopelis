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
  
  function ficha_de($id_penicula = null)
  {
    $data['peniculas'] = $this->Penicula->estrenos_dvd();
    $res = $this->load->view("portada/estrenos_dvd", $data);
  }

  function buscar(){
    $titulo = trim($this->input->post('busqueda'));

    $busq = $this->Penicula->buscar($titulo)[0]['id'];

    echo "<script>alert($busq);</script>";
    //Asegurarse de que el array tiene cosicas
    $data['busqueda'] = $busq;

    $this->ficha($data['busqueda']);

  }
  
  function ficha($id_penicula = null)
  {
    try
    {
      if ($id_penicula == null) throw new Exception("Película incorrecta");

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
      
      $this->load->view('comunes/error', $data);
    }
  }
  
  
  
}
