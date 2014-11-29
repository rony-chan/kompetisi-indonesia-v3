<?php
if(!defined('BASEPATH') ) exit ('No direct sript allowed');
//base class
class base extends CI_Controller {
	//constructor
	public function __construct(){
		parent::__construct();
		//auto load model
		$this->load->model('m_request');
		$this->load->model('m_kompetisi');
		$this->load->model('m_user');
		$this->load->model('m_moderator');
		$this->load->model('m_post');
		$this->load->model('m_super');
		$this->load->model('m_ads');		
	}
	public function defaultdisplay( $view_anak = '',$data = '' ) {
		$data['template_anak'] = $view_anak;
		$this->load->view('base/defaultbase', $data);
	}
	public function superdisplay( $view_anak = '',$data = ''  ){
		$data['template_anak'] = $view_anak;
		$this->load->view('base/superbase', $data);
		$this->load->view('super/footer');
	}
	public function footerdisplay(){		
		$this->load->view('base/defaultbase_footer');
	}
	//id encoder
	public function ki_id_enc($x){
		$enc = base64_encode(base64_encode($x));
		return str_replace('=', '', $enc);
	}
	//id decoder
	public function ki_id_dec($x){
		$dec = base64_decode(base64_decode($x));
		return str_replace('', '=', $dec);
	}
	//money converter
	public function ki_money_convert($x){
		$this->load->library('cart');
		if($x >= 1000000000) {
			$total = number_format($x / 1000000000,1);
			$x = $total;
			$y = 'Milyar';
		}else if($x >= 1000000 && $x <=1000000000) {
			$total = number_format($x / 1000000,1 );
			$x = $total;
			$y = 'Juta';
		} else if ($x >=1000 && $x <=1000000) {
			$total = number_format($x / 1000, 1);
			$x = $total;
			$y = 'Ribu';
		} else {
			$x = $x;
		}
		return 'Rp '.$this->cart->format_number($x).' '.$y;
	}
}