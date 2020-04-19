<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporans extends E_User {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('laporan');
	}

	public function index()
	{
		$data['result'] = $this->laporan->get_data();

		$this->template('laporan', $data);
	}
}
