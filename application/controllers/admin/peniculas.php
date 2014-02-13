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
    if($this->session->flashdata('cartel'))
    {
    	$data['cartel'] = $this->session->flashdata('cartel');
    }
    else
    {
    	$data['cartel'] = '';
    }
    if($this->session->flashdata('alta'))
    {
    	$data['alta'] = $this->session->flashdata('alta');
    }
    else
    {
    	$data['alta'] = '';
    }
    if($this->session->flashdata('borrar'))
    {
    	$data['borrar'] = $this->session->flashdata('borrar');
    }
    else
    {
    	$data['borrar'] = '';
    }
    $data['filas'] = $res;
    $data['nombre'] = $nombre;
    $this->template->load('comunes/plantilla', 'admin/peniculas/index', $data);
    
 
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
      $data['estreno'] = ($this->input->post('estreno') != '') ? $this->input->post('estreno'): null;
      $data['alta'] = ($this->input->post('alta') != '') ? $this->input->post('alta'): null;
      $data['dvd'] = ($this->input->post('dvd') != '') ? $this->input->post('dvd'): null;

      
      
      $this->Penicula->alta($data);
      $this->session->set_flashdata('alta','Penicula <b>'.$data['titulo'].'</b> insertada correctamente');
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
    $penicula = $this->Penicula->obtener_datos($id);
    $titulo = $penicula['titulo'];

    if ($id != FALSE)
    {
      $this->Penicula->borrar($id);
    }
    
    $this->session->set_flashdata('borrar','La penicula <b>'.$titulo.'</b> se ha borrado correctamente');
    redirect('admin/peniculas/index');
  }

  function subir_cartel($id = null)
  {
  	 
      if ($id != null)
      {
        $config['upload_path'] = './uploads/carteles';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = '100';
          $config['max_width'] = '1024';
          $config['max_height'] = '768';
          $this->load->library('upload', $config);

          if (!$this->upload->do_upload())
          {
            $data['error'] = $this->upload->display_errors();
            $data['id'] = $id;
            $this->load->view('admin/peniculas/cartel', $data);
            
          }
          else
          {
            $datos = $this->upload->data();
            $file = $datos['file_name'];
            $data = array('id' => $id, 'url' => $file);
            $penicula = $this->Penicula->obtener_datos($id);           
            $this->Penicula->cartel($data);
            $this->session->set_flashdata('cartel', 'Cambiado el cartel de la pelicula <b>'.$penicula['titulo'].'</b>');
            redirect("admin/peniculas/index");
           
          }
      }
      else
      {
      	echo 'falta el id'; 
        redirect('admin/peniculas/index');
      }
                 
    
    }
}



  	










    /*$reglas = array(
      array(
        'field' => 'cartel',
        'label' => 'Cartel',
        'rules' => 'trim'
     
      )      
    );

    $this->form_validation->set_rules($reglas);
    $data['id'] = $id;

    if ($this->form_validation->run() == FALSE)
    {
     
      $this->load->view('admin/peniculas/cartel');
    }
    else
    {
      
      $cartel = ($this->input->post('cartel') != '') ? $this->input->post('cartel'): null;

      $this->Penicula->editar($cartel);
  	$this->load->view('admin/peniculas/index');
  */
  



