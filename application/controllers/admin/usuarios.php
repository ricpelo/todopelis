<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends CI_Controller {
  public function index()
  {
    $this->load->view('admin/index');
  }
}