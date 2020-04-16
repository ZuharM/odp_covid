<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('notifikasi')) {
	function notifikasi(){
		$CI = get_instance();
		$CI->load->database();
		$userid = $CI->session->userdata('userid');

		$CI->db->select('
			"bumil" as kode,
			bd.id as detailid,
			bd.berat,
			bd.tinggi,
			bd.lingkar,
			bd.tanggal,
			bd.read,
			bd.read_tanggal,
			bumil.id as id
			');
		$CI->db->from('bumil_detail bd');
		$CI->db->join('bumil', 'bd.bumilid = bumil.id', 'left');
		$CI->db->order_by('bd.tanggal', 'DESC');
		$CI->db->where('bumil.userid', $userid);  
		$CI->db->where('bd.read', 0); 

		$cek_data1 	= $CI->db->get();
		$hasil1 	= $cek_data1->result_array();
		$jlh1 		= $cek_data1->num_rows();

		$CI->db->select('
			"balita" as kode,
			bd.id as detailid,
			bd.berat,
			bd.tinggi,
			bd.lingkar,
			bd.tanggal,
			bd.read,
			bd.read_tanggal,
			balita.id as id
			');
		$CI->db->from('balita_detail bd');
		$CI->db->join('balita', 'bd.balitaid = balita.id', 'left');
		$CI->db->order_by('bd.tanggal', 'DESC');
		$CI->db->where('balita.userid', $userid);  
		$CI->db->where('bd.read', 0); 

		$cek_data2 	= $CI->db->get();
		$hasil2 	= $cek_data2->result_array();
		$jlh2 		= $cek_data2->num_rows();

		$CI->db->select('
			n.table as kode,
			n.detailid,
			"" as berat,
			"" as tinggi,
			"" as lingkar,
			"" as tanggal,
			n.read,
			n.read_tanggal,
			case
				when n.table = "balita_detail" then (select balitaid from balita_detail bd where bd.id = n.detailid)
				else (select bumilid from bumil_detail bd where bd.id = n.detailid)
			end as id
			');
		$CI->db->from('notifikasi n');
		$CI->db->order_by('n.created', 'DESC');
		$CI->db->where('n.userid', $userid);  
		$CI->db->where('n.read', 0); 

		$cek_data3 	= $CI->db->get();
		$hasil3 	= $cek_data3->result_array();
		$jlh3 		= $cek_data3->num_rows();

		$cek_data = array_merge($hasil1, $hasil2, $hasil3);
		return array(
			'record' => $cek_data,
			'jlh' 	 => $jlh1 + $jlh2 + $jlh3
		);
	}
}

function cek_notifikasi($table, $id){
	date_default_timezone_set("Asia/Jakarta");
	$CI = &get_instance();
	$CI->load->database();
	## Proses Notifikasi ##

	$result = $CI->global_model->get($table.'_detail', '*', array($table.'id' => $id, 'read' => 0), true);
	if(count($result) > 0){
		$CI->db->trans_start();
		$return_data = array(
			'read'			=> 1,
			'read_tanggal'	=> date('Y-m-d H:i:s', time())
		);
		$CI->global_model->update($table.'_detail', $return_data, array($table.'id' => $id));
		$CI->db->trans_complete();
	}
	## Akhir proses ##
}

function cek_notifikasi2($table, $detailid){
	date_default_timezone_set("Asia/Jakarta");
	$CI = &get_instance();
	$CI->load->database();

	$result = $CI->global_model->get('notifikasi', '*', ['table' => $table, 'detailid' => $detailid, 'read' => 0], true);
	if(count($result) > 0){
		$CI->db->trans_start();
		$return_data = array(
			'read'			=> 1,
			'read_tanggal'	=> date('Y-m-d H:i:s', time())
		);
		$CI->global_model->update('notifikasi', $return_data, array('id' => $result['id']));
		$CI->db->trans_complete();
	}
}
?>
