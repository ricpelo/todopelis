<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function paginado_comentarios($id_penicula, $pag, $npags)
{
  $CI =& get_instance();

  $ret = anchor("portal/comentarios/index/{$id_penicula}", "Inicio");

  for ($i=1; $i <= $npags ; $i++) { 
    $ret .= anchor("portal/comentarios/index/{$id_penicula}/$i", "- $i");
  }

  if ($pag != $npags) $ret .= anchor("portal/comentarios/index/{$id_penicula}/$npags", '- Fin');

  return $ret;
  
}

function mostrar_comentario($id_penicula)
{
  $CI =& get_instance();
  
  if ($CI->Usuario->logueado())
  {
    $ret = form_open("portal/comentarios/comentar/$id_penicula");
    $ret .= "<textarea name='comentario' rows='8' cols='40'></textarea>";
    $ret .= form_submit("comentar", "Comentar");
    $ret .= form_close();
  }
  else
  {
    $ret = "<h3>Logueate para poder comentar</h3>";
  }
  
  return $ret;
  
}

function eliminar_comentario($logueado, $propietario, $id_comentario, $id_penicula)
{
  $CI =& get_instance();
  
  if ($CI->Usuario->logueado())
  {
    if ($logueado == $propietario)
    {
      $hidden = array('propietario' => $propietario,
                      'comentario' => $id_comentario);
      $ret = form_open("portal/comentarios/borrar/$id_penicula", '', $hidden);
      $ret .= form_submit("eliminar", "Eliminar");
      $ret .= form_close();
      
    }
    else
    {
      $ret = '';
    }
    
  }
  else
  {
    $ret = '';
  }
  
  return $ret;
}
