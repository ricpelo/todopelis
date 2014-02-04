<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penicula extends CI_Model
{
  function cartelera()
  {
    $this->load->database();
    $res = $this->db->query("select id, titulo, cartel, estreno 
                               from peniculas 
                              where estreno > (current_date - 30)
                                and estreno <= current_date;
                                          ");
    return $res->result_array();
  }


  function cine()
  {
    $this->load->database();
    $res = $this->db->query("select id, titulo, cartel, estreno 
                               from peniculas 
                              where estreno < (current_date + 30)
                                and estreno > current_date;
                                          ");
    return $res->result_array();
  }


  function dvd()
  {
    $this->load->database();
    $res = $this->db->query("select id, titulo, cartel, estreno 
                               from peniculas 
                              where estreno < (current_date + 30)
                                and estreno > current_date;
                                          ");
    return $res->result_array();
  }
}

