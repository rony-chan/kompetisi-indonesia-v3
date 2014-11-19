<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feed extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('xml','text'));
		$this->load->model('m_rss');
	}

	function index(){ //rss maker
		//set data what we set
		$data['encoding'] = 'utf-8';
		$data['feed_name'] = 'Kompetisiindonesia.com';
		$data['feed_url'] = 'http://kompetisiindonesia.com/feed';
		$data['creator_email'] = 'yussan@kompetisiindonesia.com';
		$data['page_description'] = 'Kompetisi Indonesia Kompetisi Dengan Cara Berbeda';
		$data['page_language'] = 'id';
		// $data['creator_email'] = 'yussan@kompetisiindonesia.com<script>
		// 		/* <![CDATA[ */
		// 		(function(){try{var s,a,i,j,r,c,l,b=document.getElementsByTagName("script");l=b[b.length-1].previousSibling;a=l.getAttribute("data-cfemail");if(a){s='';r=parseInt(a.substr(0,2),16);for(j=2;a.length-j;j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}s=document.createTextNode(s);l.parentNode.replaceChild(s,l);}}catch(e){}})();
		// 		/* ]]> */
		// 		</script>';
		$data['post'] = $this->m_rss->get_post(10);
		date_default_timezone_set('Asia/Jakarta');
		header("Content-Type: application/rss+xml");
		$this->load->view('rss', $data);		
	}
}