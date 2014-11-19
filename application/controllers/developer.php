<?php
//API CLASS ENCODE JSON FOR WEBSERVICE
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';


class developer extends base {
	//membuat construktor
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		echo '<center><h1>ERROR 403 : Forbidden Access</h1></center>';
	}

	public function jelajah(){
		//encode jelajah page to JSON 
		$limit = $this->input->get('limit'); //OFFSET
		$offset = $this->input->get('offset'); //LIMIT
		//if not set start/end
		//? this is the statement
		$kompetisi = $this->m_kompetisi->list_kompetisi($limit,$offset);
		foreach($kompetisi as $k):
			$id = base64_encode(base64_encode($k['id_kompetisi']));
			$id = str_replace('=', '', $id);
			$judul = $k['judul'];
			$judulweb = str_replace(' ', '-', $judul);
			$sort = $k['sort'];
			$penyelenggara = $k['penyelenggara'];
			$deadline = $k['deadline'];
			//jika kompetisi telah berakhir
			if($deadline<1){$deadline='Kompetisi telah berakhir';} else {$deadline = $deadline.' hari lagi';}
			$linkkompetisi = site_url('kompetisi/detail/'.$id.'/'.$judulweb);
			$linkuser = site_url('publik/profile/'.$k['username']);
			$poster = $k['poster'];
			$poster = base_url('images/poster/'.$poster);
			$hadiah = $k['total'];
			if($hadiah > 1000 && $hadiah < 1000000) {
				$hadiah = $hadiah/1000;
				$hadiah = 'Rp '.$hadiah.'Rb';
			} else if($hadiah > 1000000 && $hadiah < 1000000000) {
				$hadiah = $hadiah/1000000;
				$hadiah = 'Rp '.$hadiah.'Jt'; 
			} else if($hadiah > 1000000000 && $hadiah < 1000000000000) {
				$hadiah = $hadiah/1000000000;
				$hadiah = 'Rp '.$hadiah.'Milyar'; 
			}
			$mainkat = $k['main_kat'];
			$mainkatlink = site_url('start/kompetisi/jelajah?q=&kat='.$k['id_main_kat']);
			//CONVERT <br> to \n
			$rule = array('<br>','<br/>','</br>');
			$list[] = array('id'=>$id,'judul'=>$judul,'linkkompetisi'=>$linkkompetisi,'linkuser'=>$linkkompetisi,'poster'=>$poster,'sort'=>$sort,'hadiah'=>$hadiah,'penyelenggara'=>$penyelenggara, 'mainkat'=>$mainkat, 'mainkatlink'=>$mainkatlink,
			'deadline'=>$deadline);
		endforeach;
		$json['result'] = json_encode($list);
		echo $json['result'];
	}
}