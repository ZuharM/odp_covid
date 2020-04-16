<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


if (!function_exists('dropdown_bobot')) {
	function dropdown_bobot(){
		$CI = &get_instance();
		$CI->load->database();
		## Menampilkan data kategori
		$CI->db->select('*');
		$CI->db->from('bobot');
		$CI->db->order_by('id', 'asc');
		
		$hasil = $CI->db->get();

		$arr_data[''] = "== Pilih Jawaban ==";
		if($hasil->num_rows()>0) {
			foreach($hasil->result_array() as $key => $val){
				$arr_data[$val['id']] = $val['nama'];
			}
		}
		return ($arr_data);
	}
}

?>
