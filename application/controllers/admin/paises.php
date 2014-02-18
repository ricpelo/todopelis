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
    $this->load->view('admin/paises/index', $data);  

  }

  function alta_bandera(){
    $nombre = $this->input->post('nombre');
    $id = $this->Pais->obtener_id($nombre);
    $config['upload_path'] = './uploads/banderas';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $id;
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('bandera'))
    {
      $data['error']= $this->upload->display_errors();
      $data['id'] = $id;
      $this->load->view('admin/paises/bandera', $data);
    }
    else
    {
      $bandera = "uploads/banderas/" . $id;
      $this->Pais->anadir_bandera($id, $bandera);
      redirect('admin/paises/index');
    }
  }

  function alta()
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[30]|is_unique[paises.nombre]|callback__comprobar_minusculas'
      )
    );

    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('admin/paises/alta');
    }
    else
    {
      $nombre = $this->input->post('nombre');
      
      $this->Pais->alta($nombre);
      $data['error']= "";
      $data['nombre']= $nombre;
      $this->load->view('admin/paises/bandera', $data);
    }
  }

  function borrar($id = null)
  {
    if ($id == null) redirect('/admin/paises/index');

    $data['id'] = $id;
    $this->load->view('/admin/paises/borrar',$data);    
  }

  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Pais->borrar($id);
    }
    
    redirect('admin/paises/index');
  }
}