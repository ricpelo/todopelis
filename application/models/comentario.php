<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comentario extends CI_Model
{
  
  function comentarios($id_penicula, $fpp = 10, $comienzo = 0)
  {
    $res = $this->db->query("select * from comentarios_v 
                             where id_peniculas = ?
                             order by id
                             limit $fpp
                             offset $comienzo", array($id_penicula));
    
    return $res->result_array();
  }

  function numero_comentarios($id_penicula)
  {
    $res = $this->db->query("select * from comentarios_v
                                    where id_peniculas = ?", array($id_penicula));
    return $res->num_rows();
  }
  
  function comentar($comentario, $usuario, $penicula)
  {
    $res = $this->db->query("insert into comentarios (critica, id_usuarios, id_peniculas)
                             values (?, $usuario, $penicula)", array($comentario));
  }
  
  function borrar($usuario, $id_comentario)
  {
    $res = $this->db->query("delete from comentarios
                              where id_usuarios = ? and
                              id = ?", array($usuario, $id_comentario));
  }
  
}