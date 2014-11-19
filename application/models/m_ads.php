<?php
class m_ads extends CI_Model{
	//show all ads type
	public function showAllAdsType(){
		$query = $this->db->get('ads_type');
		return $query->result_array();
	}
	//cek ketersediaan ads
	public function cekKetersediaan($date,$type){ //parameter tanggal mulai
		$sql = "SELECT * FROM ads WHERE start_date <= '".$date."' AND end_date >= '".$date."' AND ads_type ='".$type."'";
		$query = $this->db->query($sql);
		$query->result_array();
	}
	//show all bank
	public function showAllBank(){
		$query = $this->db->get('rek_bank');
		return $query->result_array();
	}
	//menampilkan ads terbaru
	public function showLastAds(){
		$this->db->select_max('id_ads');
		$query = $this->db->get('ads');
		return $query->row_array();//menampilkan hasil akhir berupa row array
	}
	//menampilkan semua ads
	public function showAllAds($limit, $offset){

	}
}