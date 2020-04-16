<?php defined('BASEPATH') OR exit('No direct script access allowed');

class E_Admin extends MY_Controller{

  public function __construct() {
    parent::__construct();

    if($this->session->userdata('level') != 'admin'){
      redirect('login/logout', 'refresh');
    }
  }

  public function template($page, $data=null)
  {
    $this->load->view('template/header', $data);
    $this->load->view('template/left', $data);
    $this->load->view($page, $data);
    $this->load->view('template/footer', $data);
  }

} 
?>
