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
			(select nama from user where user.id = k.userid) as nama_user
		');
		$this->db->from('konsultasi k');
		if($uuid != ""){
			$this->db->where('k.uuid', $uuid);
		}
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

	/*function get_angka_indikator($id){
		$this->db->select('
			i.*
		');
		$this->db->from('indikator i');
		$this->db->where('i.id', $id);
		$query = $this->db->get();
		return $query->row()->angka;
	}*/

	/*function get_penyakit(){
		$this->db->select('
			penyakit.*
		');
		$this->db->from('penyakit');
		if($id != ""){
			$this->db->where('bumil.id', $id);
		}
		$this->db->where('bumil.userid', $this->userid);
		$this->db->order_by('bumil.created', 'DESC');

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
	}*/

	/*function get_bumil_detail($bumilid){
		$this->db->select('
			bd.id as bumildetailid,
			bd.berat,
			bd.tinggi,
			bd.lingkar,
			bd.tanggal,
			bd.read,
			bd.read_tanggal,
			bumil.*,
			(select nama from posyandu where posyandu.id = bd.posyanduid) as nama_posyandu,
			(select nama from user where user.id = bd.kaderid) as nama_kader
		');
		$this->db->from('bumil');
		$this->db->join('bumil_detail bd', 'bumil.id = bd.bumilid', 'inner');
		$this->db->where('bd.bumilid', $bumilid);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	function get_balita($id = ""){
		$this->db->select('
			balita.*
		');
		$this->db->from('balita');
		if($id != ""){
			$this->db->where('balita.id', $id);
		}
		$this->db->where('balita.userid', $this->userid);
		$this->db->order_by('balita.created', 'DESC');

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

	function get_balita_detail($balitaid){
		$this->db->select('
			bd.id as balitadetailid,
			bd.berat,
			bd.tinggi,
			bd.lingkar,
			bd.tanggal,
			bd.read,
			bd.read_tanggal,
			balita.*,
			(select nama from posyandu where posyandu.id = bd.posyanduid) as nama_posyandu,
			(select nama from user where user.id = bd.kaderid) as nama_kader
		');
		$this->db->from('balita');
		$this->db->join('balita_detail bd', 'balita.id = bd.balitaid', 'inner');
		$this->db->where('bd.balitaid', $balitaid);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function get_jadwal_balita()
	{
		$this->db->select('*');
		$this->db->from('balita_detail bd');
		$this->db->join('balita', 'balita.id = bd.balitaid', 'left');
		$this->db->where('balita.userid', $this->userid);
		$this->db->order_by('bd.tanggal', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function get_jadwal_bumil()
	{
		$this->db->select('*');
		$this->db->from('bumil_detail bd');
		$this->db->join('bumil', 'bumil.id = bd.bumilid', 'left');
		$this->db->where('bumil.userid', $this->userid);
		$this->db->order_by('bd.tanggal', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return NULL;
		}
	}*/

}
?>
