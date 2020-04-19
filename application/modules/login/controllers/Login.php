<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index() {
		$this->load->view('login');
	}

	public function register(){
		$data['status_kawin'] 	= config_item('status_kawin');
		$data['darah'] 			= config_item('darah');
		$data['agama'] 			= config_item('agama');
		$this->load->view('register', $data);
	}

	public function register_proses(){
		$this->db->trans_start();
		$nik 			= $this->input->post('nik');
		$nama 			= $this->input->post('nama');
		$tempat_lahir 	= $this->input->post('tempat_lahir');
		$tanggal_lahir 	= $this->input->post('tanggal_lahir');
		$alamat 		= $this->input->post('alamat');
		$darah 			= $this->input->post('darah');
		$agama 			= $this->input->post('agama');
		$status_kawin 	= $this->input->post('status_kawin');
		$no_hp 			= $this->input->post('no_hp');
		$pekerjaan 		= $this->input->post('pekerjaan');
		$email 			= $this->input->post('email');
		$username 		= $this->input->post('username');
		$password 		= $this->input->post('password');

		$return_data = array(
			'uname'			=> $username,
			'upass'			=> MD5($password),
			'upass_hid'		=> $password,
			'nama'			=> $nama,
			'level'			=> 'user',
			'telepon'		=> $no_hp,
			'email'			=> $email,
			'alamat'		=> $alamat,
			'darah'			=> $darah,
			'agama'			=> $agama,
			'status_kawin'	=> $status_kawin,
			'pekerjaan'		=> $pekerjaan,
			'nik'			=> $nik,
			'tempat_lahir'	=> $tempat_lahir,
			'tanggal_lahir'	=> $tanggal_lahir,
			'uuid'			=> UUID::v5(mt_rand(0, 0xffff).microtime().time()),
			'created'		=> date('Y-m-d H:i:s', time())
		);

		$cek = $this->m_login->cek_username($username);
		if ($cek->num_rows() == 1) {
			$this->session->set_flashdata('pesan', "<div class='alert alert-danger' role='alert'>Username <b>".$username."</b> Sudah ada</div>");
			echo "<script>window.history.go(-1);</script>";
			die();
		}
		$this->global_model->insert('user', $return_data);
		$this->db->trans_complete();
		$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Ditambah</div>");
		redirect('login');
	}

	function cek_login(){
		$data = array(
					'uname' => $this->input->post('username') , 
					'upass' => md5($this->input->post('password'))
				);
		$hasil = $this->m_login->cek_user($data);
		//$_log		= array();
		if ($hasil->num_rows() == 1){
			foreach($hasil->result() as $val){
				$sess_data['username'] 	= $val->uname;
				$sess_data['userid'] 	= $val->id;
				$sess_data['level'] 	= $val->level;
				$sess_data['nama'] 		= $val->nama;
				//$sess_data['level'] 	 = $val->level;
				$this->session->set_userdata($sess_data);
				$status = 1;
				$keterangan = "<div class='alert alert-success' role='alert'>Login Sukses </div>";
				$link = config_item('base_url').$val->level;
			}
		} else {
			$status = 0;
			$keterangan = "<div class='alert alert-danger' role='alert'>Login Gagal </div>";
			$link = '';
		}
		//echo json_encode($_log);
		
		
		$arr_data = array(
			'status'	 => $status,
			'keterangan' => $keterangan,
			'link'		 => $link
		);
		echo json_encode($arr_data);
	}
		
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
