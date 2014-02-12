<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends CI_Controller
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
      $nfilas = $this->Persona->num_filas();
      $npags = ceil($nfilas/$this->FPP);
      if ($pag > $npags) redirect("/admin/personas/index/1");

      $res = $this->Persona->todos("true",array(),$this->FPP,($pag - 1) * $this->FPP);
    }
    else{
      $where = "nombre like '%' || ? || '%'";
      $nfilas = $this->Persona->num_filas($where,array($criterio));
      $npags = ceil($nfilas/$this->FPP);
      if ($pag > $npags) redirect("/admin/personas/index/1");

      $res = $this->Persona->por_nombre($criterio);
    }
    
    $data['filas'] = $res;
    $data['criterio'] = $criterio;
    $data['pag'] = $pag;
    $data['npags'] = $npags;
    $data['vista'] = 'personas';

    $this->load->view('admin/personas/index', $data);  

  }
  
  function alta()
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[100]|callback__comprobar_minusculas'
      ),
      array(
        'field' => 'ano',
        'label' => 'Año',
        'rules' => 'trim|numeric|max_length[4]'
      )
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('admin/personas/alta');
    }
    else
    {
      $nombre = $this->input->post('nombre');
      $ano = $this->input->post('ano');
      $this->Persona->alta($nombre, $ano);
      redirect('admin/personas/index');
    }
  }

  function borrar($id = null)
  {
    if ($id == null) redirect('/admin/personas/index');

    $data['id'] = $id;
    $this->load->view('/admin/personas/borrar',$data);    
  }

  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Persona->borrar($id);
    }
    
    redirect('admin/personas/index');
  }
  
  function editar($id)
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[100]"
      ),
      
      array(
        'field' => 'ano',
        'label' => 'Año de nacimiento',
        'rules' => 'trim|numeric|max_length[4]|greater_than[0]'
      ),
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['id'] = $id;
      $data['fila'] = $this->Persona->obtener($id);
      $this->load->view('admin/personas/editar', $data);
    }
    else
    {
      $nombre = $this->input->post('nombre');
      $ano = $this->input->post('ano');
      $this->Persona->editar($id, $nombre, $ano);     
      redirect('admin/personas/index');
    }
  }
}

