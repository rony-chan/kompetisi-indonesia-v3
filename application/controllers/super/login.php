<?php
//lokasi untuk dashboard  member
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';


class login extends base {
	public function index() { //halaman utama super user
		$data['title'] = "Dashboard | ";
		//untuk tampilan
		$this->superdisplay('super/landing', $data);
	}

	//////////////////////////////////////////////////////////
	///////////////////////LOGIN PROCESSOR ///////////////////////

	public function login_proc() { //super login
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
				//memasukan data last login
				$sql = "UPDATE user SET last_login = CURTIME() WHERE username = ?";
				$this->db->query($sql,$username);//ekse				
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
		if ($this->m_super->can_log_in($username,$password)){
			return true;
		} else {
			//memberikan pesan jika login tidak berhasil
			$this->form_validation->set_message('validate_credentials', 'username/password salah');
			return false;
		}
	}

}