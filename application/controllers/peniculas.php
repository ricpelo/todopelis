<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de fichas
 */
class Fichas extends CI_Controller 
{
	
	function __construct($argument) 
	{
		
	}
  
  function ficha_de($id_penicula = null)
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
    
    $this->load->view('peniculas/ficha', $data, TRUE);
     
  }
  
}
