<style type="text/css">
	.add-in{background-color: #F2F2F2;padding: 10px;}
</style>
<?php 
echo $script2; 
?>
<br/>
<div class="row-fluid">
	<?php $this->load->view('super/menu/sidebar') //load the sidebar ?>
	<div class="col-md-10">

		<div class="panel panel-default">
			<div class="panel-heading">Kategori</div>
			<div class="panel-body">
				<!-- end of modification -->
				<?php 
				if(!empty($_GET)){
					switch ($_GET['act']) {			

						case 'tambahmain': //WORK
						//proses tambah main
						echo '						
						<div class="fade in add-in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<h1>Tambah Main Kategori</h1>
						<form class="form" method="POST" action="?act=proc_tambahmain">
							<div class="form-group">
							    <label for="exampleInputEmail1">Nama Main Kategori</label>
							    <input name="inputKategori" type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Kategori">
							  </div>
							  <button class="btn btn-default" type="submit" >Tambah</button>
						</form>
						</div>';
						break;

						case 'proc_tambahmain': //WORK
							$mainkat = $_POST['inputKategori'];
							$data = array('main_kat'=>$mainkat);
							$this->db->insert('main_kat',$data);
							redirect(site_url('super/super/kategori'));
						break;

						case 'tambahsub': //WORK
						$id = $_GET['id'];//get id main_kompetisi
						echo '						
						<div class="fade in add-in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<h1>Tambah Sub Kategori</h1>
						<form class="form" method="POST" action="?act=proc_tambahsub">
							<div class="form-group">
							    <label for="exampleInputEmail1">Nama Sub Kategori</label>
							    <input type="hidden" name="mainkat" value="'.$id.'">
							    <input name="inputSubKategori" type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Kategori">
							  </div>
							  <button class="btn btn-default" type="submit" >Tambah</button>
						</form>
						</div>';
						break;

						case 'proc_tambahsub': //WORK
							$subkat = $_POST['inputSubKategori'];
							$mainkat = $_POST['mainkat'];
							$data = array('id_main_kat'=>$mainkat,'sub_kat'=>$subkat);
							$this->db->insert('sub_kat',$data);
							redirect(site_url('super/super/kategori'));
						break;

						case 'lihatsub':
							$id = $_GET['id'];//get id main_kompetisi
							$this->db->where('id_main_kat',$id);
							$query = $this->db->get('sub_kat');
							$subkat = $query->result_array();
							echo '						
							<div class="fade in add-in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<h1>Sub Kategori</h1>';
							foreach($subkat as $s):
								echo '<table clas="table table-striped">';
								echo '<tr>';
								echo '<td><form method="POST" action="?act=proc_edit_sub"><input class="form-control" type="text" name="inputNama" value="'.$s['sub_kat'].'"><input class="form-control" type="hidden" name="id_subkat" value="'.$s['id_sub_kat'].'"><input class="form-control" type="hidden" name="id_mainkat" value="'.$s['id_main_kat'].'"></td>';
								echo '<td><button type="submit" name="btn_edit" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button><button onclick="return confirm(\'Anda Yakin!\');" type="submit" name="btn_delete" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button></form></td>';
								echo '</tr>';
								echo '</table>';
							endforeach;
							echo '</div>';
						break;

						case 'edit': //edit main kategori
							$id = $_GET['id'];//get id main_kompetisi
							$this->db->where('id_main_kat',$id);
							$query = $this->db->get('main_kat');
							$mainkat = $query->row_array();
							echo '						
							<div class="fade in add-in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<h1>Edit Main Kategori</h1>
							<form class="form" method="POST" action="?act=proc_edit">
								<div class="form-group">
								    <label for="exampleInputEmail1">Nama main Kategori</label>
								    <input type="hidden" name="id_mainkat" value="'.$mainkat['id_main_kat'].'">
								    <input name="nama_mainkat" type="text" class="form-control" id="exampleInputEmail1" value="'.$mainkat['main_kat'].'">
								  </div>
								  <button class="btn btn-default" type="submit" >Update</button>
							</form>
							</div>';
							
						break;

						case 'proc_edit': //proses edit main kategori WORK
							$id = $_POST['id_mainkat'];
							$nama = $_POST['nama_mainkat'];
							$data= array('main_kat'=>$nama);
							$this->db->where('id_main_kat',$id);
							$this->db->update('main_kat',$data);
							redirect(site_url('super/super/kategori'));
						break;

						case 'proc_edit_sub':							
							$idmainkat = $_POST['id_mainkat'];
							$idsubkat = $_POST['id_subkat'];
							$nama = $_POST['inputNama'];
							if(isset($_POST['btn_edit'])) { //edit sub_kat WORK
								$data = array(
									'sub_kat'=>$nama
									);
								$this->db->where('id_sub_kat',$idsubkat);
								$this->db->update('sub_kat',$data);
							} else if(isset($_POST['btn_delete'])){ //delete sub_kat WORK
								$this->db->delete('sub_kat',array('id_sub_kat'=>$idsubkat));
							}
							redirect(site_url('super/super/kategori'));
						break;

						case 'delete': //WORK
							$id = $_GET['id'];//get id main_kompetisi
							$this->db->delete('main_kat',array('id_main_kat'=>$id));
							redirect(site_url('super/super/kategori'));
						break;

						default:
								echo '<h1>Get Out Hacker</h1>';
						break;
					}
				}
				?>
<!-- modification -->
<div class="tabbable" > <!-- Only required for left/right tabs -->
	<br/>
	<div class="tab-content">


		<!--active-->
		<div class="tab-pane active" id="active">
			<a class="btn btn-default" href="?act=tambahmain">+ Tambah Main</a>
			<table class="table table-hover">
				<thead>
					<tr>
						<td><strong>No</strong></td>
						<td><strong>Nama Kategori</strong></td>
						<td><strong>Jumlah Sub Kategori</strong></td>
						<td><strong>Jumlah Kompetisi</strong></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php 
					$n = 1;
					foreach($kategori as $k) { ?>
					<tr>
						<td><?php echo $n ?></td>
						<td><?php echo $k['main_kat'] ?></td>
						<td>
							<?php
							$sqljumlahsubkat = "SELECT * FROM sub_kat WHERE id_main_kat = ?";
							$queryjumlahsubkat = $this->db->query($sqljumlahsubkat,$k['id_main_kat']);
							echo $queryjumlahsubkat->num_rows();
							?>
						</td>
						<td>
							<?php
							$sqljumlahkompetisi = "SELECT * FROM kompetisi WHERE id_main_kat = ?";
							$queryjumlahkompetisi = $this->db->query($sqljumlahkompetisi,$k['id_main_kat']);
							echo $queryjumlahkompetisi->num_rows();
							?>
						</td>
						<td>
							<a href="?act=tambahsub&id=<?php echo $k['id_main_kat']?>" class="btn btn-default btn-xs">Tambah Sub</a>
							<a href="?act=lihatsub&id=<?php echo $k['id_main_kat']?>" class="btn btn-default btn-xs">Lihat Sub</a>
							<a href="?act=edit&id=<?php echo $k['id_main_kat']?>" class="btn btn-xs btn-default" href="">Edit</a>
							<a href="?act=delete&id=<?php echo $k['id_main_kat']?>" onclick="return confirm('Anda Yakin!')" title="edit kategori" class="btn btn-xs btn-default" href="">Hapus</a>
						</td>										
					</tr>
					<?php  $n++; } ?>
				</tbody>
			</table>
		</div>
	</br>
	<div 
	<!--end of active-->
</div>
</div>
</div>
</div>



</div>