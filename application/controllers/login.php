<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class login extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		echo '<h1><center>403 : FORBIDEN</center></h1>';
	}
	public function facebook(){
	}
}