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
  
  function estrenos_cine()
  {
    $res = $this->db->query("select id, titulo, cartel, estreno 
                               from peniculas 
                              where estreno <= (current_date + 30)
                                and estreno > current_date;
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


  function alta($data)
  {
    $res = $this->db->query("insert into peniculas (titulo, ano, duracion,sinopsis,cartel,estreno,dvd)
                             values ( ?, ?, ?, ?, ?, ?, ?)",
                             array($data['titulo'], $data['ano'],$data['duracion'],$data['sinopsis'],
                              $data['cartel'],$data['estreno'],$data['dvd']));
  }

  
  function estrenos_dvd()
  { 
    $res = $this->db->query("select id, titulo, cartel,dvd
                               from peniculas 
                              where estreno < (current_date + 30)
                                and estreno > current_date;
                                          ");
    return $res->result_array();
  }
  function obtener_datos($id_penicula)
  {
    $res = $this->db->query("select * from peniculas
                             where id = ?", array($id_penicula));
                             
    return $res->row_array();
  }
  
  function obtener_directores($id_penicula)
  {
    $res = $this->db->query("select * from directores 
                             where id_peniculas = ?", array($id_penicula));
                             
    return $res->result_array();
  }
  
  function obtener_reparto($id_penicula)
  {
    $res = $this->db->query("select * from actores 
                             where id_peniculas = ?", array($id_penicula));
                             
    return $res->result_array();
  }
  
  function obtener_paises($id_penicula)
  {
    $res = $this->db->query("select * from paises_de_penicula 
                             where id_peniculas = ?", array($id_penicula));
                             
    return $res->result_array();
  }

}
