<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generos extends CI_Controller
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
    $criterio = trim($this->input->post('nombre'));

    if ($criterio == '')
    {
      $nfilas = $this->Genero->num_filas();
      $npags = ceil($nfilas/$this->FPP); 
      if ($pag > $npags)
      {
        redirect("/admin/generos/index/1");
      } 
      $genero = $this->Genero->todos("true",array(),$this->FPP,($pag - 1) * $this->FPP);  
    }
    else
    {
      $where = "nombre like '%' || ? || '%'";
      $nfilas = $this->Genero->num_filas($where, array($criterio));
      $npags = ceil($nfilas/$this->FPP); 
      if ($pag > $npags)
      {
        redirect("/admin/generos/index/1");
      } 
      $genero = $this->Genero->todos($where, array($criterio), $this->FPP, ($pag - 1) * $this->FPP);
    }
    if ($this->session->flashdata('info'))
    {
      $info = $this->session->flashdata('info');
    }
    else
    {
      $info = '';
    }
    
    $data['pag'] = $pag;
    $data['info'] = $info;
    $data['nfilas'] = $nfilas;
    $data['npags'] = $npags;
    $data['generos'] = $genero;
    $data['nombre'] = $criterio;
    $data['vista'] = 'generos';
    $this->template->load('comunes/plantilla', 'generos/ver_generos', $data);
  }
  
  function borrar($id)
  {
    if ($id != '')
    {
      $this->Genero->borrar($id);
      redirect("/admin/generos/index"); 
    }

    redirect("/admin/generos/index"); 
  
  }
  
  function modificar($id)
  {
    $genero = $this->Genero->obtener($id);
    $nombre = $genero['nombre'];
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[50]|callback__genero_existe[$nombre]"
      ),
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['nombre'] = $nombre;
      $data['id'] = $id;
      $this->load->view("generos/modificar", $data);  
    }
    else 
    {
      $genero = trim($this->input->post('nombre'));
      $this->Genero->modificar($id, $genero);
      $this->session->set_flashdata('info', 
                                    'El genero se modificó correctamente');
      $this->output->clear_page_cache('admin/generos/index');
      redirect('admin/generos/index');
    }
  }
  
  function _genero_existe($nombre)
  {
    if ($this->Genero->existe($nombre))
    {
      $this->form_validation->set_message('_genero_existe',
                                          'El genero ya existe');
      return FALSE;
    }
    else 
    {
      return TRUE;
    }
  }

  function alta($genero = '')
  {
    
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => 'trim|required|max_length[50]|callback__generos_existe($nombre)'
      )
    );

    $this->form_validation->set_rules($reglas);

    if ($this->form_validation->run() == FALSE)
    {

      $data['genero'] = '';
      $this->load->view('generos/alta', $data); 
    }
    else
    {
      $genero = $this->input->post('nombre');
      $this->Genero->alta($genero);
      $this->session->set_flashdata('info','se insertó correctamente');
      redirect("admin/generos/index"); 

    }
  }
}

