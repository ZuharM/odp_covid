<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends E_Admin {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model(array('laporan'));
	}

	public function index()
	{
		$data = array();

		$this->template('home', $data);
	}

	public function laporans(){
		$data['result'] = $this->laporan->get_konsultasi();

		$this->template('laporan', $data);
	}

	public function view($uuid){
		$data['result'] = $this->laporan->get_konsultasi($uuid);

		$this->template('laporan_view', $data);
	}
}
