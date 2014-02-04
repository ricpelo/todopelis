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
  
  function obtener_datos($id_penicula)
  {
    return $this->db->query("select * from peniculas
                             where id = ?", array($id_penicula));
  }
  
  function obtener_directores($id_penicula)
  {
    return $this->db->query("select * from directores where id_peniculas = ?", array($id_penicula));
  }
  
  function obtener_reparto($id_penicula)
  {
    return $this->db->query("select * from actores where id_peniculas = ?", array($id_penicula));
  }
  
  function obtener_generos($id_penicula)
  {
    return $this->db->query("select * from generos_de_penicula where id_peniculas = ?", array($id_penicula));
  }
  
  function obtener_paises($id_penicula)
  {
    return $this->db->query("select * from paises_de_penicula where id_peniculas = ?", array($id_penicula));
  }
}

