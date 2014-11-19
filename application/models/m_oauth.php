<?php
	//membuat class model baru dengan nama m_admin
class m_oauth extends CI_Model{
	
	//login dengan facebook
	function cek_login_fb($param){
		$sql = "SELECT * FROM user WHERE oauth_provider = 'facebook' AND oauth_id = ?  "
		$query = $this->db->query($sql, $param);//eksekusi query
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
}