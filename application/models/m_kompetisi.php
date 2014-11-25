<?php
	//membuat class model baru dengan nama m_admin
class m_kompetisi extends CI_Model{

	//////////////////////////////////
	///////DASHBOARD
	//////////////////////////////////

	//hitung total kompetisi yang diikuti oleh user
	function count_diikuti_kompetisi($id){
		$sql = "SELECT * FROM kompetisi_btn WHERE id_user = ? AND gabung = 1 ";
		$query = $this->db->query($sql, $id);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//hitung total kompetisi yang ditandai oleh user
	function count_tandai_kompetisi($id){
		$sql = "SELECT * FROM kompetisi_btn WHERE id_user = ? AND tandai = 1";
		$query = $this->db->query($sql, $id);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//hitung total kompetisi yang diupload oleh user
	function count_kompetisiku($id){
		$sql = "SELECT * FROM kompetisi WHERE author = ".$id." ";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}


	//////////////////////////////////
	///////OUTPUT
	//////////////////////////////////


	//total kompetisi aktif
	function count_kompetisi(){
		$sql = "SELECT * FROM kompetisi WHERE status = 'posted'";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//show competition by id_kompetisi
	function get_competition_by_id_kompetisi($id){
		if(!is_numeric($id)){$id=0;} //jika id bukan nomor
		$sql = "SELECT id_kompetisi, kompetisi.id_main_kat AS 'id_main_kat', kompetisi.id_sub_kat AS 'id_sub_kat', judul_kompetisi,poster,penyelenggara, konten, tgl_buat, tgl_edit, user.username AS 'author', main_kat.main_kat AS 'kategori', sort, hadiah, pengumuman, deadline, total_hadiah, sumber, rating,views
		FROM kompetisi LEFT JOIN user ON kompetisi.author = user.id_user 
		LEFT JOIN main_kat ON kompetisi.id_main_kat = main_kat.id_main_kat
		WHERE id_kompetisi = ".$id." ";
		//exec
		$query = $this->db->query($sql);
	    //show result
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return array();
		}
	}

	//show competition by id_user
	function get_competition_by_id_user($id, $limit, $offset){
		$sql = "SELECT * FROM kompetisi WHERE author = ".$id." ORDER BY id_kompetisi DESC LIMIT ".$limit." OFFSET ".$offset." ";
		//exec
		$query = $this->db->query($sql);
	    //show result
		if ($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	function title_kompetisi($id){
		$sql = "SELECT judul_kompetisi FROM kompetisi WHERE id_kompetisi = ?";
		//exec
		$query = $this->db->query($sql, $id);
	    //show result
		if ($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	function home_thumb() { //thumbnails slidder di halaman home
		//order by tgl edit dari yang terbesar
		$sql = "SELECT thumb.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb' FROM thumb LEFT JOIN kompetisi ON kompetisi.id_kompetisi = thumb.id_kompetisi WHERE kompetisi.status = 'posted'  ORDER BY kompetisi.tgl_buat DESC";
		$query = $this->db->query($sql);
		//show result as array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	function list_kompetisi($limit, $offset){ //list kompetisi di halaman jelajah
		$sql = "SELECT user.username AS 'username', kompetisi.poster AS 'poster',kompetisi.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb',kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara',views
		,kompetisi.id_main_kat AS 'id_main_kat'
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE kompetisi.status = 'posted' ORDER BY  kompetisi.tgl_buat DESC LIMIT ".$limit." OFFSET ".$offset." ";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	function show_kat(){ //lihat semua list main kategori
		$sql = "SELECT * FROM main_kat";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	function show_subkat(){ //lihat semua list sub kategori
		$sql = "SELECT * FROM main_kat";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//lihat main kategori
	function show_main_kat_by_id() {
		$sql = "SELECT * FROM main_kat ORDER BY id_main_kat ASC";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	function show_sub_kat(){
		$sql = "SELECT * FROM sub_kat ORDER BY id_sub_kat ASC";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//lihat sub kategori
	function show_sub_kat_by_id($id) {
		$sql = "SELECT * FROM sub_kat WHERE id_main_kat= '$id' ORDER BY id_sub_kat ASC";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//fungsi untuk pencarian di jelajah
	function search_jelajah($keyword, $limit, $offset){
		$sql = "SELECT user.username AS 'username', kompetisi.id_kompetisi AS 'id_kompetisi',kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total',main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara',views FROM kompetisi LEFT JOIN user ON kompetisi.author = user.id_user LEFT JOIN main_kat on main_kat.id_main_kat = kompetisi.id_main_kat WHERE kompetisi.status = 'posted' AND kompetisi.judul_kompetisi LIKE '%$keyword%' OR kompetisi.sort LIKE '%$keyword%' OR main_kat.main_kat = '%$keyword%'  ORDER BY  kompetisi.deadline - CURDATE() ASC LIMIT ".$limit." OFFSET ".$offset." ";
		$query = $this->db->query($sql, $keyword);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//menghitung hasil pencarian di jelajah
	function count_search_jelajah($keyword){
		$sql = "SELECT kompetisi.id_kompetisi AS 'id_kompetisi',kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total',main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara',views FROM kompetisi LEFT JOIN main_kat on main_kat.id_main_kat = kompetisi.id_main_kat WHERE kompetisi.status = 'posted' AND kompetisi.judul_kompetisi LIKE '%$keyword%' OR kompetisi.sort LIKE '%$keyword%' OR main_kat.main_kat = '%$keyword%'  ORDER BY  kompetisi.deadline - CURDATE() ASC ";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//fungsi untuk pencarian dan sort di jelajah
	function search_sort_jelajah($keyword, $kat, $limit, $offset){
		$sql = "SELECT user.username AS 'username', kompetisi.id_kompetisi AS 'id_kompetisi',kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', main_kat.main_kat AS 'main_kat',kompetisi.penyelenggara AS 'penyelenggara',views FROM kompetisi LEFT JOIN user on user.id_user = kompetisi.author LEFT JOIN main_kat on main_kat.id_main_kat = kompetisi.id_main_kat  WHERE kompetisi.status = 'posted' AND kompetisi.judul_kompetisi LIKE '%$keyword%' AND kompetisi.id_main_kat = ".$kat."  ORDER BY  kompetisi.deadline - CURDATE() ASC LIMIT ".$limit." OFFSET ".$offset." ";
		$query = $this->db->query($sql, $keyword);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//menghitung hasil pencarian berdasarkan kategori
	function count_search_sort_jelajah($keyword, $kat){
		$sql = "SELECT kompetisi.id_kompetisi AS 'id_kompetisi',kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' FROM kompetisi LEFT JOIN main_kat on main_kat.id_main_kat = kompetisi.id_main_kat  WHERE kompetisi.status = 'posted' AND kompetisi.judul_kompetisi LIKE '%$keyword%' AND kompetisi.id_main_kat = ".$kat."  ORDER BY  kompetisi.deadline - CURDATE() ASC ";
		$query = $this->db->query($sql);
		//cek data apakah tersedia
		$result = $query->num_rows();
		return $result;
	}

	//sidebar kompetisi terbaik
	function kompetisi_terbaik(){
		$sql = "SELECT kompetisi.id_kompetisi AS 'id',poster, judul_kompetisi FROM kompetisi LEFT JOIN kompetisi_btn ON kompetisi.id_kompetisi = kompetisi_btn.id_kompetisi WHERE kompetisi.status = 'posted' ORDER BY kompetisi_btn.tandai DESC LIMIT 7 OFFSET 0";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//////////////////////////////////
	////////KOMPETISI n USER
	//////////////////////////////////

	//////////////////////////////////
	///////USER REQUEST

	//rating kompetisi
	function rating($param){
		$sql = "UPDATE kompetisi set rating = rating + ? WHERE id_kompetisi = ?";

	}

	//melihat request yang belum diterima, status = waiting	
	function show_waiting_request($limit, $offset){ //ITS WORK
		$sql = "SELECT id_kompetisi, user.username AS 'username', sub_kat.sub_kat AS 'sub_kat', judul_kompetisi, penyelenggara, tgl_buat, tgl_edit, main_kat.main_kat AS 'main_kat', total_hadiah, sumber, kompetisi.status AS 'status_kompetisi' 
		FROM kompetisi 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		LEFT JOIN main_kat ON kompetisi.id_main_kat = main_kat.id_main_kat
		LEFT JOIN sub_kat ON kompetisi.id_sub_kat = sub_kat.id_sub_kat  
		WHERE kompetisi.status = 'waiting' AND user.status = 'active' 
		ORDER BY kompetisi.tgl_buat LIMIT ".$limit." OFFSET  ".$offset."";
		$query = $this->db->query($sql);
		//show result
		if($query->num_rows > 0) {
			$k_result = $query->result_array();
			$query->free_result();
			return $k_result;
		} else {
			return array();
		}
	}
	//melihat request yang ditolak, status = reject
	function show_reject_request($limit, $offset){ //ITS WORK
		$sql = "SELECT id_kompetisi, user.username AS 'username',sub_kat.sub_kat AS 'sub_kat', judul_kompetisi, penyelenggara, tgl_buat, tgl_edit, main_kat.main_kat AS 'main_kat', total_hadiah, sumber, kompetisi.status AS 'status_kompetisi' 
		FROM kompetisi 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		LEFT JOIN main_kat ON kompetisi.id_main_kat = main_kat.id_main_kat
		LEFT JOIN sub_kat ON kompetisi.id_sub_kat = sub_kat.id_sub_kat   
		WHERE kompetisi.status = 'reject' AND user.status = 'active' 
		ORDER BY kompetisi.tgl_buat LIMIT ".$limit." OFFSET  ".$offset."";
		$query = $this->db->query($sql);
		//show result
		if($query->num_rows > 0) {
			$k_result = $query->result_array();
			$query->free_result();
			return $k_result;
		} else {
			return array();
		}
	}
	//melihat request yang sudah tampil status = posted
	function show_accept_request($limit, $offset){ //ITS WORK
		$sql = "SELECT id_kompetisi, user.username AS 'username',sub_kat.sub_kat AS 'sub_kat',  judul_kompetisi, penyelenggara, tgl_buat, tgl_edit, main_kat.main_kat AS 'main_kat', total_hadiah, sumber, kompetisi.status AS 'status_kompetisi' 
		FROM kompetisi 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		LEFT JOIN main_kat ON kompetisi.id_main_kat = main_kat.id_main_kat
		LEFT JOIN sub_kat ON kompetisi.id_sub_kat = sub_kat.id_sub_kat   
		WHERE kompetisi.status = 'posted' AND user.level != 'admin' AND user.status = 'active' 
		ORDER BY kompetisi.tgl_buat LIMIT ".$limit." OFFSET  ".$offset."";
		$query = $this->db->query($sql);
		//show result
		if($query->num_rows > 0) {
			$k_result = $query->result_array();
			return $k_result;
		} else {
			return array();
		}
	}

	//fungsi untuk menerima request kompetisi
	function btn_accept_request($id){ //menerima request berdasarkan id kompetisi
		$sql = "UPDATE kompetisi SET status = 'posted' WHERE id_kompetisi = ?";
		//menjadi true
		if($this->db->query($sql, $id)) {
			return true;
		} else {
			return false;
		}
		
	}

	//fungsi untuk menerima request kompetisi
	function btn_reject_request($id){ //menerima request berdasarkan id kompetisi
		$sql = "UPDATE kompetisi SET status = 'reject' WHERE id_kompetisi = ?";
		//menjadi true
		if($this->db->query($sql, $id)) {
			return true;
		} else {
			return false;
		}
		
	}

	//untuk melihat apakah sudah ditandai/gabung/tidak keduany
	function cek_btn($params){
		$sql = "SELECT * FROM kompetisi_btn WHERE id_kompetisi = ? AND id_user = ?";
		$query = $this->db->query($sql, $params);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//lihat kompetisi yang dipasang oleh user
	function show_kompetisi_dipasang($id, $limit, $offset) {
		$sql = "SELECT views,user.username AS 'authusername', kompetisi.poster AS 'poster',kompetisi.id_kompetisi AS 'id',thumb.thumb AS 'thumb',kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' 
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE kompetisi.status = 'posted' AND kompetisi.author = ? ORDER BY  kompetisi.tgl_buat DESC LIMIT ".$limit." OFFSET ".$offset." ";
		$query = $this->db->query($sql, $id);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//lihat kompetisi yang ditandai oleh user
	function show_kompetisi_diikuti($id, $limit, $offset) {
		$sql = "SELECT views,user.username AS 'authusername',  kompetisi.id_kompetisi AS 'id', main_kat.main_kat AS 'main_kat', kompetisi.judul_kompetisi AS 'judul', kompetisi.penyelenggara AS 'penyelenggara',kompetisi.sort AS 'sort',kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.pengumuman - CURDATE() AS ' pengumuman', kompetisi.total_hadiah AS 'total' FROM kompetisi
		LEFT JOIN kompetisi_btn ON kompetisi.id_kompetisi = kompetisi_btn.id_kompetisi 
		LEFT JOIN user ON user.id_user = kompetisi.author 
		LEFT JOIN main_kat ON main_kat.id_main_kat=kompetisi.id_main_kat 
		WHERE kompetisi_btn.id_user = ".$id." AND kompetisi_btn.tandai = 1 ORDER BY kompetisi.pengumuman DESC 
		LIMIT ".$limit." OFFSET ".$offset." ";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//lihat kompetisi yang diikuti oleh user
	function show_kompetisi_gabung($id, $limit, $offset) {
		$sql = "SELECT views,user.username AS 'authusername',kompetisi.id_kompetisi AS 'id', main_kat.main_kat AS 'main_kat',  kompetisi.judul_kompetisi AS 'judul', kompetisi.penyelenggara AS 'penyelenggara',kompetisi.sort AS 'sort', kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.pengumuman - CURDATE()  AS ' pengumuman', kompetisi.total_hadiah AS 'total' 
		FROM kompetisi LEFT JOIN kompetisi_btn ON kompetisi.id_kompetisi = kompetisi_btn.id_kompetisi 
		LEFT JOIN user ON user.id_user = kompetisi.author
		LEFT JOIN main_kat ON main_kat.id_main_kat= kompetisi.id_main_kat 
		WHERE kompetisi_btn.id_user = ".$id." AND kompetisi_btn.gabung = 1  
		ORDER BY kompetisi.pengumuman DESC LIMIT ".$limit." OFFSET ".$offset."";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	///////////////////////////////////
	////////HOMEPAGE
	///////////////////////////////////
	//total kompetisi aktif
	function count_aktif(){
		$sql = "SELECT COUNT(*) AS 'aktif' FROM kompetisi WHERE deadline > CURDATE() AND status = 'posted'";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->row_array();
			return $g_result;
		} else {
			return array();
		}
	}
	//kompetisi bulan ini
	function month_kompetisi(){
		$sql = "SELECT COUNT(*) AS 'total' FROM kompetisi WHERE MONTH(tgl_buat) = MONTH(CURDATE()) AND status = 'posted'";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//total hadiah bulan ini
	function count_hadiah(){
		$sql = "SELECT SUM(total_hadiah) AS 'total' FROM kompetisi WHERE MONTH(tgl_buat) = MONTH(CURDATE()) AND status = 'posted'";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//menghitung total post
	function count_kategori(){
		$sql = "SELECT COUNT(*) AS 'total' FROM main_kat";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	//////////////////////////////////
	///////KATEGORI
	//////////////////////////////////
	function list_kategori(){
		$sql = "SELECT * FROM main_kat";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//////////////////////////////////
	///////INPUT
	////////////////////////////////// 
	function pasang($params){ //user yang sudah login untuk memasang kompetisi
		$now = Date('Y-m-d H:i:s');	
		$sql = "INSERT INTO kompetisi 
		(judul_kompetisi, sort, poster, penyelenggara, konten, tgl_buat, tgl_edit, author, id_main_kat,id_sub_kat, deadline, pengumuman, total_hadiah, hadiah, sumber, status) 
		VALUES ( ? , ? , ? , ?, ?, '$now' , '$now', ?, ?,?, ?, ?, ?, ?, ?, 'waiting');";
		if($this->db->query($sql, $params)) {
			return true;
		} else {
			return false;
		}
	}
	function edit($params){ //fungsi untuk edit kompetisi yang ditambahkan oleh user
		$now = Date('Y-m-d H:i:s');	
		//judul,sort,poster,penyelenggara,konten,main_kat, total, hadiah,sumber,id_kompetisi
		$sql = "UPDATE kompetisi SET judul_kompetisi = ?, sort = ?, poster = ?, penyelenggara = ?, konten = ?,id_main_kat = ?, id_sub_kat= ?, tgl_edit = '$now',  deadline = ?, pengumuman = ?, total_hadiah = ?, hadiah = ?, sumber = ?, status = ? WHERE id_kompetisi = ? ";
		if($this->db->query($sql, $params)) {
			return true;
		} else {
			return false;
		}
	}
	function kompetisi_btn($params) {
		//ketika user yang login buka detail kompetisi, otomatis insert 
		//data ke tabel kompetisi_btn
		$sql = "SELECT * FROM kompetisi_btn WHERE id_kompetisi  = ? AND id_user = ?";
		$query = $this->db->query($sql, $params);
		//show array
		if($query->num_rows() > 0) {
			return true;
		} else {
			$insert = "INSERT INTO kompetisi_btn(id_kompetisi, id_user) VALUES(?,?)";
			if($this->db->query($insert, $params)) {
				return true;
			} else {
				return false;
			}
		}
	}
	//hitung yang gabung
	function count_gabung($id) {
		$sql = "SELECT COUNT(*) AS 'total' FROM kompetisi_btn WHERE id_kompetisi = ? AND gabung = 1";
		$query = $this->db->query($sql, $id);
		//show result
		if ($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result; //menampilkan total yang menandai
		} else {
			return array();
		}
	}
	//hitung penanda
	function count_tandai($id) {
		$sql = "SELECT COUNT(*) AS 'total' FROM kompetisi_btn WHERE id_kompetisi = ? AND tandai = 1";
		$query = $this->db->query($sql, $id);
		//show result
		if ($query->num_rows() > 0) {
			$g_result = $query->row_array();
			$query->free_result();
			return $g_result; //menampilkan total yang menandai
		} else {
			return array();
		}
	}

	//hapus kompetisi
	function delete_kompetisi($id){
		$sql ="DELETE FROM kompetisi WHERE id_kompetisi = ?";
		if($this->db->query($sql, $id)) {
			return true;
		} else {
			return false;
		}
	}

	////////////////////////////////////////////////////////////////////////
	/////////////////////////////// JSON ///////////////////////////////////
	////////////////////////////////////////////////////////////////////////

	//latest 10 kompetisi
	function json_kompetisi_terbaru(){ //list kompetisi di halaman jelajah
		$sql = "SELECT user.username AS 'username', kompetisi.poster AS 'poster',
		kompetisi.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb',
		kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', 
		kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', 
		main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' 
		,kompetisi.id_main_kat AS 'id_main_kat',views
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE kompetisi.status = 'posted' ORDER BY  kompetisi.tgl_buat DESC LIMIT 10 OFFSET 0 ";
		$query = $this->db->query($sql);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//more 10 kompetisi
	function json_kompetisi_more($lastid){
		$sql = "SELECT user.username AS 'username', kompetisi.poster AS 'poster',
		kompetisi.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb',
		kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', 
		kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', 
		main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' 
		,kompetisi.id_main_kat AS 'id_main_kat',views
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE kompetisi.status = 'posted' 
		AND kompetisi.id_kompetisi < ? ORDER BY  kompetisi.tgl_buat DESC LIMIT 10 OFFSET 0 ";
		$query = $this->db->query($sql,$lastid);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//search kompetisi
	function json_kompetisi_search($q){ //$q = keyword
		$sql = "SELECT user.username AS 'username', kompetisi.poster AS 'poster',
		kompetisi.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb',
		kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', 
		kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', 
		main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' 
		,kompetisi.id_main_kat AS 'id_main_kat',views
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE kompetisi.status = 'posted' 
		AND (kompetisi.judul_kompetisi like '%".$q."%' OR main_kat.main_kat like '%".$q."%')
		ORDER BY kompetisi.tgl_buat DESC LIMIT 10 OFFSET 0 ";
		$query = $this->db->query($sql,$q);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//search more kompetisi
	function json_kompetisi_search_more($q,$lastid){ //$q = keyword
		$sql = "SELECT user.username AS 'username', kompetisi.poster AS 'poster',
		kompetisi.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb',
		kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', 
		kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', 
		main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' 
		,kompetisi.id_main_kat AS 'id_main_kat',views
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE 
		kompetisi.status = 'posted'
		AND kompetisi.id_kompetisi < ".$lastid."
		AND (kompetisi.judul_kompetisi like '%".$q."%' OR main_kat.main_kat like '%".$q."%')
		ORDER BY kompetisi.tgl_buat DESC LIMIT 10 OFFSET 0 ";
		$query = $this->db->query($sql,$q);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//sort kompetisi
	function json_kompetisi_sort($q,$c){ //$q = keyword
		$sql = "SELECT user.username AS 'username', kompetisi.poster AS 'poster',
		kompetisi.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb',
		kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', 
		kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', 
		main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' 
		,kompetisi.id_main_kat AS 'id_main_kat',views
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE kompetisi.status = 'posted' 
		AND kompetisi.id_main_kat = ".$c."
		AND (kompetisi.judul_kompetisi like '%".$q."%' OR main_kat.main_kat like '%".$q."%')
		ORDER BY kompetisi.tgl_buat DESC LIMIT 10 OFFSET 0 ";
		$query = $this->db->query($sql,$q);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}
	//sort kompetisi more
	function json_kompetisi_sort_more($q,$c,$l){ //$q = keyword
		$sql = "SELECT user.username AS 'username', kompetisi.poster AS 'poster',
		kompetisi.id_kompetisi AS 'id_kompetisi',thumb.thumb AS 'thumb',
		kompetisi.sort AS 'sort', kompetisi.judul_kompetisi AS 'judul', 
		kompetisi.deadline - CURDATE() AS 'deadline', kompetisi.total_hadiah AS 'total', 
		main_kat.main_kat AS 'main_kat', kompetisi.penyelenggara AS 'penyelenggara' 
		,kompetisi.id_main_kat AS 'id_main_kat',views
		FROM kompetisi 
		LEFT JOIN thumb on kompetisi.id_kompetisi = thumb.id_kompetisi 
		LEFT JOIN main_kat ON main_kat.id_main_kat = kompetisi.id_main_kat 
		LEFT JOIN user ON kompetisi.author = user.id_user 
		WHERE kompetisi.status = 'posted' 
		AND kompetisi.id_main_kat = ".$c."
		AND kompetisi.id_kompetisi < ".$l."
		AND (kompetisi.judul_kompetisi like '%".$q."%' OR main_kat.main_kat like '%".$q."%')
		ORDER BY kompetisi.tgl_buat DESC LIMIT 10 OFFSET 0 ";
		$query = $this->db->query($sql,$q);
		//show array
		if($query->num_rows() > 0) {
			$g_result = $query->result_array();
			$query->free_result();
			return $g_result;
		} else {
			return array();
		}
	}

	////////////////////////////////////////////////////////////
	///////////////////////TENTANG PESERTA//////////////////////
	////////////////////////////////////////////////////////////
	//menampilkan peserta yang belum diverifikasi
	public function unverified_participans($id){//id kompetisi
		$sql = "SELECT user.username AS 'username',user.fullname AS 'name',user.email AS 'email',user.gender AS 'gender'
		FROM user INNER JOIN kompetisi_btn ON kompetisi_btn.id_user = user.id_user
		INNER JOIN kompetisi ON kompetisi_btn.id_kompetisi = kompetisi.id_kompetisi
		WHERE kompetisi_btn.tandai = 1 AND kompetisi_btn.verified = 0 AND kompetisi_btn.id_kompetisi = ?";
		$query = $this->db->query($sql,$id);
		if($query->num_rows()>0){
			return $query->result_array();
		} else {
			return array();
		}
	}

	//menampilkan peserta yang terverifikasi
	public function verified_participans($id){//id kompetisi
		$sql = "SELECT user.username AS 'username',user.fullname AS 'name',user.email AS 'email',user.gender AS 'gender'
		FROM user INNER JOIN kompetisi_btn ON kompetisi_btn.id_user = user.id_user
		INNER JOIN kompetisi ON kompetisi_btn.id_kompetisi = kompetisi.id_kompetisi
		WHERE kompetisi_btn.tandai = 1 AND kompetisi_btn.verified = 1 AND kompetisi_btn.id_kompetisi = ?";
		$query = $this->db->query($sql,$id);
		if($query->num_rows()>0){
			return $query->result_array();
		} else {
			return array();
		}
	}


	////////////////////////////////////////////////////////////
	///////////////////////TENTANG KABAR///////////////////////
	////////////////////////////////////////////////////////////

	public function empat_kabar_baru(){
		$this->db->order_by('id','desc');
		$kabar = $this->db->get('post', 4);
		return $kabar->result_array();
	}

}