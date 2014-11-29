<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class ajax extends base {
	public function index(){
		echo '<center><h1>ERROR 404 : Page Not Found</h1></center>';
	}
	public function rate(){
		$value = $this->input->get('rate');
		$sql = $this->m_kompetisi->rating();
	}
	public function show_sub_kat_by_id(){
		$id=$this->input->get('id');//get id sub kat
		$data['sub_kat'] = $this->m_kompetisi->show_sub_kat_by_id($id);
		$this->load->view('ajax/all_sub_kat', $data);
	}
	public function show_sub_kat_by_id_on_edit(){
		$id=$this->input->get('id');//get id sub kat
		$data['sub_kat'] = $this->m_kompetisi->show_sub_kat_by_id($id);
		$this->load->view('ajax/only_sub_kat', $data);
	}
	//cek ketersediaan ads untuk tanggal tertentu
	public function cekKetersediaanAds(){
		$tipe = $_GET['tipe'];
		$tgl_awal = $_GET['tanggal'];
		$durasi = $_GET['durasi'];
		$tgl_akhir = date('Y-m-d', strtotime('+'.$durasi.' days', strtotime($tgl_awal)));
		//cek didatabase
	}
	//cek username
	public function cekUsername(){
		$username = $_GET['username'];
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		if($query->num_rows()>0){
			return true;
		}else{
			$this->db->get('meme');
		}
	}
	//tambah detail juara
	public function add_det_juara(){
		$juara = $_GET['juara'];
		$hadiah = $_GET['hadiah'];
		$total = $_GET['total'];
		$data = array('juara'=>array($juara,$hadiah,$total));
		$this->session->set_userdata($data);
	}
	//lihat detail juara
	public function show_det_juara(){
		echo '<pre>';
		print_r($this->session->userdata(''));
		echo '</pre>';
	}
}