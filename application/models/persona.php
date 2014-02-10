<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona extends CI_Model
{

  function todos($where = "true", $valores = array(), $limit = "", $offset = 0)
  {

    if($limit == "") $limit = "offset $offset";
    else             $limit = "limit $limit offset $offset";

    $res = $this->db->query("select * 
                               from personas 
                              where $where
                              order by id
                              $limit", $valores);
    return $res->result_array();
  }

  function num_filas()
  {
    $res = $this->db->query("select count(*) as total
                               from personas");
    $res = $res->row_array();
    return $res['total'];
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

  
