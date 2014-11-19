<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'application/controllers/base/base.php';
class ads extends base {

	public function index() {	
		$this->load->library('cart');
		$data['title'] = 'Ads | ';
		$data['type'] = $this->m_ads->showAllAdsType();//show all ads type
		$this->defaultdisplay('ads', $data);
		$this->footerdisplay();			
	}

	public function manage(){
		//redirect ads manager
		redirect(site_url('dashboard/ads'));//only member
	}
}
