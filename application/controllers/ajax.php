
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
		
		$sql = "SELECT * FROM ads WHERE ? "
	}
}