<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class publik extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index(){
		$data['title'] = "";
		//menampilkan thumbnails kompetisi terbaru
		$data['thumb'] = $this->m_kompetisi->home_thumb();
		$this->defaultdisplay('public/home', $data);
		$this->footerdisplay();
	}
	//login process
	public function login(){
		$data['title'] = "Loading...";
		$this->load->library('form_validation');
		//validasi data
		$this->form_validation->set_rules('username', 'Username',  'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password',  'required|md5|trim');
		//jika form_validationnya jalan
		if($this->form_validation->run() == true) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//memasukan session userdata
			$userdata = $this->m_user->can_log_in($username, $password);
			if(!empty($userdata)) {
				//mengisi array session;
				$sessionData['is_logged_in'] = 1;				
				$this->session->set_userdata($userdata);				
				header('location:'.$_SERVER['HTTP_REFERER']); //kembali ke halaman sebelumnya			
			}
		//jika user dan password tidak cocok
		} else {
			$data['title'] = "";
			$data['thumb'] = $this->m_kompetisi->list_kompetisi(20,0);
			//total kompetisi aktif
			$data['aktif'] = $this->m_kompetisi->count_aktif();
			//total kompetisi bulan ini
			$data['kompetisi'] = $this->m_kompetisi->month_kompetisi();
			//total kategori
			$data['kat'] = $this->m_kompetisi->count_kategori();
			//total hadiah bulan ini
			$data['kabar'] = $this->m_kompetisi->empat_kabar_baru();
			$data['total'] = $this->m_kompetisi->count_hadiah();
			$this->defaultdisplay('public/home', $data);
			$this->footerdisplay();
		}	
	}
	//tempat untuk memberikan pesan kesalahan
	function validate_credentials(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		//struktur kendali untuk cek bisa login atau tidak
		if ($this->m_user->can_log_in($username, $password)){
			return true;
		} else {
			//memberikan pesan jika login tidak berhasil
			$this->form_validation->set_message('validate_credentials', 'username/password salah');
			return false;
		}
	}
	public function read($id=''){
		$dec = base64_decode(base64_decode($id));
		$id_post = str_replace('', '=', $dec);
		//fungsi untuk menampilkan postingan
		$data['view'] = $this->m_post->show_post($id_post);
		$data['title'] = $data['view']['title']. ' | ';		
		$this->defaultdisplay('public/post', $data);
		$this->footerdisplay();
	}
	public function post(){
		//fungsi untuk menampilkan postingan
		$data['title'] = 'Post | ';
		$data['view'] = $this->m_post->all_post();
		$this->defaultdisplay('public/post_all', $data);
		$this->footerdisplay();
	}
	//logout process
	public function logout() {
		//fungsi yang digunakan untuk menghapus session
		$this->session->sess_destroy();
		//output
		redirect(site_url());
	}
	//profile
	public function profile(){
		$username = $this->uri->segment(3);
		$data['username']= $username;
		$id = $this->m_user->getuserid($username);
		//detail user
		$data['detuser'] = $this->m_user->detuser($id);
		$data['title'] = $username.' | ';
		$data['view']['sort'] = 'Perjalanan '.$username.' di KompetisiIndonesia';
		//joined competition
		$data['ikut'] = $this->m_kompetisi->count_diikuti_kompetisi($id);
		//add competition
		$data['pasang'] = $this->m_kompetisi->count_kompetisiku($id);
		//winner competition
		$data['menang'] = $this->m_kompetisi->total_dimenangkan($id);
		//show total hadiah yang dimenangkan
		$data['hadiah'] = $this->m_kompetisi->total_hadiah($id);
		//action
		if(isset($_GET['act'])) {
			$act = $_GET['act'];
			switch ($act) {
			case 'ikut':
				$data['view'] = $this->m_kompetisi->show_kompetisi_gabung($id,20,0);
				$data['dec'] = 'Kompetisi Yang Diikuti '.$username.' di KompetisiIndonesia';
				break;
			case 'pasang':
				$data['view'] = $this->m_kompetisi->show_kompetisi_dipasang($id,20,0);
				$data['dec'] = 'Kompetisi Yang Dipasang '.$username.' di KompetisiIndonesia';
				break;
			case 'menang':
				$data['view'] = $this->m_kompetisi->show_kompetisi_menang($id,20,0);
				$data['dec']= 'Kompetisi Yang Dimenangkan '.$username.' di KompetisiIndonesia';
				break;
			default:
				echo 'An Error Ocurred';
				break;
			}
		}		
		$this->defaultdisplay('user/profile', $data);	
		$this->footerdisplay();
	}
}