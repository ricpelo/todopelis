<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargo extends CI_Model
{

  function todos()
  {
    $res = $this->db->query("select * from cargos");
    
    return $res->result_array();
  }
  
  function buscar($cargo)
  {
    $res = $this->db->query("select * from cargos 
                              where nombre like '%' || ? || '%'", 
                              array($cargo));
                              
    return $res->result_array();
  }
  
  function borrar($id)
  {
    $res = $this->db->query("select * from cargos where id = ?",
                             array($id));
    
    if ($res->num_rows() == 1)
    {
      $this->db->query("delete from cargos where id = ?", array($id));
    }    
  }
  
  function obtener($id)
  {
    $res = $this->db->query("select * from cargos where id = ?", 
                              array($id));
    
    return $res->row_array();
  }
  
  function modificar($id, $nombre)
  {
    $res = $this->db->query("update cargos
                             set nombre = ?
                             where id = ?", array($nombre, $id));
  }

  function alta($nombre)
  {
    $res = $this->db->query("insert into cargos (nombre)
                             values(?)",array($nombre));
  }
}









