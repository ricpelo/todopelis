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