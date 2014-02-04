<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penicula extends CI_Model
{
  function cartelera()
  {
    
    $res = $this->db->query("select id, titulo, cartel, estreno 
                               from peniculas 
                              where estreno > (current_date - 30)
                                and estreno <= current_date;
                                          ");
    return $res->result_array();
  }

  function todas()
  {
    $res = $this->db->query("select * 
                             from peniculas
                             order by alta desc");

    return $res->result_array();
  }

  function buscar($nombre)
  {
    $res = $this->db->query("select * 
                             from peniculas
                             where titulo like '%' || ? || '%'
                             order by alta desc",array($nombre));

    return $res->result_array();
  }
}

