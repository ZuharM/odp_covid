<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasis extends E_User {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('konsultasi');
	}

	public function index()
	{
		$data['result'] 	= $this->global_model->get('penyakit', '*');
		$data['pertanyaan'] = $this->konsultasi->get_pertanyaan(1);

		$data['wilayah'] 		= dropdown_wilayah();
		$data['wilayahdetail'] 	= array('' => '== Pilih Wilayah Detail ==');

		$data['konsultasi']		= $this->global_model->get('konsultasi', '*', array('userid' => $this->userid));

		$this->template('konsultasi', $data);
	}

	public function uuid($uuid){
		$data['uuid'] 			= $uuid;

		$data['indikator'] = $this->konsultasi->get_pertanyaan("", 1);
		$this->template('konsultasi_pertanyaan', $data);
	}

	public function view($uuid){
		$data['uuid'] 		= $uuid;
		$result 			= $this->global_model->get('konsultasi', '*', array('uuid' => $uuid), true);
		$data['result'] 	= $result;

		$arr_data = array();
		for ($i=1; $i <= $result['konsultasi']; $i++) { 
			$rekapitulasi = $this->konsultasi->get_rekapitulasi($uuid, $i);
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

		$this->template('konsultasi_view', $data);
	}

	function proses(){
		$penyakit 	= $this->input->post('penyakit');
		$pertanyaan = $this->input->post('pertanyaan');
		$jawaban 	= $this->input->post('jawaban');
		$wilayahid 	= $this->input->post('wilayahid');
		$wilayahdetailid = $this->input->post('wilayahdetailid');
		$choose 	= $this->input->post('choose');

		$data_penyakit = '';
		if(count($penyakit) > 0){
			foreach ($penyakit as $key => $val) {
				if($val != ""){
					$data_penyakit .= $val.', ';
				}
			}
		}

		$uuid_new = $this->uuid;
		$return_data = array(
			'penyakit' 	=> $data_penyakit,
			'userid' 	=> $this->userid,
			'konsultasi' => 1,
			'uuid' 		=> $uuid_new,
			'created' 	=> $this->datenow
		);

		if($choose == 1){
			$return_data += array(
				'wilayahid' 		=> $wilayahid,
				'wilayahdetailid' 	=> $wilayahdetailid
			);
		}

		$konsultasiid 	= $this->global_model->insert_return_id('konsultasi', $return_data);
		$jawaban_angka 	= $this->konsultasi->get_bobot("", $jawaban);
		$indikator 		= $this->konsultasi->get_indikator($pertanyaan);

		$detail = array(
			'konsultasiid'  	=> $konsultasiid,
			'uuid'	 			=> $uuid_new,
			'bobot_jawab_id'	=> $jawaban,
			'cf_user'			=> $jawaban_angka['angka'],
			'cf_value'			=> $indikator['angka'],
			'userid' 			=> $this->userid,
			'pertanyaanid' 		=> $pertanyaan,
			'jawaban_created' 	=> $this->datenow,
			'jawaban_updated' 	=> $this->datenow
		);
		$this->global_model->insert('konsultasi_detail', $detail);

		$this->db->trans_complete();
		redirect('user/konsultasis/uuid/'.$uuid_new);
	}

	function proses_pertanyaan(){
		$this->db->trans_start();

		$uuid 	 	 = $this->input->post('uuid');
		$indikatorid = $this->input->post('indikatorid');

		$result = $this->global_model->get('konsultasi', '*', array('uuid' => $uuid), true);
		$array0 = $this->konsultasi->get_konsultasi_detail($uuid);

		$jawaban_nilai = $this->konsultasi->get_angka_bobot($array0['bobot_jawab_id']) * $this->konsultasi->get_angka_indikator($array0['pertanyaanid']);
		$nilai = array('1' => $jawaban_nilai);
		foreach ($indikatorid as $key => $val) {
			$angkaindikator 	= $this->konsultasi->get_angka_indikator($val);
			$angkabobot 		= $this->konsultasi->get_angka_bobot($this->input->post('jawaban_'.$val));
			$nilai[$val] 		= $angkabobot * $angkaindikator;
		}
		$jum_ = count($nilai) + 1;
		$nilai[$jum_] = 0;

		$arr_data = array();
		$angka_simpan = $jawaban_nilai;
		foreach ($nilai as $key => $val) {
			if($key <= $jum_ - 1){
				if($key == 1){
					$arr_data[$key] = ($val + $nilai[$key+1] * (1-$val));
				} else {
					$jawabanid 		= $this->input->post('jawaban_'.$key);
					$angkabobot 	= $this->konsultasi->get_angka_bobot($jawabanid);
					$angkaindikator = $this->konsultasi->get_angka_indikator($key);
					$arr_data[$key] = ($angka_simpan + $nilai[$key+1] * (1-$angka_simpan));

					$angka_simpan = $arr_data[$key];
					
					$arr_insert = array(
						'konsultasiid'	 => $result['id'],
						'uuid'			 => $result['uuid'],
						'konsultasi_ke'	 => $result['konsultasi'],
						'userid'		 => $this->userid,
						'pertanyaanid'	 => $key,
						'bobot_jawab_id' => $jawabanid,
						'cf_user'		 => $angkabobot,
						'cf_value'		 => $angkabobot * $angkaindikator,
						'cf_combine'	 => $angka_simpan,
						'jawaban_created' => $this->datenow,
						'jawaban_updated' => $this->datenow
					);
					$this->db->insert('konsultasi_detail', $arr_insert);
				}
			}
		}
		$persen = round($angka_simpan * 100, 3);

		$update = array(
			'persentase' => $persen,
			'konsultasi' => $result['konsultasi'] + 1
		);

		$this->global_model->update('konsultasi', $update, array('uuid' => $uuid));
		$this->db->trans_complete();
		$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Diperbaharui</div>");
		redirect('user/konsultasis/view/'.$uuid);
	}
}
