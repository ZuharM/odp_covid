<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Umum extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_wilayahdetail($wilayahid){
		$this->db->select('
			wd.*
		');
 		$this->db->from('wilayah_detail wd');
		$this->db->where('wd.wilayahid', $wilayahid);

		$this->db->order_by('wd.id', 'ASC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return NULL;
		}
	}
}

?>