<?php
	if(!defined('BASEPATH'))
		exit('No direct access allowed !');
		
	class Ajax_function extends MY_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('umum');
		}

		public function cek_notifikasi(){
			$type 		 = $this->input->post('type');
			$jumlah_hari =  config_item('jumlah_hari');
			$date_now 	 = date_create();

			$result = $this->umum->get_jadwal($type);
			//$arr_result = array();
			$total = 0;
			if(count($result) > 0) {
				foreach ($result as $key => $val) {
					//$arr_result[$key] = $val;
					//$arr_result[$key]['date_now'] 		= $date_now;
					
					if(strtotime($val['tanggal_notifikasi']) > strtotime($val['tanggal'])){
						$tgl_kemudian = date('Y-m-d H:i:s', strtotime('+'.$jumlah_hari.' days', strtotime($val['tanggal_notifikasi'])));
						$diff 	 	  = date_diff($date_now, date_create($tgl_kemudian));
					} else {
						$tgl_kemudian = date('Y-m-d H:i:s', strtotime('+'.$jumlah_hari.' days', strtotime($val['tanggal'])));
						$diff 	 	  = date_diff($date_now, date_create($tgl_kemudian));
					}
					//$arr_result[$key]['tgl_kemudian'] 	= $tgl_kemudian;
					$h_minus = $diff->d;
					//$arr_result[$key]['h_minus'] = $h_minus;

					if($h_minus <= 2){
						$arr = array(
							'detailid' 	=> $val['id'],
							'table'		=> $type.'_detail',
							'userid'	=> $val['userid'],
							'created'	=> $this->datenow
						);
						$this->db->insert('notifikasi', $arr);
						$total++;
						//$arr_result[$key]['total'] = $arr;
					}
				}
			}

			$type_show = $type == 'balita' ? 'bumil' : 'berhenti';
			$arr_data = array(
				'notifikasi' => $total,
				'type' => $type_show
			);

			echo json_encode($arr_data);
		}
	}
?>