<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function usuario_logueado()
{
  $CI =& get_instance();
  
  $id_login = $CI->session->userdata('id_login');
  
  return $CI->Usuario->obtener_nombre($id_login);
}

function id_login()
{
  $CI =& get_instance();
  return $CI->session->userdata('id_login');
}
function paginado($pag, $npags)
{
  $CI =& get_instance();

  
  $ret = anchor('admin/personas/index/1', 'inicio');

  for ($i=1; $i <= $npags ; $i++) { 
    $ret .= anchor("admin/personas/index/$i", "- $i");
  }

  if ($pag != $npags) $ret .= anchor("admin/personas/index/$npags", '- fin');

  return $ret;
  
}