<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de comentarios
 */
class Comentarios extends CI_Controller 
{
  
  var $FPP = 10;
  
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
      $data['usuario'] = $this->session->userdata('id_login');
      
      $this->template->load('comunes/plantilla', 'peniculas/comentarios', $data);
    }
    catch (Exception $e)
    {
      $data['mensaje'] = $e->getMessage();
      
      $this->template->load('comunes/plantilla', 'comunes/error', $data);
    }
  }
  
  function comentar($id_penicula)
  {
    $usuario = $this->session->userdata('id_login');
    $comentario = $this->input->post('comentario');
    
    $this->Comentario->comentar($comentario, $usuario, $id_penicula);
    
    $this->session->set_flashdata('mensaje','Comentario realizado.');
    
    redirect("/portal/peniculas/ficha/{$id_penicula}");
  }
  
  function borrar($id_penicula)
  {
    $usuario = $this->input->post('propietario');
    $id_comentario = $this->input->post('comentario');
    
    $this->Comentario->borrar($usuario, $id_comentario);
    
    redirect("/portal/comentarios/index/{$id_penicula}");
  }
  
}
  