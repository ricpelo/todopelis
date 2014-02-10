<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paises extends CI_Controller
{
  var $FPP = 2;
  
  function index($pag = 1)
  {
    $this->load->model('Pais');
    
    $criterio = trim(strtolower($this->input->post('criterio')));

    if ($criterio == FALSE){
      $criterio = '';
      $nfilas = $this->Pais->num_filas();
      $npags = ceil($nfilas/$this->FPP);
      if ($pag > $npags) redirect("/admin/paises/index/1");

      $res = $this->Pais->todos("true",array(),$this->FPP,($pag - 1) * $this->FPP);
    }
    else{
      $res = $this->Pais->por_nombre($criterio);
    }
    
    $data['filas'] = $res;
    $data['criterio'] = $criterio;
    $data['pag'] = $pag;
    $data['npags'] = $npags;

    $this->load->view('admin/paises/index', $data);  

  }

  function alta()
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[30]|callback__comprobar_minusculas'
      ),
      array(
        'field' => 'bandera',
        'label' => 'Bandera',
        'rules' => 'trim'
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
      $ano = $this->input->post('bandera');
      $this->Pais->alta($nombre, $bandera);
      redirect('admin/paises/index');
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