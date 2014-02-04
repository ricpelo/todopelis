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
  
  function estrenos_dvd()
  { 
    $this->load->database();
    $res = $this->db->query("select id, titulo, cartel,dvd
                               from peniculas 
                              where dvd > (current_date - 30)
                                and dvd <= current_date;
                                          ");
    return $res->result_array();
  }
}

