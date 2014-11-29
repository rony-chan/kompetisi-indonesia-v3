<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class telkom extends base
{
	// function Telkom(){
	// 	parent::Controller();
	// }
	public function index(){
        $a = array('namaku'=> 'akusaja');
        $this->session->set_userdata($a);
        print_r($this->session->all_userdata());
		echo "andriyas";
	}
	public function oauth_php(){
		try {
			$oauth = new OAuth('bestapp266','2AXO4');
			$request_token_info = $oauth->getRequestToken("http://sandbox.appprime.net/TemanDev/rest/RequestToken/");
			if(!empty($request_token_info)) {
				print_r($request_token_info);
			} else {
				print "Failed fetching request token, response was: " . $oauth->getLastResponse();
			}
		} catch(OAuthException $E) {
			echo "Response: ". $E->lastResponse . "\n";
		}
	}
}