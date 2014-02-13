<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de fichas
 */
class Peniculas extends CI_Controller 
{
  
  var $FPP = 2;
  
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

      $data['datos'] = $this->Penicula->obtener_datos($id_penicula);
      $data['directores'] = $this->Penicula->obtener_directores($id_penicula);
      $data['reparto'] = $this->Penicula->obtener_reparto($id_penicula);
      $data['generos'] = $this->Genero->obtener_generos($id_penicula);
      $data['paises'] = $this->Penicula->obtener_paises($id_penicula);
      
      $this->load->view('peniculas/ficha', $data);
    }
    catch (Exception $e)
    {
      $data['mensaje'] = $e->getMessage();
      
      $this->load->view('comunes/error', $data);
    }
  }
  
  function comentarios($id_penicula = null, $pag = 1)
  {
    try
    {
      if ($id_penicula == null) throw new Exception("Película incorrecta");

      $nfilas = $this->Penicula->numero_comentarios($id_penicula);
      $npags = ceil($nfilas / $this->FPP);
     // if ($pag > $npags) redirect("portal/peniculas/comentarios/{$id_penicula}");

      $data['comentarios'] = $this->Penicula->comentarios($id_penicula, 
                                                          $this->FPP, 
                                                          ($pag - 1) * $this->FPP);
      $data['penicula'] = $id_penicula;
      $data['pag'] = $pag;
      $data['npags'] = $npags;
      
      $this->load->view('peniculas/comentarios', $data);
    }
    catch (Exception $e)
    {
      $data['mensaje'] = $e->getMessage();
      
      $this->load->view('comunes/error', $data);
    }
  }
  
}
