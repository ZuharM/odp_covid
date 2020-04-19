<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Konsultasi extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_angka_bobot($id){
		$this->db->select('
			b.*
		');
		$this->db->from('bobot b');
		$this->db->where('b.id', $id);
		$query = $this->db->get();
		return $query->row()->angka;
	}

	function get_angka_indikator($id){
		$this->db->select('
			i.*
		');
		$this->db->from('indikator i');
		$this->db->where('i.id', $id);
		$query = $this->db->get();
		return $query->row()->angka;
	}

	function get_konsultasi_detail($uuid){
		$this->db->select('
			kd.pertanyaanid,
			kd.bobot_jawab_id
		');
		$this->db->from('konsultasi_detail kd');
		$this->db->where('kd.uuid', $uuid);
		$this->db->order_by('kd.id', 'ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_pertanyaan($where = "", $id = ""){
		$this->db->select('
			p.*
		');
		$this->db->from('pertanyaan p');
		if($where != ""){
			$this->db->where('p.id', $where);
		}
		if($id != ""){
			$this->db->where_not_in('p.indikatorid', $id);
		}

		$this->db->order_by('p.id', 'ASC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			$arr_result = array();
			foreach ($result as $key => $val) {
				$arr_result[$key] = $val;
				$arr_result[$key]['bobot'] = $this->get_bobot($val['pil_jawaban']);
			}
			return $arr_result;
		} else {
			return NULL;
		}
	}

	/*function get_bobot($where_in = ""){
		$this->db->select('
			bobot.*
		');
		$this->db->from('bobot');
		if($where_in != ""){
			$this->db->where('bobot.id IN ('.$where_in.')');
		}
		$this->db->order_by('bobot.id', 'ASC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return NULL;
		}
	}*/

	function get_bobot($where_in = "", $id = ""){
		$this->db->select('
			bobot.*
		');
		$this->db->from('bobot');
		if($where_in != ""){
			$this->db->where('bobot.id IN ('.$where_in.')');
		}
		if($id != ""){
			$this->db->where('bobot.id', $id);
		}

		$this->db->order_by('bobot.id', 'ASC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			if($id != ""){
				return $query->row_array();
			}
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	function get_indikator($id = ""){
		$this->db->select('
			i.*
		');
		$this->db->from('indikator i');
		if($id != ""){
			$this->db->where('i.id', $id);
		}
		$this->db->order_by('i.id', 'ASC');

		$query = $this->db->get();
		if($query->num_rows() > 0){
			if($id != ""){
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
