<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peniculas extends CI_Controller
{
  
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
  function index()
  {
    $nombre = trim($this->input->post('nombre'));

    if ($nombre == FALSE || $nombre == '')
    {
      $res = $this->Penicula->todas();
    }
    else
    {
      $res = $this->Penicula->buscar($nombre);
    }
    
    $data['filas'] = $res;
    $data['nombre'] = $nombre;
    
    $this->load->view('admin/peniculas/index', $data);
  }

  function alta()
  {
  	$fecha = $this->input->post('estreno');
    


    $reglas = array(
      array(
        'field' => 'titulo',
        'label' => 'Titulo',
        'rules' => 'trim|required|max_length[100]'
      ),
      array(
        'field' => 'ano',
        'label' => 'Año',
        'rules' => 'trim|numeric|max_length[4]'
      ),
       array(
        'field' => 'duracion',
        'label' => 'Duracion',
        'rules' => 'trim|numeric|max_length[3]'
      ),
        array(
        'field' => 'sinopsis',
        'label' => 'Sinopsis',
        'rules' => 'trim'
      ),
      array(
        'field' => 'cartel',
        'label' => 'Cartel',
        'rules' => 'trim'
      ),
       array(
        'field' => 'estreno',
        'label' => 'Estreno',
        'rules' => "trim|callback__validar_fecha[$fecha]"
      ),
       
      array(
        'field' => 'dvd',
        'label' => 'DVD',
        'rules' => "trim|callback__validar_fecha[$fecha]"
      )      
    );
    

    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('admin/peniculas/alta');
      
    }
    else
    {
      $data['titulo'] = $this->input->post('titulo');
      $data['ano'] =  ($this->input->post('ano') != '') ? $this->input->post('ano'): null;
      $data['duracion'] = ($this->input->post('duracion') != '') ? $this->input->post('duracion'): null;
      $data['sinopsis'] = ($this->input->post('sinopsis') != '') ? $this->input->post('sinopsis'): null;
      $data['cartel'] = ($this->input->post('cartel') != '') ? $this->input->post('cartel'): null;
      $data['estreno'] = ($this->input->post('estreno') != '') ? $this->input->post('estreno'): null;
      $data['alta'] = ($this->input->post('alta') != '') ? $this->input->post('alta'): null;
      $data['dvd'] = ($this->input->post('dvd') != '') ? $this->input->post('dvd'): null;

      
      
      $this->Penicula->alta($data);
      redirect('admin/peniculas/index');
    }
  }

  
  function _validar_fecha($fecha)
  {

  	$fecha = explode('-',$fecha);
  	if (count($fecha) == 3 )
  	{  			  	
		$dia = trim($fecha[0]);
	  	$mes = trim($fecha[1]);
	  	$ano = trim($fecha[2]);	  

	  	$ret = '';

		if (checkdate($mes,$dia,$ano))
    	{
    		$ret = TRUE;
    	} 
    	else
		{
			$this->form_validation->set_message('_validar_fecha','Formato de fecha %s incorrecto');
			$ret = FALSE;
		}
  	}
  	else if (count($fecha) == 1 && $fecha[0] == '')
  	{
  		$ret = TRUE;
  	}
  	else
    {
    	$this->form_validation->set_message('_validar_fecha','Falta o sobran datos en %s');
    	$ret = FALSE;
    }

    	return $ret;	    
   
  }

  
 
  
  function editar($id)
  {
  	$fecha = $this->input->post('estreno');

    $reglas = array(
      array(
        'field' => 'titulo',
        'label' => 'Titulo',
        'rules' => 'trim|required|max_length[100]'
      ),
      array(
        'field' => 'ano',
        'label' => 'Año',
        'rules' => 'trim|numeric|max_length[4]'
      ),
       array(
        'field' => 'duracion',
        'label' => 'Duracion',
        'rules' => 'trim|numeric|max_length[3]'
      ),
        array(
        'field' => 'sinopsis',
        'label' => 'Sinopsis',
        'rules' => 'trim'
      ),
      array(
        'field' => 'cartel',
        'label' => 'Cartel',
        'rules' => 'trim'
      ),
       array(
        'field' => 'estreno',
        'label' => 'Estreno',
        'rules' => "trim|callback__validar_fecha[$fecha]"
      ),
       
      array(
        'field' => 'dvd',
        'label' => 'DVD',
        'rules' => "trim|callback__validar_fecha[$fecha]"
      )      
    );

    $this->form_validation->set_rules($reglas);
    $data['id'] = $id;

    if ($this->form_validation->run() == FALSE)
    {
      $data['fila'] = $this->Penicula->obtener_datos($id);
      $this->load->view('admin/peniculas/editar', $data);
    }
    else
    {
      
      $data['titulo'] = $this->input->post('titulo');
      $data['ano'] =  ($this->input->post('ano') != '') ? $this->input->post('ano'): null;
      $data['duracion'] = ($this->input->post('duracion') != '') ? $this->input->post('duracion'): null;
      $data['sinopsis'] = ($this->input->post('sinopsis') != '') ? $this->input->post('sinopsis'): null;
      $data['cartel'] = ($this->input->post('cartel') != '') ? $this->input->post('cartel'): null;
      $data['estreno'] = ($this->input->post('estreno') != '') ? $this->input->post('estreno'): null;
      $data['alta'] = ($this->input->post('alta') != '') ? $this->input->post('alta'): null;
      $data['dvd'] = ($this->input->post('dvd') != '') ? $this->input->post('dvd'): null;

      $this->Penicula->editar($data);
      
      redirect('admin/peniculas');      
    }
  }
    
  function borrar($id = null)
  {
    if ($id == null) redirect("admin/peniculas/index");
    
    $data['id'] = $id;
    $this->load->view('admin/peniculas/borrar', $data);
  }
  
  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Penicula->borrar($id);
    }
    
    redirect('admin/peniculas/index');
  }
  
}

