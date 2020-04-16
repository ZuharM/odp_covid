<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporans extends E_User {

	public function __construct()
	{
	    parent::__construct();
	    //$this->load->model('laporan');
	}

	public function index()
	{
		$data['result'] = $this->global_model->get('konsultasi', '*', array('userid' => $this->userid));

		$this->template('laporan', $data);
	}
}
