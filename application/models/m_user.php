<?php
	//membuat class model baru dengan nama m_admin
class m_user extends CI_Model{
	
	function can_log_in($username, $password){
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('level', 'user');
		$this->db->where('status', 'active');
		$query = $this->db->get('user');
		//struktur kendali untuk cek apakah data ada atau tidak
		if($query->num_rows() > 0) { //jika ada data yang ditemukan
			//maka menampilkan hasilnya sebagai baris array
			return $query->row_array();
		}
	}

	//ubah user menjadi aktif
	function set_active($id) {
		$sql = "UPDATE user SET status='active' WHERE id_user = ? ";
		$this->db->query($sql, $id);
		return true;
	}

	//ubah user menjadi banned
	function set_banned($id) {
		$sql = "UPDATE user SET status='banned' WHERE id_user = ? ";
		$this->db->query($sql, $id);
		return true;
	}

	//menampilkan data user berdasarkan id
	 function show_user($id){
		$this->db->select('*');
		$this->db->where('id_user', $id);
		$query = $this->db->get('user');
		//struktur kendali untuk cek apakah data ada atau tidak
		if($query->num_rows() > 0) { //jika ada data yang ditemukan
			//maka menampilkan hasilnya sebagai baris array
			return $query->row_array();
		}
	}

	//menampilkan user yang aktif
	function show_active_user($limit, $offset){
		$sql = "SELECT * FROM user WHERE status = 'active' AND level = 'user' LIMIT ".$limit." OFFSET ".$offset."";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	//total active user
	function count_active_user(){
		$sql = "SELECT COUNT(*) AS 'total' FROM user WHERE status = 'active' AND level = 'user'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			return $query->num_rows();
		}  else {
			return array();
		}
	}

	//menampilkan user yang dibanned
	function show_banned_user($limit, $offset){
		$sql = "SELECT * FROM user WHERE status = 'banned' AND level = 'user' LIMIT ".$limit." OFFSET ".$offset."";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	//total active user
	function count_banned_user(){
		$sql = "SELECT COUNT(*) AS 'total' FROM user WHERE status = 'banned' AND level = 'user'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			return $query->num_rows();
		}  else {
			return array();
		}
	}

	//update profile
	function update_profile($params){
		$sql = "UPDATE user SET username = ?, password = ?, fullname = ?, email = ?, moto = ? WHERE id_user = ?";
		$this->db->query($sql, $params);
		return true;
	}

	//////////////////////////////////////
	//////////// PROFILE PAGE ////////////
	//////////////////////////////////////

	//get userid
	function getuserid($username){
		$sql ="SELECT id_user FROM user WHERE username = ?";
		$result = $this->db->query($sql, $username);
		$data = $result->row_array();
		return $data['id_user'];
	}

	//detail user
	function detuser($id){
		$sql = "SELECT * FROM user WHERE id_user = ? ";
		$result = $this->db->query($sql, $id);
		return $result->row_array();
	}
	
	//joined competition
	
	//added competition

	//won competitioin

	
}