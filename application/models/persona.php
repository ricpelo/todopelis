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
}

