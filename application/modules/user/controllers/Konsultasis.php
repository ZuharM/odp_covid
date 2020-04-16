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
		$data['result'] = $this->global_model->get('penyakit', '*');

		$this->template('konsultasi', $data);
	}

	public function soal(){
		$jawab_soal	= $this->global_model->get('jawaban', '*', array('user_id' => $this->userid));
		//print_r($data['jawab_soal']);
		if(!empty($jawab_soal)){
			foreach($jawab_soal as $value_jawab){
				$dump_jawab[$value_jawab['jawaban_id']] = $value_jawab['bobot_jawab_id'];
			}
			$data['jawab_soal'] = $dump_jawab;
		}
		$data['soal'] 	= $this->global_model->get('pertanyaan', '*', '', false, '', '', 'pertanyaan_id', 'ASC');
		$data['bobot'] 	= $this->global_model->get('bobot', '*', '', false, '', '', 'id', 'ASC');

		//persentase imunitas
		$imunitas	= $this->konsultasi->get_imunitas(array('user_id' => $this->userid));
		if($imunitas->num_rows() >= 1){
			$data['data_imun'] 	= $imunitas->result();
		}
		$this->template('daftar_pertanyaan', $data);
	}

	function save_jawaban(){
		//Get bobot jawaban
		$bobot 	= $this->global_model->get('bobot', 'id, angka', '', false, '', '', 'id', 'ASC');
		if(!empty($bobot)){
			foreach($bobot as $value_bobot){
				$dump_bobot[$value_bobot['id']] = $value_bobot['angka'];
			}
			$data_bobot = $dump_bobot;
		}

		//Get indikator jawaban
		$indikator 	= $this->konsultasi->get_soal_indikator($where=NULL);
		if($indikator->num_rows() >= 1){
			foreach($indikator->result() as $value_indikator){
				$dump_indikator[$value_indikator->pertanyaan_id] = $value_indikator->angka;
			}
			$data_indikator = $dump_indikator;
		}

		//print_r($data_indikator);

		//print_r($bobot);
		
		$jawab_soal	= $this->global_model->get('jawaban', '*', array('user_id' => $this->userid), false, '', '', 'pertanyaan_id', 'ASC');
		$array_jawab = $this->input->post('jwb_pertanyaan');
		foreach($array_jawab as $id_soal => $id_jawab){
			//echo "soal $id_soal : jawaban : $id_jawab <br/>";
			if($this->input->post('update') == 	1){
				foreach($jawab_soal as $value_jwb){
					if($value_jwb['pertanyaan_id'] == $id_soal){
						$dump_update[] = array(
							'jawaban_id' 		=> $value_jwb['jawaban_id'],
							'pertanyaan_id' 	=> $id_soal,
							'bobot_jawab_id' 	=> $id_jawab,
							'cf_user' 			=> $data_bobot[$id_jawab],
							'cf_value' 			=> $data_bobot[$id_jawab] * $data_indikator[$id_soal],
						);
					}
				}
			}else{
				$dump_insert[] = array(
					'user_id' 			=> $this->userid,
					'pertanyaan_id' 	=> $id_soal,
					'bobot_jawab_id' 	=> $id_jawab,
					'cf_user' 			=> $data_bobot[$id_jawab],
					'cf_value' 			=> $data_bobot[$id_jawab] * $data_indikator[$id_soal],
					'jawaban_created' 	=> $this->datenow
				);
			}
		}

		if(isset($dump_update)){
			$this->global_model->update_batch('jawaban', $dump_update, 'jawaban_id');
			$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Diperbaharui</div>");
		}else{
			$this->global_model->insert_batch('jawaban', $dump_insert);
			$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Disimpan</div>");
		}

		//update cf combine
		$jawab_soal	= $this->global_model->get('jawaban', '*', array('user_id' => $this->userid), false, '', '', 'pertanyaan_id', 'ASC');
		$index=1;
		foreach($jawab_soal as $value) {
			$arr_cf_value[$index] = $value['cf_value'];
			$index++;
		}

		$i=1;
		foreach($jawab_soal as $value_jwb){
			//CF Combine
			if ($i == 1) {
				$arr_cfcombine[$value_jwb['pertanyaan_id']] = $arr_cf_value[$i] + $arr_cf_value[$i+1] * (1-$arr_cf_value[$i]);
			}else{
				if(isset($arr_cf_value[$i+2])){
					$cf_next2 = $arr_cf_value[$i+2];
				}else{
					$cf_next2 = 0;
				}
				$arr_cfcombine[$value_jwb['pertanyaan_id']] = $arr_cfcombine[$value_jwb['pertanyaan_id']-1] + $cf_next2 * (1-$arr_cfcombine[$value_jwb['pertanyaan_id']-1]);
			}

			$dump_update_cfcombine[] = array(
				'jawaban_id' 		=> $value_jwb['jawaban_id'],
				'cf_combine' 		=> $arr_cfcombine[$value_jwb['pertanyaan_id']]
			);

			$i++;
		}

		//print_r($dump_update_cfcombine);
		$this->global_model->update_batch('jawaban', $dump_update_cfcombine, 'jawaban_id');
		$this->db->trans_complete();
		redirect('user/konsultasis/soal');
	}

	public function uuid($uuid){
		$data['uuid'] 		= $uuid;
		$data['bobot'] 		= dropdown_bobot();
		$data['indikator'] 	= $this->global_model->get('indikator', '*');
		$this->template('konsultasi_pertanyaan', $data);
	}

	public function view($uuid){
		$data['uuid'] 		= $uuid;
		$data['result'] 	= $this->global_model->get('konsultasi', '*', array('uuid' => $uuid), true);
		$this->template('konsultasi_view', $data);
	}

	function proses(){
		$penyakit 	= $this->input->post('penyakit');
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
			'uuid' 		=> $this->uuid,
			'created' 	=> $this->datenow
		);

		$this->global_model->insert('konsultasi', $return_data);
		$this->db->trans_complete();
		redirect('user/konsultasis/uuid/'.$uuid_new);
	}

	function proses_pertanyaan(){
		$this->db->trans_start();
		//print_rr($_POST);
		//die();

		$uuid 	 	 = $this->input->post('uuid');
		$bobotid 	 = $this->input->post('bobotid');
		$indikatorid = $this->input->post('indikatorid');

		//$angka_indikator = array();
		//$angka_bobot = array();
		$nilai = array();
		$arr_jawaban = array();
		foreach ($indikatorid as $key => $val) {
			$arr_jawaban[$val] 	= $bobotid[$key];
			$angkaindikator 	= $this->konsultasi->get_angka_indikator($val);
			$angkabobot 		= $this->konsultasi->get_angka_bobot($bobotid[$key]);
			//$angka_indikator[$val] 	= $angkaindikator;
			//$angka_bobot[$val] 		= $angkabobot;
			$nilai[$val] 		= $angkabobot * $angkaindikator;
		}

		/*echo '<br>bobot<br>';
		print_rr($angka_bobot);
		echo '<br><br>CF<br>';
		print_rr($angka_indikator);
		echo '<br><br>Nilai<br>';
		print_rr($nilai);*/

		$arr_data = array();
		$angka_simpan = "";
		foreach ($nilai as $key => $val) {
			if($key == 1){
				$arr_data[$key] = ($val + $nilai[$key+1] * (1-$val));
			} else {
				$arr_data[$key] = ($angka_simpan + $val * (1-$angka_simpan));
			}
			$angka_simpan = $arr_data[$key];
		}

		//echo '<br><br>Combine<br>';
		//print_rr($arr_data);

		$persen = round($angka_simpan * 100, 3);
		//echo '<br><br>Nilai Akhir yaitu: <br>'.$persen;
		//die();

		$update = array(
			'jawaban' 		=> json_encode($arr_jawaban),
			'persentase'	=> $persen
		);

		$this->global_model->update('konsultasi', $update, array('uuid' => $uuid));
		$this->db->trans_complete();
		$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Diperbaharui</div>");
		redirect('user/konsultasis/view/'.$uuid);
	}
}
