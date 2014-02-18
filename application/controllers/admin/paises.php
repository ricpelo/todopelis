<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paises extends CI_Controller
{
  var $FPP = 10;

  function __construct()
  {
    parent::__construct();
    $d = $this->uri->segment(1);

    if ($d == 'admin')
    {
      if (!$this->Usuario->logueado())
      {
        redirect('/portal/usuarios/login');
      }
      if(!$this->Usuario->admin())
      {
        redirect('/portal');
      }
    }
  
  }
  
  function index($pag = 1)
  {    
    $criterio = trim(strtolower($this->input->post('criterio')));

    if ($criterio == FALSE){
      $criterio = '';
      $nfilas = $this->Pais->num_filas();
      $npags = ceil($nfilas/$this->FPP);
      if ($pag > $npags) redirect("/admin/paises/index/1");

      $res = $this->Pais->todos("true",array(),$this->FPP,($pag - 1) * $this->FPP);
    }
    else{
      $where = "nombre like '%' || ? || '%'";
      $nfilas = $this->Pais->num_filas($where,array($criterio));
      $npags = ceil($nfilas/$this->FPP);
      if ($pag > $npags) redirect("/admin/paises/index/1");
      $res = $this->Pais->por_nombre($criterio);
    }
    
    $data['filas'] = $res;
    $data['criterio'] = $criterio;
    $data['pag'] = $pag;
    $data['npags'] = $npags;
    $data['vista'] = 'paises';
    $this->template->load('comunes/plantilla', 'admin/paises/index', $data);
  }

  function editar($id)
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[30]|callback__pais_unico[$id]"
      )
    );

    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['id'] = $id;
      $datos = $this->Pais->obtener($id);
      $data['nombre'] = $datos['nombre'];
      
      $this->load->view("/admin/paises/editar", $data);
    }
    else
    {
      $nombre = $this->input->post('nombre');
      $this->Pais->editar($id, $nombre);
      redirect("/admin/paises/editar_bandera/$id");
    }
  }
  
  function editar_bandera($id)
  {
    $config['upload_path'] = './uploads/banderas';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $id;
    $config['overwrite'] = TRUE;
    
    $this->load->library("upload", $config);
    
    if (!$this->upload->do_upload('bandera'))
    {
      $data['error'] = $this->upload->display_errors();
      
      $data['id'] = $id;
      
      $datos = $this->Pais->obtener($id);
      $data['bandera'] = $datos['bandera'];

      $this->load->view('/admin/paises/editar_bandera', $data);
    }
    else
    {
      $datos = $this->upload->data();
      $bandera = "/uploads/banderas/" . $id . $datos['file_ext'];
      $this->Pais->editar_bandera($id, $bandera);
      
      redirect('/admin/paises/index');
    }
  }
  
  function _pais_unico($valor, $id)
  {
    $fila = $this->Pais->obtener($id);
    $nombre = $fila['nombre'];
    
    if ($valor != $nombre && $this->Pais->existe_nombre($valor))
    {
      $this->form_validation->set_message('_pais_unico',
                                          'El nombre del país ya existe en la base de datos');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }
}