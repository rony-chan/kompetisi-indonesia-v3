<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';


class kompetisi extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
		$this->load->library('user_agent');
	}

	public function index(){
		//default page
		echo "<center><h1>ERROR 404 : Page Not Found</h1></center>";
	}

	//tambah rate
	public function tambahrate(){
		$dec = base64_decode(base64_decode($this->input->get('idkompetisi')));
		$idkompetisi = str_replace('', '=', $dec);
		$iduser = $this->input->get('iduser');
		$rate = $this->input->get('rate');
		$params = array($idkompetisi,$iduser);
		//cek rating kompetisi di database
		$query_rating = "SELECT SUM(rating) AS 'rating' FROM rating WHERE id_kompetisi = ?";
		$query_rating = $this->db->query($query_rating,$idkompetisi);
		$query_rating = $query_rating->row_array();
		$total_rate =  $query_rating['rating']; //mendapatkan total rate
		if(empty($total_rate)){
			$total_rate = 0;
		}
		//cek total row
		$query_row_rating = "SELECT * FROM rating WHERE id_kompetisi = ?";
		$total_row = $this->db->query($query_row_rating,$idkompetisi);
		$total_row = $total_row->num_rows();
		//rating sekarang
		$recent_rate = $total_rate / $total_row;
		//konvert ke bilangan bulat
		$recent_rate = round($recent_rate);
		//cek apakah user sudah memberi rate
		$query_cek = "SELECT * FROM rating WHERE id_kompetisi = ? AND id_user = ?";
		$query_cek = $this->db->query($query_cek,$params);
		if($query_cek->num_rows()>0){ //update tabel
			$this->db->where('id_kompetisi',$idkompetisi);
			$this->db->where('id_user',$iduser);
			$data = array('rating'=>$rate);
			$this->db->update('rating',$data);
			echo $rate;
		} else { //insert tabel
			$data = array('id_kompetisi'=>$idkompetisi,'id_user'=>$iduser,'rating'=>$rate);
			$this->db->insert('rating',$data);
		}

	}

	public function pages(){ //menampilkan berdasarkan pages yang dimaksud

		$data['title'] = "pages | ";
		$this->defaultdisplay('public/pages', $data);
		$this->footerdisplay();
	}

	//berisi detal kompetisi
	public function detail($id=''){ //if id not set
		//decrypt
		$id_kompetisi = $this->ki_id_dec($id);
		//tambah views
		if ($this->agent->is_referral())
		{ 
			$referal = $this->agent->referrer();//referrer url
		} else {
			$referal = $this->uri->uri_string();
		}
		$now = $this->uri->uri_string();//now url
		if($referal != $now) {//jika alamat referral bukan alamat sekarang maka, tambah 1 views
			$sql = "UPDATE kompetisi SET views = views + 1 WHERE id_kompetisi = ?";
			$this->db->query($sql,$id_kompetisi);
		}

		//rating
		//cek rating kompetisi di database
		$query_rating = "SELECT SUM(rating) AS 'rating' FROM rating WHERE id_kompetisi = ?";
		$query_rating = $this->db->query($query_rating,$id_kompetisi);
		$query_rating = $query_rating->row_array();
		$total_rate =  $query_rating['rating']; //mendapatkan total rate
		if(empty($total_rate)){
			$total_rate = 0;
		}
		//cek total row
		$query_row_rating = "SELECT * FROM rating WHERE id_kompetisi = ?";
		$total_row = $this->db->query($query_row_rating,$id_kompetisi);
		$total_row = $total_row->num_rows();
		if($total_row==0){
			$total_row = 1;//because  0 division 0 = ~
		}
		//rating sekarang
		$recent_rate = $total_rate / $total_row;
		//konvert ke bilangan bulat
		$data['recent_rate'] = round($recent_rate);
		//end of rating

		//jika ada user login
		if(!empty($this->session->userdata('id_user'))) {
			$params = array($id_kompetisi, $this->session->userdata('id_user'));
			$this->m_kompetisi->kompetisi_btn($params);
		}
		$params = array($id_kompetisi, $this->session->userdata('id_user'));
		$data['btn'] = $this->m_kompetisi->cek_btn($params);
		$data['ditandai'] = $this->m_kompetisi->count_tandai($id_kompetisi);
		$data['gabung'] = $this->m_kompetisi->count_gabung($id_kompetisi);		
		//judul di title bar
		$tit = $this->m_kompetisi->title_kompetisi($id_kompetisi);
		$data['view'] = $this->m_kompetisi->get_competition_by_id_kompetisi($id_kompetisi);
		if(empty($data['view'])){ //jika kompetisi tidak ditemukan
			$data['title']='Error 404 | ';
			echo "<center><h1>ERROR 404 : PAGE NOT FOUND</h1</center>";
		} else { //kompetisi ditemukan
			$data['title'] = $tit['judul_kompetisi'].' |';
			$this->defaultdisplay('public/kompetisi', $data);
			$this->footerdisplay();
		}
		
	}
}