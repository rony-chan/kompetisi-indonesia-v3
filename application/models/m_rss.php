<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_rss extends CI_Model{
	public function __construct(){
        parent::__construct();
	}
	//show 10 recent post
	public function get_post($count) {
		$sql = "SELECT * FROM kompetisi ORDER BY id_kompetisi DESC  LIMIT 0 , ? ";
		$query = $this->db->query($sql, $count);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
}