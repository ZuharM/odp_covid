<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporans extends E_Admin {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model(array('laporan'));
	}

	public function index(){
		$data['result'] = $this->laporan->get_konsultasi();

		$this->template('laporan', $data);
	}

	public function view($uuid){
		$result 		= $this->laporan->get_konsultasi($uuid);
		$data['result'] = $result;

		$arr_data = array();
		for ($i=1; $i <= $result['konsultasi']; $i++) { 
			$rekapitulasi = $this->laporan->get_rekapitulasi($uuid, $i);
			if(count($rekapitulasi) > 0){
				$arr_data[$i] = $rekapitulasi;
			}
		}
		$data['rekapitulasi'] 	= $arr_data;

		$g_label = "";
		$g_data = "";
		$hit_data = count($arr_data);
		if($hit_data > 0){
			foreach ($arr_data as $key => $val) {
				$g_label 	.= "'Konsultasi ke-".$val['konsultasi_ke']."'";
				$g_data 	.= $val['cf_combine'] * 100;
				if($hit_data > $key){
					$g_label .= ", ";
					$g_data .= ", ";
				}
			}
		}
		$data['g_label'] = $g_label;
		$data['g_data'] = $g_data;

		$this->template('laporan_view', $data);
	}
}
