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

  function alta($nombre, $ano)
  {
    if ($ano == "") {
      $this->db->query("insert into personas (nombre)
                               values (?)",
                               array($nombre));  
    }
    else{
      $this->db->query("insert into personas (nombre, ano)
                               values (?, ?)",
                               array($nombre, $ano));
    }
  }

  function borrar($id)
  {
    $this->db->query("delete from personas where id = ?", array($id));
  }
}

  
