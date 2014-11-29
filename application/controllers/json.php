<?php
// API using JSON
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';
class json extends base {
	//default page
	public function index(){
		echo '<center><h1>ERROR 404 : PAGE NOT FOUND </h1></center>';
	}
	//jelahah kompetisi
	public function jelajah(){//list kompetisi
		if(!empty($this->input->get('act'))){//if isset get
			switch ($this->input->get('act')) {
				// WORDKED
				case 'terbaru': //menampilkan 10 kompetisi terbaru
					$kompetisi = $this->m_kompetisi->json_kompetisi_terbaru();
					break;
				// WORKED
				case 'more':
					$lastid = $this->input->get('lastid');
					$id = $this->ki_id_dec($lastid);
					$kompetisi = $this->m_kompetisi->json_kompetisi_more($id);
					#code...
					break;
				// WORKED
				case 'search':
					$keyword = $this->input->get('q');
					$cat = $this->input->get('cat');
					if($cat == 0){//jika hanya search
						$kompetisi = $this->m_kompetisi->json_kompetisi_search($keyword);	
					} else { //jika disorting
						$kompetisi = $this->m_kompetisi->json_kompetisi_sort($keyword,$cat);
					}					
					break;
				// WORKED
				case 'searchmore':
					$keyword = $this->input->get('q');
					$lastid = $this->ki_id_dec($this->input->get('lastid'));
					$cat = $this->input->get('cat');
					if($cat == 0){//jika hanya search
						$kompetisi = $this->m_kompetisi->json_kompetisi_search_more($keyword,$lastid);
					} else { //jika disorting
						$kompetisi = $this->m_kompetisi->json_kompetisi_sort_more($keyword,$cat,$lastid);
					}
					break;
				default: //if not set action
					echo '<center><h1>ERROR 404 : </h1></center>';
					break;
			}
			//encode to JSON
			foreach($kompetisi as $k){
				//cek deadline
				if($k['deadline'] < 1){
					$deadline = "Kompetisi Telah Berakhir";
				} else {
					$deadline = $k['deadline'].' hari';
				}
				$id = $this-> ki_id_enc($k['id_kompetisi']);//enkripsi id kompetisi
				$judul = str_replace(' ', '-', $k['judul']);
				//start of rate
				$query_rating = "SELECT SUM(rating) AS 'rating' FROM rating WHERE id_kompetisi = ?";
				$query_rating = $this->db->query($query_rating,$k['id_kompetisi']);
				$query_rating = $query_rating->row_array();
				$total_rate =  $query_rating['rating']; //mendapatkan total rate
				if(empty($total_rate)){
					$total_rate = 0;
				}
				//cek total row
				$query_row_rating = "SELECT * FROM rating WHERE id_kompetisi = ?";
				$total_row = $this->db->query($query_row_rating,$k['id_kompetisi']);
				$total_row = $total_row->num_rows();
				if($total_row==0){
					$total_row = 1;//because  0 division 0 = ~
				}
				//rating sekarang
				$recent_rate = $total_rate / $total_row;
				//konvert ke bilangan bulat
				$recent_rate = round($recent_rate);
				//end of rate
				$data[] = array('id'=>$id,
				'judul'=>$k['judul'],
				'sortdesc'=>$k['sort'],
				'deadline'=>$deadline,
				'oleh'=>$k['username'],
				'penyelenggara'=>$k['penyelenggara'],
				'mainkat'=>$k['main_kat'],
				'total'=>$this->ki_money_convert($k['total']),
				'rate'=>$recent_rate,
				'views'=>$k['views'],
				'link'=>site_url('kompetisi/detail/'.$id.'/'.$judul),
				'authorlink'=>site_url('publik/profile/'.$k['username'])
				);//set detail kompetisi to id_kompetisi
			}
			$result = $data;
			echo json_encode($result);
		}else{ //jika tidak set get
			echo '<center><h1>ERROR 404 : </h1></center>';
		}
	}
	//detail kompetisi
	public function detail(){
	}
}