<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class laporan extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_data($id = ""){
		$this->db->select('
			k.*,
			user.nama as nama_user,
			user.nik,
			user.tanggal_lahir,
			(select nama from wilayah where wilayah.id = k.wilayahid) as nama_wilayah,
			(select nama from wilayah_detail wd where wd.id = k.wilayahdetailid) as nama_wilayah_detail
		');
		$this->db->from('konsultasi k');
		$this->db->join('user', 'user.id = k.userid', 'left');
		if($id != ""){
			$this->db->where('k.id', $id);
		}
		$this->db->where('k.userid', $this->userid);
		$this->db->order_by('k.created', 'DESC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			if($id == ""){
				return $query->result_array();
			} else {
				return $query->row_array();
			}
		} else {
			return NULL;
		}
	}

}
?>
