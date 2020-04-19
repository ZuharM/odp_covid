<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Laporan extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_konsultasi($uuid = ""){
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
		if($uuid != ""){
			$this->db->where('k.uuid', $uuid);
		}

		$this->db->order_by('k.created', 'DESC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			if($uuid == ""){
				return $query->result_array();
			} else {
				return $query->row_array();
			}
		} else {
			return NULL;
		}
	}

	function get_rekapitulasi($uuid, $konsultasi_ke){
		$this->db->select('
			kd.id, 
			kd.cf_combine,
			kd.konsultasi_ke
		');
		$this->db->from('konsultasi_detail kd');
		$this->db->where('kd.uuid', $uuid);
		$this->db->where('kd.konsultasi_ke', $konsultasi_ke);
		$this->db->order_by('kd.id', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return NULL;
		}
	}

}
?>
