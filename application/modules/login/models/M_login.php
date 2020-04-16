<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_login extends CI_Model {

	function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	
	public function cek_user($data){
		$query = $this->db->get_where('user', $data);
		return $query;
	}

	public function cek_username($username){
		$this->db->from('user');
		$this->db->where('user.uname', $username);
		$query = $this->db->get();
		return $query;
	}

}
?>
