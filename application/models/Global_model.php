<?php
class Global_model extends CI_Model {

	private $id;
	private $param;
	private $keyword;

	function __construct() { parent::__construct(); }
	function getId() { return $this->id; }
	function setId($id) { $this->id= $id; }
	function getKeyword() { return $this->keyword; }
	function setKeyword($keyword) { $this->keyword = $keyword; }
	function getParam() { return $this->param; }
	function setParam($param) { $this->param = $param; }

	public function insert_batch($table, $data){
		return $this->db->insert_batch($table, $data);
	}

	public function update_batch($table, $data, $field){
		return $this->db->update_batch($table, $data, $field);
	}

	function insert($table,$form_data = array()){
		return $this->db->insert($table, $form_data);
	}

	function update($table,$form_data = array(),$key = array()){
		if(count($key)>0){
			$this->db->where($key);
		}

		$this->db->update($table, $form_data);
		if ($this->db->affected_rows() >= 0) {
			return TRUE;
		}

		return FALSE;
	}

	function insert_return_id($table,$form_data = array()){
		$this->db->insert($table,$form_data);
		return $this->db->insert_id();
	}

	function delete($table,$key = array()){
		if(array_key_exists("all", $key)) {
			$this->db->delete($table);
			if ($this->db->affected_rows() == '1') {
				return TRUE;
			}
		} else {
			if(count($key) <= 0){
				//exit("Fungsi Delete Harus Berdasarkan Id");
				return FALSE;
			} else{
				$this->db->where($key);
				$this->db->delete($table);
				if ($this->db->affected_rows() == '1') {
					return TRUE;
				}
			}
		}

		return FALSE;
	}

	function get($table, $fields, $where='', $one=false, $perpage='', $start='', $sort_by='', $sort_order=''){

		$this->db->select($fields);
		$this->db->from($table);

		if($where != '') {
			if(is_array($where)) {
				foreach ($where as $key => $val) {
					if(is_array($val)) {
						$this->db->where_in($key, $val);
					} else {
						$this->db->where($key, $val);
					}
				}
			} else {
				$this->db->where($where);
			}
		}

		if($perpage != '' || $start != ''){
			$this->db->limit($perpage,$start);
		}

		if($sort_by != '' || $sort_order != ''){
			$this->db->order_by($sort_by,$sort_order);
		}

		$query = $this->db->get();

		$result = !$one ? $query->result_array() : $query->row_array();

		return $result;
	}

	function get_row($table, $fields, $where='', $one=false, $perpage='', $start='', $sort_by='', $sort_order=''){

		$this->db->select($fields);
		$this->db->from($table);

		if($where != '') {
			if(is_array($where)) {
				foreach ($where as $key => $val) {
					if(is_array($val)) {
						$this->db->where_in($key, $val);
					} else {
						$this->db->where($key, $val);
					}
				}
			} else {
				$this->db->where($where);
			}
		}

		if($perpage != '' || $start != ''){
			$this->db->limit($perpage,$start);
		}

		if($sort_by != '' || $sort_order != ''){
			$this->db->order_by($sort_by,$sort_order);
		}

		$query = $this->db->get();

		$result = !$one ? $query->result() : $query->row();

		return $result;
	}

	function count($table) {
		return $this->db->count_all($table);
	}

	function getUserIP(){
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];
	    if(filter_var($client, FILTER_VALIDATE_IP)){
	        $ip = $client;
	    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
	        $ip = $forward;
	    }else{
	        $ip = $remote;
	    }
	    if($ip == "::1"){
	         $ip = "127.0.0.1";
	         return $ip;
	    }else{
	        return $ip;
	    }
	}

	function getUserBrowser(){
	   	$browser = $_SERVER['HTTP_USER_AGENT'];
	    if (strpos($browser, 'Safari') ){
			$browser = 'Safari';
		}elseif(strpos($browser, 'Netscape')){
			$browser = 'Netscape (Gecko/Netscape)';
		}elseif(strpos($browser, 'Firefox')){
			$browser = 'Mozilla Firefox (Gecko/Firefox)';
		}elseif(strpos($browser, 'MSIE')){
			$browser = 'Internet Explorer (MSIE/Compatible)';
		}elseif(strpos($browser, 'Opera')){
			$browser = 'Opera';
		}elseif(strpos($browser, 'Chrome')){
			$browser = 'Google Chrome';
		}
	    return $browser;
	}
}
?>
