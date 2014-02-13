<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model
{
  function todos($where = "true", $valores = array())
  {
    $res = $this->db->query("select * from usuarios where $where", $valores);
    return $res->result_array();
  }
  
  function por_nombre($nombre)
  {
    return $this->todos("usuario = ?", array($nombre));
  }

  function por_email($email)
  {
    return $this->todos("email like '%' || ? || '%'", array($email));
  }
  
  function existe($usuario, $password)
  {
    $res = $this->db->query("select *
                               from usuarios
                              where usuario = ? and password = md5(?)",
                            array($usuario, $password));
    return $res->num_rows() > 0;
  }
  function admin(){

    $id = 0;
    if ($this->session->userdata('id_login') != '')
    { 
      $id = $this->session->userdata('id_login');
    };

    $res = $this->db->query("select id
                               from admin where id_usuarios =  $id");

    return $res->num_rows() > 0;

  }
  
  function logueado()
  {
    return $this->session->userdata('id_login') != FALSE;
  }
  
  function buscar($columna, $criterio)
  {
    if ($criterio == '' || $criterio == FALSE)
    {
      $res = $this->todos();
    }
    else
    {
      switch ($columna)
      {
        case 'usuario':
          $res = $this->por_nombre($criterio);
          break;

        case 'email':
          $res = $this->por_email($criterio);
          break;
          
        default:
          $res = $this->todos();
          break;
      }
    }
    return $res;
  }
    
  function obtener_id($nombre)
  {
    $res = $this->todos("usuario = ?", array($nombre));
    
    if (!empty($res))
    {
      $fila = $res[0];
      return $fila['id'];
    }
    else
    {
      return FALSE;
    }
  }
  
  function obtener_nombre($id)
  {
    $res = $this->todos("id = ?", array($id));
    
    if (!empty($res))
    {
      $fila = $res[0];
      return $fila['usuario'];
    }
    else
    {
      return FALSE;
    }
  }
  
  function obtener($id)
  {
    $res = $this->todos("id = ?", array($id));
    return (!empty($res)) ? $res[0] : FALSE;
  }
  
  function comprobar_nombre($valor, $id)
  {
    $res = $this->db->query("select *
                               from usuarios
                              where id != ? and usuario = ?",
                           array($id, $valor));
    return $res->num_rows() == 0;
  }
  
  function editar($usuario, $email, $password, $id)
  {
    if ($password == "")
    {
      $this->db->query("update usuarios
                           set usuario = ?, email = ?
                         where id = ?", array($usuario, $email, $id));
    }
    else
    {
      $this->db->query("update usuarios
                           set usuario = ?, email = ?, password = md5(?)
                         where id = ?",
                       array($usuario, $email, $password, $id));
    }
  }
  
  function alta($nombre, $password, $email)
  {
    $res = $this->db->query("insert into usuarios (usuario, password, email)
                             values (?, md5(?), ?)",
                             array($nombre, $password, $email));
  }
  
  function borrar($id)
  {
    $this->db->query("delete from usuarios where id = ?", array($id));
  }
}

