<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genero extends CI_Model
{
  function obtener_generos($id_penicula = "")
  {
        
    $res = $this->db->query("select * from generos_de_penicula 
                             where id_peniculas = ?", array($id_penicula));
                             
    return $res->result_array();
  }
  
  function todos($where = "true", $valores = array(), $limit = "", $offset = 0)
  {

    if($limit == "") $limit = "offset $offset";
    else             $limit = "limit $limit offset $offset";

    $res = $this->db->query("select * 
                               from generos 
                              where $where
                              order by id
                              $limit", $valores);
    return $res->result_array();
  }
  
  function buscar($genero)
  {
    $res = $this->db->query("select * from generos 
                              where nombre like '%' || ? || '%'", 
                              array($genero));
                              
    return $res->result_array();
  }
  
  function borrar($id)
  {
    $res = $this->db->query("select * from generos where id = ?",
                             array($id));
    
    if ($res->num_rows() == 1)
    {
      $this->db->query("delete from generos where id = ?", array($id));
    }    
  }
  
  function obtener($id)
  {
    $res = $this->db->query("select * from generos where id = ?", 
                              array($id));
    
    return $res->row_array();
  }
  
  function modificar($id, $nombre)
  {
    $res = $this->db->query("update generos
                             set nombre = ?
                             where id = ?", array($nombre, $id));
  }
  function existe($nombre)
  {
    $res = $this->db->query("select * from generos 
                            where nombre = ?", array($nombre));
    
    return $res->num_rows() > 0;
  }

  function alta($nombre)
  {
    $res = $this->db->query("insert into generos (nombre)
                             values(?)",array($nombre));

  }
  
  function num_filas($where = "true", $valores = array())
  {
    $res = $this->db->query("select count(*) as total
                               from generos
                               where $where", $valores);
    $res = $res->row_array();
    return $res['total'];
  }
}









