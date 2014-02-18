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

  function alta($nombre)
  {
    $res = $this->db->query("insert into paises (nombre)
                               values (?) returning id",
                               array($nombre)); 
  }

  function anadir_bandera($id,$bandera)
  {
    $this->db->query("update paises
                         set bandera = ?
                       where id = ?", array($bandera,$id));
  }

  function borrar($id)
  {
    $this->db->query("delete from paises where id = ?", array($id));
  }
  
  function obtener($id)
  {
    $res = $this->db->query("select * from paises where id = ?", array($id));
    
    return $res->row_array();
  }
  
  function existe_nombre($nombre){
    $res= $this->db->query("select * from paises where nombre = ?", array($nombre));
    
    return ($res->num_rows() == 1) ? TRUE : FALSE;
  }
  
  function editar($id, $nombre)
  {
    $this->db->query("update paises
                           set nombre = ?
                         where id = ?", array($nombre, $id));
  }
  
  function editar_bandera($id, $bandera)
  {
    $this->db->query("update paises
                         set bandera = ?
                         where id = ?", array($bandera, $id));
  }

  function obtener_id($nombre)
  {
    $ret = $this->db->query("select id 
                               from paises
                              where nombre = ?", array($nombre));
    $ret = $ret->row_array();
    return $ret['id'];
  }
}
