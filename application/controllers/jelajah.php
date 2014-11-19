<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';

class jelajah extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
	}

	public function index() {
	
		$data['title'] = "Jelajah | ";		
		$data['kategori'] = $this->m_kompetisi->list_kategori(); //menampilkan kategori di top menu

		$this->defaultdisplay('public/newjelajah', $data);
		$this->footerdisplay();
	}
}