<?php
	//membuat class model baru dengan nama m_admin
class m_super extends CI_Model{
	
	function can_log_in($username, $password){
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		//$this->db->where('level', 'admin');
		//$this->db->or_where('level', 'moderator');
		$this->db->where('status', 'active');
		$query = $this->db->get('user');
		//struktur kendali untuk cek apakah data ada atau tidak
		if($query->num_rows() > 0) { //jika ada data yang ditemukan
			//maka menampilkan hasilnya sebagai baris array
			return $query->row_array();
		} 
	}

	///////////////////////KOMPETISI///////////////////////////

	function add_kompetisi($params){ //add kompetisi oleh admin
		$now = Date('Y-m-d H:i:s');	
		$sql = "INSERT INTO kompetisi (judul_kompetisi, sort, poster, penyelenggara, konten, tgl_buat, tgl_edit, author, id_main_kat,id_sub_kat, deadline, pengumuman, total_hadiah, hadiah, sumber, status) 
		VALUES ( ? , ? , ? , ?, ?, '$now' , '$now', ?, ?,?, ?, ?, ?, ?, ?, 'posted');";
		if($this->db->query($sql, $params)) {
			return true;
		} else {
			return false;
		}
	}

	function edit_kompetisi(){ //edit postingan yang dibuat oleh user
		if(isset($_POST)) {
			$author = $this->session->userdata('id_user');//id user
			$kat = $this->input->post('subkategori');//id kategori
			$judul = $this->input->post('judul'); //judul
			$sort = $this->input->post('sort'); //deskripsi singkat
			$deadline = $this->input->post('deadline'); //deadline kompetisi
			$pengumuman = $this->input->post('pengumuman'); //dpengumuman kompetisi
			$penyelenggara = $this->input->post('penyelenggara'); //penyelenggara kompetisi
			$konten = $this->input->post('deskripsi'); //syarat dan ketentuan
			$total = $this->input->post('total'); //total hadiah
			$hadiah = $this->input->post('hadiah');//detail hadiah
			$link = $this->input->post('link');//link sumber kompetisi
			$gambar = $_FILES['poster'];//poster
			$img = $this->input->post('poster_lama');//jika tidak upload poster
			$id_kompetisi = $this->input->post('id_kompetisi'); //id kompetisi
			//jika upload poster
			if (isset($_FILES['poster'])) {
				$gambar_nama = str_replace(' ', '_', $gambar['name']); //rename ' ' menjadi '-'
				$this->load->library('upload');
				//config untuk library upload
				$config['upload_path'] = './images/poster';
				$config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
				$config['overwrite'] = true;
				$config['max_size'] = 1000000; //1MB
				$this->upload->initialize($config);
				$this->upload->do_upload('poster');
				echo $this->upload->display_errors();			
				
			} else {
				$gambar_nama = $img; //post
			}

			if(isset($_POST['btn_submit'])) {
				$status = 'waiting';
			} else if(isset($_POST['btn_draft'])) {
				$status = 'draft';
			}

			$params = array($judul, $sort, $gambar_nama, $penyelenggara,$konten, $kat, $deadline, $pengumuman,	$total, $hadiah, $link, $status,$id_kompetisi, $status); //untuk diinput kedatabase
			
			if($this->m_kompetisi->edit($params)) { //jika insert data ke database
				echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Update Berhasil');
				window.location.href='../../dashboard/saya';
				</SCRIPT>");
			} else {

				echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('terjadi kesalahan, silahkan coba lagi');
				window.location.href='../../dashboard/saya';
				</SCRIPT>");
			}
		} else {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('terjadi kesalahan, silahkan coba lagi');
				window.location.href='../../dashboard/saya';
				</SCRIPT>");
			//redirect(site_url('dashboard')); //jika tidak menekan brn_pasang maka akan diredirect ke dashboard
		}	
	}


	//total kompetisi aktif
	public function count_posted(){
		$this->db->select('*');
		$this->db->where('author', '1');
		$this->db->where('status', 'posted');
		$query = $this->db->get('kompetisi');
		//struktur kendali untuk cek apakah data ada atau tidak
		$total = $query->num_rows();
		return $total;
	}

	//total kompetisi draft
	public function count_draft(){
		$this->db->select('*');
		$this->db->where('author', '1');
		$this->db->where('status', 'draft');
		$query = $this->db->get('kompetisi');
		//struktur kendali untuk cek apakah data ada atau tidak
		$total = $query->num_rows();
		return $total;
	}

	//menampilkan kompetisi yang sudah ditampilkan
	public function posted($limit, $offset){
		$sql = "SELECT user.username AS 'nama', kompetisi.id_kompetisi AS 'id_kompetisi',kompetisi.judul_kompetisi AS 'judul_kompetisi', main_kat.main_kat AS 'id_main_kat', sub_kat.sub_kat AS 'id_sub_kat', kompetisi.status AS 'status',rating,views
		FROM kompetisi 
		INNER JOIN main_kat ON kompetisi.id_main_kat = main_kat.id_main_kat 
		INNER JOIN sub_kat ON kompetisi.id_sub_kat = sub_kat.id_sub_kat
		INNER JOIn user on user.id_user = kompetisi.author
		WHERE user.level != 'user'  AND kompetisi.status = 'posted' 
		ORDER BY kompetisi.tgl_buat DESC LIMIT ".$limit." OFFSET ".$offset."";
		$query = $this->db->query($sql);
		//struktur kendali untuk cek apakah data ada atau tidak
		if($query->num_rows() > 0) { //jika ada data yang ditemukan
			//maka menampilkan hasilnya sebagai baris array
			return $query->result_array();
		} 
	}

	//menampilkan kompetisi draft
	public function draft($limit, $offset){
		$sql = "SELECT user.username AS 'nama', kompetisi.id_kompetisi AS 'id_kompetisi',kompetisi.judul_kompetisi AS 'judul_kompetisi', main_kat.main_kat AS 'id_main_kat', sub_kat.sub_kat AS 'id_sub_kat', kompetisi.status AS 'status',rating,views
		FROM kompetisi 
		INNER JOIN main_kat ON kompetisi.id_main_kat = main_kat.id_main_kat 
		INNER JOIN sub_kat ON kompetisi.id_sub_kat = sub_kat.id_sub_kat
		INNER JOIn user on user.id_user = kompetisi.author
		WHERE user.level != 'user'  AND kompetisi.status = 'draft' 
		ORDER BY kompetisi.tgl_buat DESC LIMIT ".$limit." OFFSET ".$offset."";
		$query = $this->db->query($sql);
		//struktur kendali untuk cek apakah data ada atau tidak
		if($query->num_rows() > 0) { //jika ada data yang ditemukan
			//maka menampilkan hasilnya sebagai baris array
			return $query->result_array();
		} 
	}

	//counting//

	//total request kompetisi yang belum di terima
	public function count_waiting_competition(){
		$this->db->where('status','waiting');
		return $this->db->count_all_results('kompetisi');
	}
	//total link dan poster yang belum diterima
	public function count_waiting_link_poster(){
		$this->db->where('status','waiting');
		return $this->db->count_all_results('request');
	}
	//total news
	public function count_news(){
		$this->db->where('status','post');
		return $this->db->count_all_results('post');
	}
	//total competition
	public function count_competition(){
		$this->db->where('status','posted');
		return $this->db->count_all_results('kompetisi');
	}
	//total user
	public function count_user_active(){
		$this->db->where('level','user');
		$this->db->where('status','active');
		return $this->db->count_all_results('user');
	}
	//total moderator
	public function count_moderator_active(){
		$this->db->where('level','moderator');
		$this->db->where('status','active');
		return $this->db->count_all_results('user');
	}
}