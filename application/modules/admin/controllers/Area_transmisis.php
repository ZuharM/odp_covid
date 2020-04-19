<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_transmisis extends E_Admin {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('area');
	}

	public function index($id = NULL)
	{
		$data['result'] = $this->area->get_data_wilayah();

		$result = array('id' => '', 'nama' => '');
		if(isset($id)){
			$result	= $this->global_model->get('wilayah', '*', array('id' => $id), true);
		}
		$data['result_edit']	= $result;

		$this->template('area/wilayah', $data);
	}

	public function proses()
	{
		$this->db->trans_start();
		$wilayahid = empty($this->input->post('wilayahid')) ? "" : $this->input->post('wilayahid');

		$nama 	 = $this->input->post('nama');

		$return_data = array('nama' => $nama);

		if($wilayahid == ""){
			$this->global_model->insert('wilayah', $return_data);
			$this->db->trans_complete();
			$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Ditambah</div>");
		} else {
			$this->global_model->update('wilayah', $return_data, array('id' => $wilayahid));
			$this->db->trans_complete();
			$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Diperbaharui</div>");
		}
		redirect('admin/area_transmisis');
	}

	public function detail($id = NULL)
	{
		$data['result'] = $this->area->get_data_wilayah_detail();

		$result = array('id' => '', 'nama' => '', 'wilayahid' => '');
		if(isset($id)){
			$result	= $this->global_model->get('wilayah_detail', '*', array('id' => $id), true);
		}
		$data['result_edit']	= $result;

		$data['wilayah'] = dropdown_wilayah();

		$this->template('area/wilayah_detail', $data);
	}

	public function proses_detail()
	{
		$this->db->trans_start();
		$detailid = empty($this->input->post('detailid')) ? "" : $this->input->post('detailid');

		$nama 	 	= $this->input->post('nama');
		$wilayahid 	= $this->input->post('wilayahid');

		$return_data = array(
			'nama'		=> $nama,
			'wilayahid'	=> $wilayahid
		);

		$cek = $this->area->cek_detail($return_data, $detailid);
		if ($cek->num_rows() == 1){
			$this->session->set_flashdata('pesan', "<div class='alert alert-danger' role='alert'>Nama Wilayah Detail <b>".$nama."</b> Sudah ada</div>");
			echo "<script>window.history.go(-1);</script>";
			die();
		}

		if($detailid == ""){
			$this->global_model->insert('wilayah_detail', $return_data);
			$this->db->trans_complete();
			$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Ditambah</div>");
		} else {
			$this->global_model->update('wilayah_detail', $return_data, array('id' => $detailid));
			$this->db->trans_complete();
			$this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Data Sudah Diperbaharui</div>");
		}
		redirect('admin/area_transmisis/detail');
	}

	function remove($id)
	{
		$this->global_model->delete('wilayah', array('id' => $id));
		$this->session->set_flashdata('pesan', '<div class="form-group"><div class="col-sm-12 alert alert-success" role="alert">Data Sudah di Hapus</div></div>');
		echo "<script>window.history.go(-1);</script>";
	}

	function remove_detail($id)
	{
		$this->global_model->delete('wilayah_detail', array('id' => $id));
		$this->session->set_flashdata('pesan', '<div class="form-group"><div class="col-sm-12 alert alert-success" role="alert">Data Sudah di Hapus</div></div>');
		echo "<script>window.history.go(-1);</script>";
	}
}
