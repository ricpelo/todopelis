<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pais extends CI_Model
{
  function todos($where = "true", $valores = array(), $limit = "", $offset = 0)
  {

    if($limit == "") $limit = "offset $offset";
    else             $limit = "limit $limit offset $offset";

    $res = $this->db->query("select * 
                               from paises 
                              where $where
                              order by nombre
                              $limit", $valores);
    return $res->result_array();
  }

  function num_filas($where = "true", $valores = array())
  {
    $res = $this->db->query("select count(*) as total
                               from paises
                               where $where", $valores);
    $res = $res->row_array();
    return $res['total'];
  }
  function por_nombre($nombre)
  {
    return $this->todos("nombre like '%' || ? || '%'", array($nombre));
  }

  function alta($nombre, $bandera)
  {
    if ($bandera == "") {
      $this->db->query("insert into paises (nombre)
                               values (?)",
                               array($nombre));  
    }
    else{
      $this->db->query("insert into paises (nombre, bandera)
                               values (?, ?)",
                               array($nombre, $bandera));
    }
  }

  function borrar($id)
  {
    $this->db->query("delete from paises where id = ?", array($id));
  }
}
