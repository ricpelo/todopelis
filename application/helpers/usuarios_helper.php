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

function borrar_tuit($id_tuit, $id_usuario)
{
  $CI =& get_instance();

  if ($CI->session->userdata('id_login') == $id_usuario)
  {
    $ret = form_open("/tuits/borrar") .
             form_hidden('id_tuit', $id_tuit) .
             form_submit('borrar', 'X') .
           form_close();
   
    return $ret;
  }
}

function seguir_o_no($id)
{
  $CI =& get_instance();
  
  $id_login = $CI->session->userdata('id_login');
  
  if ($id != $id_login)
  {
    if ($CI->Usuario->sigue_a($id_login, $id))
    {
      $ret = form_open("/usuarios/dejar_de_seguir") .
               form_hidden('id', $id) .
               form_submit('dejar_de_seguir', 'Dejar de seguir') .
             form_close();
    }
    else
    {
      $ret = form_open("/usuarios/seguir") .
               form_hidden('id', $id) .
               form_submit('seguir', 'Seguir') .
             form_close();
    }
  }
  else
  {
    $ret = "";
  }
  
  return $ret;
}
