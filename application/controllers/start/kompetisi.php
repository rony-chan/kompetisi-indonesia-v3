<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';


class kompetisi extends base {

	//membuat construktor
	public function __construct() {
		parent::__construct();
	}

	//tampilan index
	public function index(){
		$data['title'] = "";
		$data['thumb'] = $this->m_kompetisi->list_kompetisi(20,0);
		//total kompetisi aktif
		$data['aktif'] = $this->m_kompetisi->count_aktif();
		//total kompetisi bulan ini
		$data['kompetisi'] = $this->m_kompetisi->month_kompetisi();
		//total kategori
		$data['kat'] = $this->m_kompetisi->count_kategori();
		//semua main kategori
		$data['main_kat'] = $this->m_kompetisi->show_kat();
		//total hadiah bulan ini
		$data['total'] = $this->m_kompetisi->count_hadiah();
		//kabar baru
		$data['kabar'] = $this->m_kompetisi->empat_kabar_baru();
		$this->defaultdisplay('public/home', $data);
		$this->footerdisplay();
	}

	//tampilan news dari kompetisi indonesia
	public function news(){
		//fungsi untuk menampilkan postingan
		$data['title'] = 'News | ';

		//$this->load->library('pagination');
		$this->load->library('pagination');
		$config['base_url'] = site_url('start/kompetisi/news');
		$config['total_rows'] = $this->m_post->count_post(); //menghitung total kompetisi yang aktf
		$config['per_page'] = 15;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;
		$uri = $this->uri->segment(4);
		$this->pagination->initialize($config); 		
		if(!$uri) {
			$uri = 0;
		}
		if($config['total_rows'] < 20) {
			$data['page'] = 1;
		} else {
			$data['page'] = $this->pagination->create_links();
		}
		//end of pagination set up

		$data['view'] = $this->m_post->all_post($config['per_page'],$uri);
		$this->defaultdisplay('public/post_all', $data);
		$this->footerdisplay();
	}

	//list semua kompetisi aktif
	public function jelajah() {

		$data['title'] = "Jelajah | ";		
		$data['kategori'] = $this->m_kompetisi->list_kategori(); //menampilkan kategori di top menu
		$this->load->library('pagination');

		//pagination set up		
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;
		//pagination design
		$config['first_tag_open'] = '<ul>';
		$config['first_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '&lt;&lt;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '&gt;&gt;';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		//end of pagination set up
		if(!$_GET){ //jika tidak ada element get
			$config['base_url'] = site_url('start/kompetisi/jelajah');
			$config['total_rows'] = $this->m_kompetisi->count_kompetisi(); //menghitung total kompetisi yang aktif
			$uri = $this->uri->segment(4);
			$this->pagination->initialize($config); 		
			if(!$uri) {
				$uri = 0;
			}
			if($config['total_rows'] < 20) {
				$data['page'] = 1;
			} else {
				$data['page'] = $this->pagination->create_links();
			}
			$data['list'] = $this->m_kompetisi->list_kompetisi($config['per_page'],$uri); //kompetisi yang ditampilkan
		//jika elemen get ada didalam url
		} else if (isset($_GET['q']) && ($_GET['kat']== 0)) { //jika hanya melakukan search
			$q = $_GET['q']; //variabel keyword
			$config['page_query_string'] = TRUE;
			$config['base_url'] = site_url().'/start/kompetisi/jelajah?kat=0&q='.$this->input->get('q', TRUE);
			$config['total_rows'] = $this->m_kompetisi->count_search_jelajah($q);//menghitung total kompetisi yang aktif
			
			if(isset($_GET['per_page'])) {
				$uri = $_GET['per_page'];
			} else {
				$uri = 0;
			}
			$this->pagination->initialize($config); 		
			if(!$uri) {
				$uri = 0;
			}
			if($config['total_rows'] < 20) {
				$data['page'] = '';
			} else {
				$data['page'] = $this->pagination->create_links();
			}
			///
			$data['total'] = $this->m_kompetisi->count_search_jelajah($q);			
			$data['list'] = $this->m_kompetisi->search_jelajah($q,$config['per_page'],$uri); //kompetisi yang ditampilkan
		} else if (isset($_GET['q']) && isset($_GET['kat'])) { //jika melakukan search dan pilih kategori
			$q = $_GET['q']; //variabel keyword
			$kat = $_GET['kat']; //variabel kategori
			$config['page_query_string'] = TRUE;
			$config['base_url'] = site_url().'/start/kompetisi/jelajah?kat='.$kat.'&q='.$this->input->get('q', TRUE);
			$config['total_rows'] = $this->m_kompetisi->count_search_sort_jelajah($q, $kat); //menghitung total kompetisi yang aktif
			if(isset($_GET['per_page'])) {
				$uri = $_GET['per_page'];
			} else {
				$uri = 0;
			}
			$this->pagination->initialize($config); 		
			if(!$uri) {
				$uri = 0;
			}
			if($config['total_rows'] < 20) {
				$data['page'] = '';
			} else {
				$data['page'] = $this->pagination->create_links();
			}
			///			
			$data['total'] = $this->m_kompetisi->count_search_sort_jelajah($q, $kat);
			$data['list'] = $this->m_kompetisi->search_sort_jelajah($q, $kat,$config['per_page'],$uri); //kompetisi yang ditampilkan
		} else { //jika tidak ada ya[ng spesial
			$data['list'] = $this->m_kompetisi->list_kompetisi($config['per_page'],$uri); //kompetisi yang ditampilkan
		}

		$this->defaultdisplay('public/jelajah', $data);

	}

	//tampilan untuk search
	public function search(){
		$data['title'] = 'Pencarian | ';
		$data['kategori'] = $this->m_kompetisi->list_kategori(); //menampilkan kategori di top menu
		$this->load->library('pagination');

		//cek total url segment

	}

}