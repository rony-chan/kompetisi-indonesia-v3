<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type='text/javascript'>
	// $(document).ready(function(){
	// 	document.getElementById('kompetisi').className = 'list-group-item active';
	// 	document.getElementById('request').className = 'list-group-item';
	// 	document.getElementById('user').className = 'list-group-item';
	// 	document.getElementById('post').className = 'list-group-item';
	// })

	function loadsubkat(){
		$('#loading').show();
		var x = $('#mainkategori').val();//get main kategori value
		$.ajax({
			type: "GET",
			data: "id="+x,
			url : "<?php echo site_url('ajax/show_sub_kat_by_id')?>",
			success: function(msg) {
                $('#load').html(msg); //get html code on controler
                $('#loading').hide();                    
            }  
        });
        $('#show').show();
	}

	
</script>

<?php 
if(isset($script2) && isset($script)) {
 echo $script2; //script untuk atur class active
 echo $script; //script untuk atur class active
}
?>
<br/>
<div class="container-fluid">
	<?php $this->load->view('super/menu/sidebar') //load the sidebar ?>
	<div class="col-md-10">

		<div class="panel panel-default">
			<div class="panel-heading">Kompetisi</div>
			<div class="panel-body">
				<a href="#baru" class="btn btn-default" data-toggle="modal">+ Kompetisi Baru</a>
				<br/><br/>

				<div class="tabbable" > <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs" id="myTab">
						<li id="posted" class="" ><a href="<?php echo site_url('super/super/dashboard?act=posted') ?>" >Posted</a></li>
						<li id="draft" class=""><a href="<?php echo site_url('super/super/dashboard?act=draft') ?>">Draft</a></li>
					</ul>
					<br/>
					<div class="tab-content">

						<!--posted-->
						<div class="tab-pane active" id="posted">
							<h3>Total Posted Kompetisi : 
								<?php if(isset($tot_aktif)){
									echo $tot_aktif;
								} else if(isset($tot_draft)){
									echo $tot_draft;
								}?></h3>
								<table class="table table-hover">
									<thead>
										<tr>
											<td><strong>No</strong></td>
											<td><strong>Judul Kompetisi</strong></td>
											<td><strong>Author</strong></td>
											<td><strong>MK</strong></td>
											<td><strong>SK</strong></td>
											<td><strong>Ditandai</strong></td>
											<td><strong>Bergabung</strong></td>											
											<td><strong>Views</strong></td>
											<td><strong>Status</strong></td>
											<td style="width:100px"></td>
										</tr>
									</thead>
									<tbody>
										<?php $n = 1 ?>
										<?php foreach ($view as $v) {
											$enc = base64_encode(base64_encode($v['id_kompetisi']));
											$id = $id_kompetisi = str_replace('=', '', $enc);
											$judul = str_replace(' ', '-', $v['judul_kompetisi']);
											$nama = explode(' ', $v['nama']);
											$nama = $nama[0];
											?>
											<tr> 
												<td><?php echo $n;?></td>
												<td><?php echo $v['judul_kompetisi'];?></td>
												<td><?php echo $nama;?></td>
												<td><?php echo $v['id_main_kat'];?></td>
												<td><?php echo $v['id_sub_kat'];?></td>
												<td>2300</td>
												<td>1234</td>
												<td><?php echo $v['views']?></td>
												<td><?php echo $v['status']?></td>
												<td>
													<div class="btn-group">
														<a href="<?php echo site_url().'super/super/edit'.'/?id='.$id; ?>" class="btn-xs btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
														<a href="<?php echo site_url().'kompetisi/detail/'.$id.'/'.$judul; ?>" class="btn-xs btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>
														<a onclick="return confirm('Anda Yakin!')" href="<?php echo site_url('super/super/delete_kompetisi?id='.$v['id_kompetisi'])?>" class="btn-xs btn btn-default"><span class="glyphicon glyphicon-trash"></span></a>
													</div>
												</td>
											</tr>
											<?php $n++;
										} ?>
									</tbody>
								</table>
							</br>
							<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
						</br>
					</div>
					<!--end of posted-->

					<!--draft-->
					<div class="tab-pane" id="draft">
						<h3>Total Draft Kompetisi : <?php echo $tot_draft ?></h3>
						<table class="table table-hover">
							<thead>
								<tr>
									<td><strong>No</strong></td>
									<td><strong>Judul Kompetisi</strong></td>
									<td><strong>SubKategori</strong></td>
									<td><strong>Ditandai</strong></td>
									<td><strong>Bergabung</strong></td>
									<td><strong>Dikunjungi</strong></td>
									<td><strong>Status</strong></td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $n = 1 ?>
								<?php foreach ($draft as $d) {
									$enc = base64_encode(base64_encode($d['id_kompetisi']));
									$id = $id_kompetisi = str_replace('=', '', $enc);
									$judul = str_replace(' ', '_', $d['judul_kompetisi']);
									?>
									<tr> 
										<td><?php echo $n;?></td>
										<td><?php echo $d['judul_kompetisi'];?></td>
										<td><?php echo $d['id_sub_kat'];?></td>
										<td>2300</td>
										<td>1234</td>
										<td>24000</td>
										<td><?php echo $d['status']?></td>
										<td><a href="<?php echo site_url().'/super/super/edit'.'/?id='.$id; ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
											<a href="<?php echo site_url().'/kompetisi/detail/'.$id.'/'.$judul; ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
										</tr>
										<?php $n++;
									} ?>
								</tbody>
							</table>
						</br>
						<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
					</br>
				</div>
				<!--end of draft-->
			</div>
		</div>
	</div>
</div>

<!--modal-->
<!-- Modal -->
<div class="modal fade" id="baru" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Kompetisi</h4>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="post" action="<?php echo site_url('super/super/add_kompetisi')?>" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="judulkompetisi" class="col-lg-2 control-label">*Judul Kompetis</label>
						<div class="col-lg-10">
							<h6>pastikan ejaan yang anda tulis sudah benar</h6>
							<input name="judul" type="text" class="form-control" id="judulkompetisi" required>
						</div>
					</div>
					<div class="form-group">
						<label for="deskripsisingkat" class="col-lg-2 control-label">*Deskripsi Singkat</label>
						<div class="col-lg-10">
							<h6>maks 500 karakter</h6>
							<input name="sort" type="text" class="form-control" id="deskripsisingkat" required>
						</div>
					</div>


					<div class="form-group">
						<label for="subkategori" class="col-lg-2 control-label">*Kategori</label>
						<div class="col-lg-10">
							<select name="mainkategori" class="form-control" id="mainkategori" onchange="loadsubkat()" required>
								<?php foreach ($main_kat as $sk) { ?>
								<option value="<?php echo $sk['id_main_kat']?>" ><?php echo $sk['main_kat']?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<!--auto load when user select main kategori-->

					<div style="display:none" id="loading">
						<center style="color: rgb(177, 170, 170);">
							<img src="<?php echo base_url('dist/ajax-loader.gif')?>"/> loading subkategori
						</center>
					</div>

					<div id="load">
					</div>

					<div style="display:none" id="show">					

						<div class="form-group">
							<label for="deadline" class="col-lg-2 control-label">*Deadline</label>
							<div class="col-lg-10">
								<input name="deadline" type="date" class="form-control" id="deadline" required>
							</div>
						</div>
						<div class="form-group">
							<label for="pengumuman" class="col-lg-2 control-label">*Pengumuman</label>
							<div class="col-lg-10">
								<input name="pengumuman" type="date" class="form-control" id="pengumuman" required>
							</div>
						</div>
						<div class="form-group">
							<label for="penyelenggara" class="col-lg-2 control-label">*Penyelenggara</label>
							<div class="col-lg-10">
								<input name="penyelenggara" type="text" class="form-control" id="penyelenggara" required>
							</div>
						</div>
						<div class="form-group">
							<label for="total" class="col-lg-2 control-label">*Nilai Total Hadiah</label>
							<div class="col-lg-10">
								<h6>Penulisan tanpa tanda (.) titik atau (,) koma</h6>
								<h6>Contoh : 5000000</h6>
								<div class="input-group">
									<span class="input-group-addon">Rp.</span>
									<input name="total" type="number" class="form-control" id="total" required>
									<span class="input-group-addon">.00</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="hadiah" class="col-lg-2 control-label">*Detail Hadiah:</label>
							<div class="col-lg-10">
								<h6>Contoh : juara 1 : iPad 32GB | juara 2 : iPhone 5 32GB | Juara 3 : iPhone 5 8GB </h6>
								<h6>atau hadiah akan diberikan kepada 5 juara favorit</h6>
								<textarea name="hadiah" class="form-control" id="hadiah" maxlength="500" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="deskripsilengkap" class="col-lg-2 control-label">* Deskripsi Lengkap</label>
							<div class="col-lg-10">
								<h6>deskripsi meliputi syarat dan ketentuan kompetisi</h6>
								<h6>dan atau contact person / informasi lebih lanjut</h6>
								<textarea name="deskripsi" style="height:200px" class="form-control deskripsilengkap" id="deskripsilengkap" ></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="pengumuman" class="col-lg-2 control-label">Link</label>
							<div class="col-lg-10">
								<input name="link" type="url" class="form-control" id="pengumuman">
							</div>
						</div>
						<div class="form-group">
							<label for="poster" class="col-lg-2 control-label">Poster</label>
							<div class="col-lg-10">
								<h6>file support : png, jpg, jpeg</h6>
								<h6>maks : 1MB</h6>
								<input name="poster" type="file" class="form-control" id="poster">
							</div>
						</div>
						<input type="hidden" name="username" value="$this->session->userdata('username')">
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="btn_pasang" type="submit" class="btn btn-default">+ Pasang</button>
							</div>
						</div>
						</form>	
					</div>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->		

</div>