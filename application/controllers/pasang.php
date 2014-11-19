<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';


class pasang extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	//pasang function
	public function index() {
		//urusan captcha
		$tgl = date('d');
		$minutes = date('m');
		$second = date('s');
		$key = $tgl * $minutes * $second ;
		
		$vals = array(
			'word' => $key,
	        'img_path'   => './captcha/',
	        'img_url'    => base_url().'captcha/',
	        'img_width'  => '200',
	        'img_height' => 30,
	        'border' => 0,
	        'expiration' => 7200
        );
  		// create captcha image
        $cap = create_captcha($vals);
		// store image html code in a variable
		$data['title'] = "Pasang |";
        $data['image'] = $cap['image'];
        // store the captcha word in a session
        $this->session->set_userdata('mycaptcha', $cap['word']);
		$this->defaultdisplay('public/pasang', $data);
		$this->footerdisplay();
	}
}