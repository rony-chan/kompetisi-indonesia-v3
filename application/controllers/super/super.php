<?php
//lokasi untuk dashboard  member
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class super extends base {
	public function __construct() {
		parent::__construct();
		//user biasa dilarang masuk
		$loglevel = $this->session->userdata('level');
		$level= array('admin','moderator');//allowed
		if(!in_array($loglevel, $level)) {
			redirect(site_url('super/login')); //masuk form login
		}
	}
	//tampilan halaman utama
	public function dashboard(){
		//ADMIN OR MODERATOR
		if($this->session->userdata('level')=='moderator'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#kompetisi').addClass('active');});</script>";
		} else if($this->session->userdata('level') == 'admin'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#kompetisi').addClass('active'); });</script>";
		}		
		$data['main_kat'] = $this->m_kompetisi->show_main_kat_by_id();
		//pagination setup
		$this->load->library('pagination');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;		
		$config['page_query_string'] = TRUE;		
		if(isset($_GET['act'])){ //jika set act
			$act = $_GET['act'];
			if($act == 'posted') { //melihat kompetisi yang sudah di post
				$data['title'] = "Kompetisi Aktif | ";
				//script
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('posted').className = 'active';})</script>";
				//tampilan
				$data['tot_aktif'] = $this->m_super->count_posted();				
				$data['sub_kat'] = $this->m_kompetisi->show_subkat();
				//pagination setup
				$config['base_url'] = site_url().'/super/super/dashboard?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_super->count_posted(); //total rows untuk kompetisi yang dipost
				// $config['total_rows'] = $this->m_super->count_draft(); //total rows untuk kompetisi yang draft$config['uri_segment'] = 4;
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config);
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_super->posted($config['per_page'],$uri); //data yang ditampilkan
				$this->superdisplay('super/dashboard', $data);
			} else if($act == 'draft') { //melihat kompetisi yang masih draft	
				$data['title'] = "Kompetisi Draft | ";
				//script
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('draft').className = 'active';})</script>";
				$data['tot_draft'] = $this->m_super->count_draft();		
				$data['sub_kat'] = $this->m_kompetisi->show_subkat();
				//pagination setup
				$config['base_url'] = site_url().'/super/super/dashboard?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_super->count_draft(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				//tampilan kompetisi draft
				$data['view'] = $this->m_super->draft($config['per_page'],$uri);
				$this->superdisplay('super/dashboard', $data);
			}		
		} else { //jika tidak set act			
			echo "<center><h1>GET OUT HACKER</h1></center>";
		}
	}
	//tampilan kategori kompetisi
	public function kategori(){
		$data['title'] = 'Main Kategori';
		//ADMIN OR MODERATOR
		if($this->session->userdata('level')=='moderator'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#kategorix').addClass('active'); });</script>";
		} else if($this->session->userdata('level') == 'admin'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#kategorix').addClass('active'); });</script>";
		}	
		$querykategori = $this->db->get('main_kat');
		$data['kategori'] = $querykategori->result_array();//
		$this->superdisplay('super/main_kategori',$data);
	}
	//tampilan halaman request kompetisi
	public function request(){
		//ADMIN OR MODERATOR
		if($this->session->userdata('level')=='moderator'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#request').addClass('active'); });</script>";
		} else if($this->session->userdata('level') == 'admin'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#request').addClass('active'); });</script>";
		}		
		//pagination set up
		$this->load->library('pagination');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;		
		$config['page_query_string'] = TRUE;
		//set action
		if(isset($_GET['act'])){ //jika set act
			$act = $_GET['act']; //action untuk meqnu request
			if($act == 'menunggu') { //action untuk lihat request yang sedang menunggu
				$data['title'] = "Request Menunggu | ";
				$data['tot'] = $this->m_request->count_waiting(); //total request yang menunggu
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('tunggu').className = 'active';})</script>";
				//pagination setup
				$config['base_url'] = site_url().'/super/super/request?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_request->count_waiting(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_kompetisi->show_waiting_request($config['per_page'],$uri); //menampilkan request yang ditunggu
				$this->superdisplay('super/request', $data);
			} else if($act == 'diterima') { //action untuk lihat request yang diterima
				$data['title'] = "Request Diterima | ";
				$data['tot'] = $this->m_request->count_posted(); //total artikel yang di terima
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('terima').className = 'active';})</script>";
				//pagination setup
				$config['base_url'] = site_url().'/super/super/request?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_request->count_posted(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_kompetisi->show_accept_request($config['per_page'],$uri); //menampilkan reject yang ditunggu
				$this->superdisplay('super/request', $data);
			} else if($act == 'ditolak') { //action untuk lihat request yang ditolak
				$data['title'] = "Request Ditolak | ";
				$data['tot'] = $this->m_request->count_reject(); //total artikel yang ditolak
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('tolak').className = 'active';})</script>";
				//pagination setup
				$config['base_url'] = site_url().'/super/super/request?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_request->count_reject(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_kompetisi->show_reject_request($config['per_page'],$uri); //menampilkan request yang diterimak
				$this->superdisplay('super/request', $data);
			} else { //jika tidak set act			
				echo "<center><h1>GET OUT HACKER</h1></center>";
			}
		} else { //jika tidak set act			
			echo "<center><h1>GET OUT HACKER</h1></center>";
		}
	}
	//tampilan request poster / link
	public function request2(){
		//ADMIN OR MODERATOR
		if($this->session->userdata('level')=='moderator'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#request2').addClass('active'); });</script>";
		} else if($this->session->userdata('level') == 'admin'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#request2').addClass('active'); });</script>";
		}
		//pagination
		$this->load->library('pagination');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;		
		$config['page_query_string'] = TRUE;
		//if set action
		if(isset($_GET['act'])) {
			$act = $_GET['act'];
			if($act == 'menunggu') {
				$data['title'] = "Request Menunggu | ";
				$data['tot'] = $this->m_request->count_sort_waiting(); //total request yang menunggu				
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('tunggu').className = 'active';})</script>";
				//pagination setup
				$config['base_url'] = site_url().'/super/super/request2?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_request->count_sort_waiting(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_request->show_req_waiting($config['per_page'],$uri); //menampilkan request yang ditunggu
				$this->superdisplay('super/request2', $data);
			} else if($act == 'ditolak') {
				$data['title'] = "Request Ditolak | ";
				$data['tot'] = $this->m_request->count_sort_reject(); //total request yang menunggu				
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('tolak').className = 'active';})</script>";
				//pagination setup
				$config['base_url'] = site_url().'/super/super/request2?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_request->count_sort_waiting(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_request->show_req_reject($config['per_page'],$uri); //menampilkan request yang ditunggu
				$this->superdisplay('super/request2', $data);
			} else if($act = 'diterima') {
				$data['title'] = "Request Ditolak | ";
				$data['tot'] = $this->m_request->count_sort_accept(); //total request yang menunggu				
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('terima').className = 'active';})</script>";
				//pagination setup
				$config['base_url'] = site_url().'/super/super/request2?act='.$this->input->get('act', TRUE);
				$config['total_rows'] = $this->m_request->count_sort_waiting(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_request->show_req_accept($config['per_page'],$uri); //menampilkan request yang ditunggu
				$this->superdisplay('super/request2', $data);
			} else {
				echo "<center><h1>GET OUT HACKER</h1></center>";
			}
		} else { //jika tidak set act
			echo "<center><h1>GET OUT HACKER</h1></center>";
		}
	}
	//tampilan halaman user
	public function moderator(){
		$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#moderator').addClass('active'); });</script>";
		//pagination set up
		$this->load->library('pagination');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;		
		$config['page_query_string'] = TRUE;
		$config['base_url'] = site_url().'/super/super/user?act='.$this->input->get('act', TRUE);
		//set action
		if(isset($_GET['act'])){ //jika set act
			$act = $_GET['act'];
			if($act == 'active') {
				$data['title'] = "Moderator Active | ";
				$data['tot'] = $this->m_moderator->count_active_user(); //total user active
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item active';document.getElementById('active').className = 'active';})</script>";
				//pagination setup
				$config['total_rows'] = $this->m_moderator->count_active_user(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_moderator->show_active_user($config['per_page'],$uri); //menampilkan user yang active
				$this->superdisplay('super/moderator', $data);
			} else if ($act == 'banned') {
				$data['title'] = "Moderator diBanned | ";
				$data['tot'] = $this->m_moderator->count_banned_user(); //total user active
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item active';document.getElementById('banned').className = 'active';})</script>";
				//pagination setup
				$config['total_rows'] = $this->m_moderator->count_banned_user(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_moderator->show_banned_user($config['per_page'],$uri); //menampilkan user yang active
				$this->superdisplay('super/moderator', $data);
			} else {
				echo "<center><h1>GET OUT HACKER</h1></center>";
			}			
		} else {
			echo "<center><h1>GET OUT HACKER</h1></center>";
		}
	}
	//menambah moderator baru
	public function proc_addModerator(){
		$data['title'] = 'Loading ...';
		$username = $_POST['inputUsername'];
		$password = md5($_POST['inputPassword']);
		$fullname = $_POST['inputFullname'];
		$email = $_POST['inputEmail'];
		$status = 'active';
		$level = 'moderator';
		$tglgabung = date('Y-m-d');
		$gender = $_POST['inputGender'];
		$moto = $_POST['inputMoto'];
		$data = array(
			'username'=>$username,
			'password'=>$password,
			'fullname'=>$fullname,
			'email'=>$email,
			'tgl_gabung'=>$tglgabung,
			'status'=>$status,
			'level'=>$level,
			'gender'=>$gender,
			'moto'=>$moto
			);
		//insert ke table
		if($this->db->insert('user',$data)) {
			//berhasil masuk
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('data berhasil dimasukan');
				window.location.href='".site_url('super/super/moderator?act=active')."';
			</SCRIPT>");
		} else {
			//gagal masuk
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('terjadi kesalahan, silahkan coba lagi');
				window.location.href='".site_url('super/super/moderator?act=active')."';
			</SCRIPT>");
		}
	}
	//tampilan halaman user
	public function user(){
		$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#user').addClass('active'); });</script>";
		//pagination set up
		$this->load->library('pagination');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;		
		$config['page_query_string'] = TRUE;
		$config['base_url'] = site_url().'/super/super/user?act='.$this->input->get('act', TRUE);
		//set action
		if(isset($_GET['act'])){ //jika set act
			$act = $_GET['act'];
			if($act == 'active') {
				$data['title'] = "User Active | ";
				$data['tot'] = $this->m_user->count_active_user(); //total user active
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('active').className = 'active';})</script>";
				//pagination setup
				$config['total_rows'] = $this->m_user->count_active_user(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_user->show_active_user($config['per_page'],$uri); //menampilkan user yang active
				$this->superdisplay('super/user', $data);
			} else if ($act == 'banned') {
				$data['title'] = "User Active | ";
				$data['tot'] = $this->m_user->count_banned_user(); //total user active
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('banned').className = 'active';})</script>";
				//pagination setup
				$config['total_rows'] = $this->m_user->count_banned_user(); //total rows untuk kompetisi yang dipost
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_user->show_banned_user($config['per_page'],$uri); //menampilkan user yang active
				$this->superdisplay('super/user', $data);
			} else {
				echo "<center><h1>GET OUT HACKER</h1></center>";
			}			
		} else {
			echo "<center><h1>GET OUT HACKER</h1></center>";
		}
	}
	//tampilan halaman post
	public function post(){
		//ADMIN OR MODERATOR
		if($this->session->userdata('level')=='moderator'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#post').addClass('active'); });</script>";
		} else if($this->session->userdata('level') == 'admin'){
			$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#post').addClass('active'); });</script>";
		}		
		//pagination set up
		$this->load->library('pagination');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;		
		$config['page_query_string'] = TRUE;
		$config['base_url'] = site_url().'/super/super/post?act='.$this->input->get('act', TRUE);
		//set action
		if(isset($_GET['act'])) {
			$act = $_GET['act'];
			if($act=='active' ) {
				$data['title'] = "Post Active | ";
				$data['tot'] = $this->m_post->count_post();
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('active').className = 'active';})</script>";
				//pagination setup
				$config['total_rows'] = $this->m_post->count_post();
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_post->all_post($config['per_page'],$uri);
				$this->superdisplay('super/post', $data);
			} else if ($act = 'draft') {
				$data['title'] = "Post Draft | ";
				$data['tot'] = $this->m_post->count_draft();
				$data['script'] = "<script type='text/javascript'>$(document).ready(function(){document.getElementById('moderator').className = 'list-group-item';document.getElementById('draft').className = 'active';})</script>";
				//pagination setup
				$config['total_rows'] = $this->m_post->count_draft();
				$uri = $this->uri->segment(4);
				$this->pagination->initialize($config); 		
				if(isset($_GET['per_page'])) {
					if($_GET['per_page'] == '') { 
						$uri = 0;
					} else {
						$uri = $_GET['per_page'];
					}
				} else {
					$uri = 0;
				}
				if($config['total_rows'] < 20) {
					$data['page'] = 1;
				} else {
					$data['page'] = $this->pagination->create_links();
				}
				//end of pagination set up
				$data['view'] = $this->m_post->draft_post($config['per_page'],$uri);
				$this->superdisplay('super/post', $data);
			} else {
				echo "<center><h1>GET OUT HACKER</h1></center>";
			}
		} else {
			echo "<center><h1>GET OUT HACKER</h1></center>";
		}
	}
	///////////////
	// ads
	public function ads(){
		$this->load->library('pagination');
		$data['title'] = 'ads | ';
		$data['script2'] = "<script type='text/javascript'>$(document).ready(function(){ $('#adsx').addClass('active'); });</script>";
		//start pagination 
		//pagination set up
		$this->load->library('pagination');
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;		
		$config['page_query_string'] = TRUE;
		$config['base_url'] = site_url().'/super/super/ads?act='.$this->input->get('act', TRUE);
		$config['total_rows'] = $this->db->count_all('ads');//count all ads row
		$uri = $this->uri->segment(4);
		$this->pagination->initialize($config);
		if(isset($_GET['per_page'])) {
			if($_GET['per_page'] == '') { 
				$uri = 0;
			} else {
				$uri = $_GET['per_page'];
			}
		} else {
			$uri = 0;
		}
		if($config['total_rows'] < 20) {
			$data['page'] = 1;
		} else {
			$data['page'] = $this->pagination->create_links();
		}
		//end of pagination
		$data['view'] = $this->m_ads->showAllAds($config['per_page'],$uri);
		$this->superdisplay('super/ads', $data);
	}
	//tampilan edit post
	public function edit(){
		if (isset($_GET['id'])){
			$dec = base64_decode(base64_decode($_GET['id']));
			$id_kompetisi = str_replace('', '=', $dec);
			$data['view'] = $this->m_kompetisi->get_competition_by_id_kompetisi($id_kompetisi);
			$id_main_kat = $data['view']['id_main_kat'];
			$data['main_kat'] = $this->m_kompetisi->show_main_kat_by_id();
			$data['sub_kat'] = $this->m_kompetisi->show_sub_kat_by_id($id_main_kat);
			$data['title'] = 'Edit | ';
			$this->defaultdisplay('super/edit_kompetisi', $data);
			$this->footerdisplay(); 
		} else {
			//tidak ada yang sesuai kembali ke dashboard
			redirect(site_url('super/super/dashboard'));
		}
	}
	//////////////////////////////////////////////////////////
	/////////////////////// PROCESSOR ///////////////////////
	public function login() { //super login
		$this->load->library('form_validation');
		//validasi data
		$this->form_validation->set_rules('username', 'Username',  'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password',  'required|md5|trim');
		//jika form_validationnya jalan
		if($this->form_validation->run() == true) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//memasukan session userdata
			$admindata = $this->m_super->can_log_in($username, $password);
			if(!empty($admindata)) {
				//mengisi array session;
				$sessionData['is_logged_in'] = 1;
				$this->session->set_userdata($admindata);				
				redirect('super/super/dashboard?act=posted'); //login berhasil redirect ke super dashboard				
			} else {
				$data['title'] = "Gagal login | ";
				$this->defaultdisplay('super/landing', $data);
			}
		//jika user dan password tidak cocok
		} else {
			$data['title'] = "Gagal login | ";
			$this->defaultdisplay('super/landing', $data);
		}
	}
	//tempat untuk memberikan pesan kesalahan
	function validate_credentials(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		//struktur kendali untuk cek bisa login atau tidak
		if ($this->m_super->can_log_in($username, $password)){
			return true;
		} else {
			//memberikan pesan jika login tidak berhasil
			$this->form_validation->set_message('validate_credentials', 'username/password salah');
			return false;
		}
	}
	////////////////////KOMPETISI///////////////////
	//fungsi untuk menambah kompetisi
	function add_kompetisi(){
		if(isset($_POST['btn_pasang'])) {
			$author = $this->session->userdata('id_user');//id user
			$main_kat = $this->input->post('mainkategori');//id kategori
			$sub_kat = $this->input->post('subkategori');//id subkategori
			$judul = $this->input->post('judul'); //judul
			$sort = $this->input->post('sort'); //deskripsi singkat
			$deadline = $this->input->post('deadline'); //deadline kompetisi
			$pengumuman = $this->input->post('pengumuman'); //dpengumuman kompetisi
			$penyelenggara = $this->input->post('penyelenggara'); //penyelenggara kompetisi
			$konten =  str_replace("\n", '</br>', $this->input->post('deskripsi'));  //syarat dan ketentuan
			$total = $this->input->post('total'); //total hadiah
			$hadiah = $this->input->post('hadiah');//detail hadiah
			$link = $this->input->post('link');//link sumber kompetisi
			$gambar = $_FILES['poster'];//poster
			//jika upload poster
			if(isset($_FILES['poster'])) {
				$gambar_nama = str_replace(' ', '_', $gambar['name']); //rename ' ' menjadi '-'
				$this->load->library('upload');
				//config untuk library upload
				$config['upload_path'] = './images/poster';
				$config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
				$config['overwrite'] = true;
				$config['max_size'] = 1000000; //1MB
				$this->upload->initialize($config);
				$this->upload->do_upload('poster');
				echo $this->upload->display_errors();				
			} else {
				$gambar_nama = '';
			}
			$params = array($judul, $sort, $gambar_nama, $penyelenggara,$konten, $author, $main_kat, $sub_kat, $deadline, $pengumuman,	$total, $hadiah, $link,$konten); //untuk diinput kedatabase
			if($this->m_super->add_kompetisi($params)) { //jika insert data ke database
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Pasang Kompetisi Berhasil');
					window.location.href='dashboard?act=posted';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('terjadi kesalahan, silahkan coba lagi');
					window.location.href='dashboard?act=posted';
				</SCRIPT>");
				//redirect(site_url('dashboard')); //jika tidak menekan brn_pasang maka akan diredirect ke dashboard
			}
		} else {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('terjadi kesalahan, silahkan coba lagi');
				window.location.href='dashboard?act=posted';
			</SCRIPT>");
			//redirect(site_url('dashboard')); //jika tidak menekan brn_pasang maka akan diredirect ke dashboard
		}
	}
	public function edit_kompetisi(){ //edit postingan yang dibuat oleh user
		if(isset($_POST)) {
			$author = $this->session->userdata('id_user');//id user
			$main_kat = $this->input->post('mainkategori');//id main kategori
			$sub_kat = $this->input->post('subkategori');//id sub kategori
			$judul = $this->input->post('judul'); //judul
			$sort = $this->input->post('sort'); //deskripsi singkat
			$deadline = $this->input->post('deadline'); //deadline kompetisi
			$pengumuman = $this->input->post('pengumuman'); //dpengumuman kompetisi
			$penyelenggara = $this->input->post('penyelenggara'); //penyelenggara kompetisi
			$konten =  str_replace("\n", '</br>', $this->input->post('deskripsi'));  //syarat dan ketentuan
			$total = $this->input->post('total'); //total hadiah
			$hadiah = $this->input->post('hadiah');//detail hadiah
			$link = $this->input->post('link');//link sumber kompetisi
			$gambar = $_FILES['poster'];//poster
			$img = $this->input->post('poster_lama');//jika tidak upload poster
			$id_kompetisi = $this->input->post('id_kompetisi'); //id kompetisi
			//jika upload poster
			$this->load->library('upload');
				//config untuk library upload
			$config['upload_path'] = './images/poster';
			$config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
			$config['overwrite'] = true;
			$config['max_size'] = 1000000; //1MB
			$this->upload->initialize($config);
			if($this->upload->do_upload('poster')) {
				$gambar_nama = str_replace(' ', '_', $gambar['name']); //rename ' ' menjadi '-'
			} else {
				$gambar_nama = $img; //post
			}	
			echo $this->upload->display_errors();	
			if(isset($_POST['btn_post'])) {
				$status = 'posted';
			} else if(isset($_POST['btn_draft'])) {
				$status = 'draft';
			}
			$params = array($judul, $sort, $gambar_nama, $penyelenggara,$konten,$main_kat, $sub_kat, $deadline, $pengumuman,	$total, $hadiah, $link, $status,$id_kompetisi, $status); //untuk diinput kedatabase
			if($this->m_kompetisi->edit($params)) { //jika insert data ke database
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Update Berhasil');
					window.location.href='dashboard?act=posted';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('terjadi kesalahan, silahkan coba lagi');
					window.location.href='dashboard?act=posted';
				</SCRIPT>");
			}
		} else {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('terjadi kesalahan, silahkan coba lagi');
				window.location.href='dashboard?act=posted';
			</SCRIPT>");
			//redirect(site_url('dashboard')); //jika tidak menekan brn_pasang maka akan diredirect ke dashboard
		}	
	}
	//delete kompetisi
	function delete_kompetisi(){
		$id = $_GET['id'];
		if($this->m_kompetisi->delete_kompetisi($id)) {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Delete Success');
					window.location.href='dashboard?act=posted';
				</SCRIPT>");
		} else {
			echo("
				<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Error, try again');
				window.location.href='dashboard?act=posted';
				</SCRIPT>
				");
		}
	}
	////////////////////POST////////////////////////
	//fungsi untuk menambahkan post
	function add_post() {
		$title = $this->input->post('title'); //judul postingan
		$content = $this->input->post('content'); //isi postingan
		//struktur kendali apakah postingan di post
		if(isset($_POST['btn_post'])) {
			//jika menekan tombol post
			$status = 'post';
			$params = array($title, $content, $status);
			if ($this->m_post->add_post($params)){
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Posting Berhasil');
					window.location.href='".site_url('super/super/post?act=active')."';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Posting Gagal');
					window.location.href='".site_url('super/super/post?act=active')."';
				</SCRIPT>");
			}
		} else if(isset($_POST['btn_draft'])) {
			//jika menekan tombol draft
			$status = 'draft';
			$params = array($title, $content, $status);
			if ($this->m_post->add_post($params)){
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Posting Disimpan');
					window.location.href='".site_url('super/super/post?act=draft')."';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Posting Gagal');
					window.location.href='".site_url('super/super/post?act=draft')."';
				</SCRIPT>");
			}
		}
	}
	//fungsi untuk edit post
	function edit_post(){
		$id = $_GET['id']; //id kompetisi
		$data['post'] = $this->m_post->show_post($id); //menampilkan detail post
		$this->defaultdisplay('super/edit_post', $data); //tampilan edit post
	}
	function btn_edit_post(){
		//fungsi untuk update post, mengambil data
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		if(isset($_POST['btn_post'])) {
			$status = 'post';
			$params = array($title, $content, $status, $id);
			if($this->m_post->edit_post($params)) {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Update Berhasil');
					window.location.href='".site_url('super/super/post?act=active')."';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Terjadi Masalah, Silahkan Coba Lagi');
					window.location.href='".site_url('super/super/post?act=active')."';
				</SCRIPT>");
			}
		} else if(isset($_POST['btn_draft'])){
			$status = 'draft';
			$params = array($title, $content, $status, $id);
			if($this->m_post->edit_post($params)) {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Update Berhasil');
					window.location.href='".site_url('super/super/post?act=draft')."';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Terjadi Masalah, Silahkan Coba Lagi');
					window.location.href='".site_url('super/super/post?act=draft')."';
				</SCRIPT>");
			}
		}
	}
	//fungsi untuk delete post
	function delete_post() {
		$id= $_GET['id'];
		if($this->m_post->delete_post($id)) {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Delete Berhasil');
				window.location.href='".site_url('super/super/post?act=active')."';
			</SCRIPT>");
		} else {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Terjadi Masalah, Silahkan Coba Lagi');
				window.location.href='".site_url('super/super/post?act=active')."';
			</SCRIPT>");
		}
	}
	////////////////////KOMPETISI////////////////////////
	//btn menerima request kompetisi
	function btn_accept_kompetisi(){
		$id = $_GET['id'];
		if($this->m_kompetisi->btn_accept_request($id)) { //merubah status kompetisi
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Kompetisi Telah Diterima');
				window.location.href='".site_url('super/super/request?act=diterima')."';
			</SCRIPT>");
		} else { //ubah status kompetisi gagal
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Gagal Ubah Status');
				window.location.href='".site_url('super/super/request?act=menunggu')."';
			</SCRIPT>");
		}
	}
	//btn menolak request kompetisi
	function btn_reject_kompetisi(){
		$id = $_GET['id'];
		if($this->m_kompetisi->btn_reject_request($id)) { //merubah status kompetisi
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Kompetisi Telah Ditolak');
				window.location.href='".site_url('super/super/request?act=ditolak')."';
			</SCRIPT>");
		} else { //ubah status kompetisi gagal
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Gagal Ubah Status');
				window.location.href='".site_url('super/super/request?act=diterima')."';
			</SCRIPT>");
		}
	}
	//button untuk merubah user active dan di banned
	function btn_user(){
		$id = $_GET['id'];
		$act = $_GET['act'];
		if($act == 1) {
			if($this->m_user->set_active($id)) {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('User Telah Aktif');
					window.location.href='".site_url('super/super/user?act=active')."';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Gagal Update Status');
					window.location.href='".site_url('super/super/user?act=active')."';
				</SCRIPT>");
			}
		} else if($act == 0) {
			if($this->m_user->set_banned($id)) {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('User Telah Dibanned');
					window.location.href='".site_url('super/super/user?act=banned')."';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Gagal Update Status');
					window.location.href='".site_url('super/super/user?act=active')."';
				</SCRIPT>");
			}
		}
	}
	////////////////////////btn 2/////////////////////////////////////
	function btn_proc2(){
		$id = $_GET['id'];
		$stat = $_GET['stat'];
		if($stat == 1) { //kompetisi diterima
 			$status = 'posted';
		} else if ($stat == 0) { //kompetisi ditolak
			$status = 'reject';
		} else {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Terjadi Kesalahan');
					window.location.href='".site_url('super/super/request2?act=menunggu')."';
				</SCRIPT>");
		}
		$params = array($status, $id);
		$this->m_request->change_status($params);
		echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Berhasil Update Status');
					window.location.href='".site_url('super/super/request2?act=menunggu')."';
				</SCRIPT>");
	}
	//logout
	function logout() {
		//fungsi yang digunakan untuk menghapus session
		$this->session->sess_destroy();
		//output
		redirect(site_url('super/login'));
	}
}