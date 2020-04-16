<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Umum extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_jadwal($type)
	{
		$query = $this->db->query('
			select bd.*,
			(select b.userid from '.$type.' b where b.id = bd.'.$type.'id) as userid,
			(select n.created from notifikasi n where n.detailid = bd.id AND n.table = "'.$type.'_detail" order by n.created DESC limit 1) as tanggal_notifikasi
			from '.$type.'_detail bd
			group by bd.'.$type.'id DESC
			order by bd.tanggal DESC
		');

		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return NULL;
		}
	}
}

?>