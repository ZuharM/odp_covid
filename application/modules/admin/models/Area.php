<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Area extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_data_wilayah(){
		$this->db->select('
			wilayah.*
		');
		$this->db->from('wilayah');
		$this->db->order_by('wilayah.nama', 'ASC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	function get_data_wilayah_detail(){
		$this->db->select('
			wd.*,
			wilayah.nama as nama_wilayah
		');
		$this->db->from('wilayah_detail wd');
		$this->db->join('wilayah', 'wilayah.id = wd.wilayahid', 'left');
		$this->db->order_by('wd.wilayahid, wd.nama', 'ASC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function cek_detail($data, $id = ""){
		$this->db->from('wilayah_detail wd');
		$this->db->where($data);
		if($id != ""){
			$this->db->where_not_in('wd.id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
?>
