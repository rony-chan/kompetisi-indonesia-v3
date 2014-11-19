<?php
	//membuat class model baru dengan nama m_admin
class m_post extends CI_Model{


	//total post aktif
	function count_post(){
		$sql = "SELECT * FROM post WHERE status = 'post'";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//total post draft
	function count_draft(){
		$sql = "SELECT * FROM post WHERE status = 'draft'";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	public function all_post($limit, $offset){
		//fungsi untuk menampilkan semua post yang aktif
		$sql ="SELECT * FROM post WHERE status = 'post' ORDER BY tgl_edit DESC LIMIT ".$limit." OFFSET ".$offset."";
		$query = $this->db->query($sql);
		//show result
		if ($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	public function draft_post($limit, $offset){
		//fungsi untuk menampilkan semua post yang aktif
		$sql ="SELECT * FROM post WHERE status = 'draft' ORDER BY tgl_edit DESC LIMIT ".$limit." OFFSET ".$offset."";
		$query = $this->db->query($sql);
		//show result
		if ($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}


	public function show_post($id){
		//fungsi untuk menampilkan detail post
		$sql ="SELECT * FROM post WHERE id = ?";
		$query = $this->db->query($sql, $id);
		//show result
		if ($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//////////////////////////////////////////
	///////////  INPUT OUTPUT  ///////////////
	//////////////////////////////////////////

	//fungsi untuk menambah positngan baru
	public function add_post($params){
		//fungsi untuk menambahkan post
		$sql = "INSERT INTO post(title, content, tgl_buat, tgl_edit, author, status) VALUES(?, ?, CURDATE(), CURDATE(), '1', ?)";
		if( $this->db->query($sql,$params)) {
			return true;
		} else {
			return false;
		}
	}

	//fungsi untuk mengedit post
	public function edit_post($params) {
		$sql = "UPDATE post SET title = ?, content = ?, status = ?, tgl_edit = CURDATE() WHERE id = ?";
		if( $this->db->query($sql,$params)) {
			return true;
		} else {
			return false;
		}
	}

	//fungsi untuk menghapus postingan
	public function delete_post($id){
		$sql = "DELETE FROM post WHERE id = ?";
		if( $this->db->query($sql, $id)) {
			return true;
		} else {
			return false;
		}
	}
	
}