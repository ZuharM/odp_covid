<?php
	if(!defined('BASEPATH'))
		exit('No direct access allowed !');
		
	class Ajax_function extends MY_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('umum');
		}

		public function get_detail() 
		{
			$wilayahid = $_POST['wilayahid'];
			
			$result = $this->umum->get_wilayahdetail($wilayahid);
			$data = "<option value=''> == Pilih Wilayah Detail == </option>";
			foreach($result as $key => $val){
				$data .= "<option value='".$val['id']."'>".$val['nama']."</option>";
			}
			echo $data;
		}
	}
?>