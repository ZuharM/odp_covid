<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends E_User {

	public function __construct()
	{
	    parent::__construct();
	    //$this->load->model('laporan');
	}

	public function index()
	{
		$data = array();

		$this->template('home', $data);
	}
}
