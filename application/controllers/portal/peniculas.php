<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de fichas
 */
class Peniculas extends CI_Controller 
{
<<<<<<< HEAD
	

 function index()
  {
    $res = $this->cartelera();
    $res .= $this->estrenos_cine();
    $res .= $this->estrenos_dvd();
    
    $this->load->view('comunes/plantilla', array('contents' => $res));
  }

  function cartelera()
  {
    $data['peniculas'] = $this->Penicula->cartelera();
    return $this->load->view("/portada/cartelera", $data, TRUE);
  }
 
  function estrenos_cine()
  {
    $data['peniculas'] = $this->Penicula->estrenos_cine();
    return $this->load->view("portada/estrenos_cine", $data, TRUE);
=======
  function cartelera()
  {
    $data['peniculas'] = $this->Penicula->cartelera();

    $this->load->view("portada/cartelera", $data);

>>>>>>> 9b929498ee338c57792f9697c2685f6f8129dc07
  }
  
  function estrenos_dvd()
  {
<<<<<<< HEAD
    $data['dvds'] = $this->Penicula->estrenos_dvd();
    return $this->load->view("portada/estrenos_dvd", $data, TRUE);
  }
  
  
  function ficha_de($id_penicula = null)
=======
    $data['peniculas'] = $this->Penicula->estrenos_dvd();
    $this->load->view("portada/estrenos_dvd", $data);

  }
  
  function ficha($id_penicula = null)
>>>>>>> 9b929498ee338c57792f9697c2685f6f8129dc07
  {
    try
    {
      if ($id_penicula == null) throw new Exception("Película incorrecta");

      $data['datos'] = $this->Penicula->obtener_datos($id_penicula);
      $data['directores'] = $this->Penicula->obtener_directores($id_penicula);
      $data['reparto'] = $this->Penicula->obtener_reparto($id_penicula);
      $data['generos'] = $this->Penicula->obtener_generos($id_penicula);
      $data['paises'] = $this->Penicula->obtener_paises($id_penicula);
      
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
