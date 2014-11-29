<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class proc_public extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
	}
	/////////////////////////////////// request ///////////////////////////////////
	public function add_request() {
		//cek captcha
		if($this->input->post('security_code') == $this->session->userdata('mycaptcha')){
			//button mana yang di klik
			if(isset($_POST['btn_poster'])){ //klik button poster
				//get data
				$nama = $this->input->post('nama');
				$email = $this->input->post('email');
				$link = $this->input->post('link');
				$gambar = $_FILES['poster'];
				$gambar_name = str_replace(" ", "_", $gambar['name']);
				$this->load->library('upload');
				$config['upload_path'] = 'images/poster/';
				$config['allowed_types'] = 'gif|jpg|jpeg';
				$config['overwrite'] = true;
				$config['max_size'] = 1000; //1MB
				// $config['remove_spaces'] = true;
				$params = array('nama' => $nama, 'email' => $email, 'link' => $link, 'poster' => $gambar_name, 'status' => 'waiting');
				$this->upload->initialize($config);
				if($this->upload->do_upload('poster')) { //if poster succes upload
					$this->m_request->add_kompetisi($params);
					echo $this->upload->display_errors();
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Poster Berhasil Dipasang');
						window.location.href='".site_url()."';
					</SCRIPT>");
				} else {
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Poster Gagal Dipasang, Silahkan Coba Lagi');
						window.location.href='".site_url()."';
					</SCRIPT>");
				}
			} else if(isset($_POST['btn_link'])) { //klik button link
				//get data
				$nama = $this->input->post('nama');
				$email = $this->input->post('email');
				$link = $this->input->post('link');
				$params = array('nama' => $nama, 'email' => $email, 'link' => $link, 'poster' => 0, 'status' => 'waiting');
				if($this->m_request->add_kompetisi($params)){
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Link Berhasil Dipasang');
						window.location.href='".site_url()."';
					</SCRIPT>");
				} else {
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Link Gagal Dipasang, Silahkan Coba Lagi');
						window.location.href='".site_url()."';
					</SCRIPT>");
				}
			} else if(isset($_POST['btn_form'])) { //klik button form
			} else { //tidak ada yang di klik
				header("location:site_url()");
			}
		} else { //captcha salah
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('kode keamanan salah, silahkan ulangi lagi');
				window.location.href='".site_url()."';
			</SCRIPT>");
		}		
	}
	public function pasang(){ //function untuk menambah kompetisi oleh user
		if(isset($_POST['btn_pasang'])) {
			$author = $this->session->userdata('id_user');//id user
			$mainkat = $this->input->post('mainkategori');//mainkat
			$subkat = $this->input->post('subkategori');//id kategori
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
			$params = array($judul, $sort, $gambar_nama, $penyelenggara,$konten, $author, $mainkat,$subkat, $deadline, $pengumuman,	$total, $hadiah, $link,$konten); //untuk diinput kedatabase
			if($this->m_kompetisi->pasang($params)) { //jika insert data ke database
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Pasang Kompetisi Berhasil');
					window.location.href='../../dashboard/saya';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('terjadi kesalahan, silahkan coba lagi');
					window.location.href='../../dashboard/saya';
				</SCRIPT>");
				//redirect(site_url('dashboard')); //jika tidak menekan brn_pasang maka akan diredirect ke dashboard
			}
		} else {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('terjadi kesalahan, silahkan coba lagi');
				window.location.href='../../dashboard/saya';
			</SCRIPT>");
			//redirect(site_url('dashboard')); //jika tidak menekan brn_pasang maka akan diredirect ke dashboard
		}	
	}
	public function edit(){ //edit postingan yang dibuat oleh user
		if(isset($_POST)) {
			$author = $this->session->userdata('id_user');//id user
			$mainkat = $this->input->post('mainkategori');//id main kategori
			$subkat = $this->input->post('subkategori');//id sub kategori
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
			if(isset($_POST['btn_submit'])) {
				$status = 'waiting';
			} else if(isset($_POST['btn_draft'])) {
				$status = 'draft';
			}
			$params = array($judul, $sort, $gambar_nama, $penyelenggara,$konten, $mainkat,$subkat, $deadline, $pengumuman,	$total, $hadiah, $link, $status,$id_kompetisi, $status); //untuk diinput kedatabase
			if($this->m_kompetisi->edit($params)) { //jika insert data ke database
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Update Berhasil');
					window.location.href='../../dashboard/saya';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('terjadi kesalahan, silahkan coba lagi');
					window.location.href='../../dashboard/saya';
				</SCRIPT>");
			}
		} else {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('terjadi kesalahan, silahkan coba lagi');
				window.location.href='../../dashboard/saya';
			</SCRIPT>");
			//redirect(site_url('dashboard')); //jika tidak menekan brn_pasang maka akan diredirect ke dashboard
		}	
	}
	//ketika button ditandai di kompetisi/detail di klik
	public function kompetisi_btn(){
		$action = $_GET['act'];//next action
		$id = $_GET['kom'];//id kompetisi
		//encrypt
		$dec = base64_decode(base64_decode($id));
		$id_kompetisi = str_replace('', '=', $dec);
		$x = $this->m_kompetisi->get_competition_by_id_kompetisi($id_kompetisi);
		$judul = str_replace(" ", "-", $x['judul_kompetisi']);
		$params = array($id_kompetisi, $this->session->userdata('id_user'));
		switch ($action) {
			case 'gabung': //jika button gabung di klik
			$sql = "UPDATE kompetisi_btn SET gabung = 1 WHERE id_kompetisi = ? AND id_user = ?";
			$this->db->query($sql, $params);
			redirect(site_url('/kompetisi/detail/'.$id.'/'.$judul));
			break;
			case 'ungabung': //jika button gabung di klik
			$sql = "UPDATE kompetisi_btn SET gabung = 0 WHERE id_kompetisi = ? AND id_user = ?";
			$this->db->query($sql, $params);
			redirect(site_url('/kompetisi/detail/'.$id.'/'.$judul));
			break;
			case 'tandai': //jika button gabung di klik
			$sql = "UPDATE kompetisi_btn SET tandai = 1 WHERE id_kompetisi = ? AND id_user = ?";
			$this->db->query($sql, $params);
			redirect(site_url('/kompetisi/detail/'.$id.'/'.$judul));
			break;
			case 'untandai': //jika button gabung di klik
			$sql = "UPDATE kompetisi_btn SET tandai = 0 WHERE id_kompetisi = ? AND id_user = ?";
			$this->db->query($sql, $params);
			redirect(site_url('/kompetisi/detail/'.$id.'/'.$judul));
			break;
			default:
				# code...
			break;
		}
	}
	//fungsi untuk edit profile
	function edit_profile(){
		$id = $this->input->post('id_user');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$new_password = md5($this->input->post('new_password'));
		$old_password = $this->input->post('old_password');
		$username = $this->input->post('username');
		$moto = $this->input->post('moto');
		//jika tidak ubah password
		if(!$new_password) {
			$password = $old_password;
		} else {
			$password = $new_password;
		}
		$params = array($username, $password, $nama, $email, $moto,$id);
		//validation
		$this->load->library('form_validation');
		if($username == $this->session->userdata('username')) {
			$this->m_user->update_profile($params);
			$this->confirm_update();
		} else {
			$this->form_validation->set_rules('username', 'Username', 'is_unique[user.username]'); //username unique dan tidak boleh sama
			if($this->form_validation->run()){ //jika form validasi jalan
				$this->m_user->update_profile($params);
				$this->confirm_update();
			} else { //jika validasi tidak jalan
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Update profil gagal gunakan username yang lain');
					window.location.href='".site_url()."';
				</SCRIPT>");			
			}
		}
	}
	public function confirm_update(){
		//memanggil view login_confirm
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Update Profil Berhasil, silahkan login kembali');
			window.location.href='".site_url('publik/logout')."';
		</SCRIPT>");
	}
	///////////////////////////////////////////////////////////////
	///////////////// SOCIAL NETWORK API /////////////////////////
	public function register_facebook(){ //register with facebook
	}
	public function login_facebook(){ //login with facebook
		require 'oauth/fb/facebook.php';
		$facebook = new Facebook (array(
			'appId' => '1419514554927551',
			'secret' => '2b82a334fe3cdbb86eac5095aa46b6f8',
		));
		//Get User ID
		$user = $facebook->getUser();
		if(!empty($user)) { //jika user sudah login facebook
			try{
				$user_profile = $facebook->api('/me');
			} catch (FacebookApiException $e){
				error_log($e);
				$user = null;
			}			
			if(!empty($user_profile)) { //jika user profile kosong
				//cek apakah user sudah mendaftar atau belum
				if($this->m_oauth_fb($params)){
					//set session
					$userdata = $this->m_oauth_fb($params);
					if(!empty($userdata)) {
						$sessionData['is_logged_in'] = 1;
						$this->session->set_userdata($userdata); //set data session				
						redirect(site_url());	
					}
				} else { //user belum mendaftar
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Facebook Anda Belum Terdaftar, Silahkan Register Terlebih dahulu');
						window.location.href='".site_url()."';
					</SCRIPT>");
				}
			}
		} else { //jika user belum login facebook
			$login_url = $facebook->getLoginUrl();
			header("Location : ".$login_url);
		}
	}
}