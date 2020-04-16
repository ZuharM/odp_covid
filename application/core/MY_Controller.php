<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct() {
    parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
    
    if(!$this->session->userdata('userid')){
      redirect('login', 'refresh');
    } else {
      $this->nama   = $this->session->userdata('nama');
      $this->level  = $this->session->userdata('level');
      $this->userid   = $this->session->userdata('userid');
      $this->username = $this->session->userdata('username');
    }

    $this->datenow = date('Y-m-d H:i:s', time());
    $this->uuid = UUID::v5(mt_rand(0, 0xffff).microtime().time());
  }

} 
?>
