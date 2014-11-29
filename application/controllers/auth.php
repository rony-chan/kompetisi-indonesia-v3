<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class auth extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
		// if(!empty($this->session->userdata('username'))) {
		// 	redirect(site_url());
		// }
	}
	public function index() {
		echo '<h1><center>403 : FORBIDEN</center></h1>';
	}
	//OAUTH LOGIN FOR FACEBOOK
	public function facebook(){
		require("FBSDK/facebook.php");
		$facebook = new Facebook(array(
				'appId' => '1419514554927551',
				'secret' => '2b82a334fe3cdbb86eac5095aa46b6f8'
			));
		$session = $facebook->getUser();
		if(!empty($session))
		{
			// facebook session is active
			try
			{
				$uid = $facebook->getUser();
				$user = $facebook->api('/me');
			}
			catch(Exception $e){}
			if(!empty($user)) {
				//print_r($user);
				//Cek data user apakah sudah daftar				
				$sql = "SELECT * FROM user WHERE oauth_provider = 'facebook' AND oauth_id = ?";
				$query = $this->db->query($sql, $user['id']);
				//IF REGISTERED
				if($query->num_rows()>0){
					$result = $query->row_array();
					//set last login
					//current date time
					$now = date('Y-m-d H:i:s');
					$params = array($now,$user['id']);
					$sql = "UPDATE user SET last_login = ?  WHERE oauth_provider = 'facebook' AND oauth_id = ?";
					if($this->db->query($sql,$params)){
						echo 'berhasil bikin log';
					} else {
						echo 'gagal bikin log';
					}
					//create session
					if(!empty($result)) {
						//mengisi array session;
						$sessionData['is_logged_in'] = 1;				
						$this->session->set_userdata($result);				
						echo ("<SCRIPT LANGUAGE='JavaScript'>
									window.alert('Login Success');
									window.location.href='".site_url()."';
								</SCRIPT>");	
						// exit();
					} else {
						echo 'An Error creating seasson.';
					}
				//IF NOT REGISTERED
				} else { 
					//INSERT DATA TO DB
					$registerdata = array('id' => $user['id'], 'provider' => 'facebook','gender' => $user['gender'], 'username' => $user['username'],'email' => $user['email'],'name' => $user['name']);
					$this->session->set_userdata($registerdata);
					//register to completing data
					redirect(site_url('auth/register'));
				}	
			}
			else
			{
				// problem.
				die("An Error occured. Please try again later.");
			}
		}
		else
		{
			// no active facebook session
			$login_url = $facebook->getLoginUrl();
			header("Location: " . $login_url);
		}
	}
	//OAUTH LOGIN FACEBOOK 2
	public function facebook_login(){
	}
	//OAUTH LOGIN FOR GOOGLE
	public function google(){
	}
	//OAUTH LOGIN FOR TWITTER
	public function twitter(){
		echo 'sistem not ready';
	//END OF OAUTH TWITTER
	}
	//OAUTH TWITTER 2
	public function oauth_twitter(){
	}
	//END OF OAUTH TWITTER 2
	//REGISTER PROCESS
	//MELENGKAPI DATA
	public function register(){
		// if(empty($this->session->userdata('registerdata'))) {
		// 	//back to home
		// 	redirect(site_url());
		// }
		$data['title'] = "Register";
		$this->defaultdisplay('user/register', $data);
		$this->footerdisplay();
	}
	//MELENGKAPI DATA
	//INPUT KE DB DAN AUTO LOGIN
	public function proc_register(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('reg-username', 'Reg-Username', 'required|xss_clean|is_unique[user.username]');
		$this->form_validation->set_rules('reg-email', 'Reg-email', 'required|is_unique[user.email]');
		$this->form_validation->set_rules('reg-moto', 'Reg-moto', 'required|xss_clean');
		//jika rules sudah sesuai
		if($this->form_validation->run()){
			//deklarasi variabel
			$username = $this->input->post('reg-username');
			$email = $this->input->post('reg-email');
			$moto = $this->input->post('reg-moto');
			$session = $this->session->userdata;
			$fullname = $session['name'];
			$sex = $session['gender'];
			$id = $session['id'];
			$provider = $session['provider'];
			//input to database
			$params = array($id, $provider, $sex, $username, $email,$fullname,$moto);
			//START QUERY
			$sql = "INSERT INTO user(oauth_id, oauth_provider,gender,username,email, status, level, tgl_gabung,fullname, moto)
					VALUES(?,?,?,?,?,'active','user',CURDATE(),?,?)";
			if($this->db->query($sql, $params)){ //eksekusi query memasukan data ke database
				//Cek data user apakah sudah daftar
				$logindata = array($provider, $id);
				$sql = "SELECT * FROM user WHERE oauth_provider = ? AND oauth_id = ?";
				$query = $this->db->query($sql, $logindata);
				if($query->num_rows()>0){ //jika sudah terdaftar
					$result = $query->row_array();
					//create session
					if(!empty($result)) {
						//mengisi array session;
						$sessionData['is_logged_in'] = 1;				
						$this->session->set_userdata($result);				
						echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.alert('Login Success');
							window.location.href='".site_url()."';
						</SCRIPT>");
					} else {
						echo 'An Error creating seasson.';
						exit();
					}
				} else { //can find user
					echo 'An Error finding data.';
					exit();
				}
			}else {
				echo 'Problem insert user data';
				exit();
			}
			//END QUERY
		} else { //jika rules tidak sesuai
			$data['title'] = "Register";
			$this->defaultdisplay('user/register', $data);
			$this->footerdisplay();
		}
	}
}