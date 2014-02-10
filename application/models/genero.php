<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genero extends CI_Model
{
  function obtener_generos($id_penicula = "")
  {
        
    $res = $this->db->query("select * from generos_de_penicula 
                             where id_peniculas = ?", array($id_penicula));
                             
    return $res->result_array();
  }
  
  function todos()
  {
    $res = $this->db->query("select * from generos");
    
    return $res->result_array();
  }
  
  function buscar($genero)
  {
    $res = $this->db->query("select * from generos 
                              where nombre like '%' || ? || '%'", 
                              array($genero));
                              
    return $res->result_array();
  }
}
