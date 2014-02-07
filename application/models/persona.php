<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona extends CI_Model
{
  function todos($where = "true", $valores = array())
  {
    $res = $this->db->query("select * 
                               from personas 
                              where $where", $valores);
    return $res->result_array();
  }

  function por_nombre($nombre)
  {
    return $this->todos("nombre like '%' || ? || '%'", array($nombre));
  }
  
  function obtener($id)
  {
    $res = $this->todos("id = ?", array($id));
    return (!empty($res)) ? $res[0] : FALSE;
  }
  
  function editar($id, $nombre, $ano)
  {
      $this->db->query("update personas
                           set nombre = ?, ano = ?
                         where id = ?", array($nombre, $ano, $id));
  }
}

