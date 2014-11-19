<?php
	//membuat class model baru dengan nama m_admin
class m_request extends CI_Model{

	//total request yang menunggu
	public function count_waiting(){
		$sql = "SELECT * FROM kompetisi WHERE status = 'waiting' AND author != 1";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//total request yang menunggu
	public function count_posted(){
		$sql = "SELECT * FROM kompetisi WHERE status = 'posted' AND author != 1";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//total request yang menunggu
	public function count_reject(){
		$sql = "SELECT * FROM kompetisi WHERE status = 'reject' AND author != 1";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//menambah kompetisi yang di tambahkan publik metode poster dan link
	public function add_kompetisi($params) {
		$sql = "INSERT INTO request(id_req, nama, email, link, poster,status) VALUES ('', ?, ?, ?, ?, 'waiting')";
		$this->db->query($sql, $params);
		return true;
	}

	//menampilkan sort request menunggu
	public function count_sort_waiting(){
		$sql = "SELECT * FROM request WHERE status = 'waiting' ";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}


	//menampilkan sort request ditolak
	public function count_sort_reject(){
		$sql = "SELECT * FROM request WHERE status = 'reject' ";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//menampilkan sort request diterima
	public function count_sort_accept(){
		$sql = "SELECT * FROM request WHERE status = 'posted' ";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}


	//////////////////////////dari tabel request/////////////////////////////////

	//melihat request menunggu
	function show_req_waiting($limit, $offset){
		$sql = "SELECT * FROM request WHERE status = 'waiting' LIMIT ".$limit." OFFSET ".$offset." ";
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

	//menampilkan request diterima
	function show_req_accept($limit, $offset){
		$sql = "SELECT * FROM request WHERE status = 'posted' LIMIT ".$limit." OFFSET ".$offset."";
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

	//menampilkan request ditolak
	function show_req_reject($limit, $offset){
		$sql = "SELECT * FROM request WHERE status = 'reject' LIMIT ".$limit." OFFSET ".$offset."";
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

	///////////////////change status request 2///////////////////////////
	function change_status($params) {
		$sql = "UPDATE request SET status = ? WHERE id_req = ?";
		$query = $this->db->query($sql, $params);
		return true;
	}


}