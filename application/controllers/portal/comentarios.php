<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de comentarios
 */
class Comentarios extends CI_Controller 
{
  
  var $FPP = 1;
  
  function index($id_penicula = null, $pag = 1)
  {
    try
    {
      if ($id_penicula == null) throw new Exception("Película incorrecta");

      $nfilas = $this->Comentario->numero_comentarios($id_penicula);
      $npags = ceil($nfilas / $this->FPP);
      if ($pag > $npags) redirect("portal/comentarios/{$id_penicula}");

      $data['comentarios'] = $this->Comentario->comentarios($id_penicula, 
                                                          $this->FPP, 
                                                          (($pag - 1) * $this->FPP));
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
  