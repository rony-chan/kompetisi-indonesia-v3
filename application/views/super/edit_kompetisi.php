<script type="text/javascript">
	$(function() { //SET DEFAULT SUBKATEGORI
		var kat = <?php echo $view['id_main_kat']?>;
		var subkat = <?php echo $view['id_sub_kat']?>;
		$('#main').val(kat);
		$('#sub').val(subkat);
	});

	//call subkategori
	function loadsubkat(){
		$('#loading').show();
		var x = $('#main').val();//get main kategori value
		$.ajax({
			type: "GET",
			data: "id="+x,
			url : "<?php echo site_url('ajax/show_sub_kat_by_id_on_edit')?>",
			success: function(msg) {
                $('#load').html(msg); //get html code on controler
                $('#loading').hide();                    
            }  
        });
	}	
</script>

<br/>
<script type="text/javascript">
	//mengatur id subkat
	window.onload = function(){
		$('#subkat').val('<?php echo $view['id_sub_kat'] ?>');	
	};
</script>
<div class="container">
	<div class="col-md-2">
		<h3>Edit Kompetisi</h3>	
	</div>
	<div class="col-md-5">
		<form enctype="multipart/form-data" method="post" action="<?php echo site_url('super/super/edit_kompetisi')?>" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="judulkompetisi" class="col-lg-2 control-label">*Judul Kompetis</label>
				<div class="col-lg-10">
					<h6>pastikan ejaan yang anda tulis sudah benar</h6> 
					<input name="judul" type="text" class="form-control" id="judulkompetisi" value="<?php echo $view['judul_kompetisi']?>" required>
				</div>
			</div>
			<div class="form-group">
				<label for="deskripsisingkat" class="col-lg-2 control-label">*Deskripsi Singkat</label>
				<div class="col-lg-10">
					<h6>maks 500 karakter</h6>
					<input name="sort" type="text" class="form-control" id="deskripsisingkat" value="<?php echo $view['sort']?>" required>
				</div>
			</div>

			<!--auto load when user select main kategori-->
			<div class="form-group">
				<label for="mainkategori" class="col-lg-2 control-label">*Main Kategori</label>
				<div class="col-lg-10">
					<select onchange="loadsubkat()" id="main" name="mainkategori" class="form-control" required>
						<?php foreach ($main_kat as $mk) { ?>
						<option  value="<?php echo $mk['id_main_kat']?>" ><?php echo $mk['main_kat']?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div style="display:none" id="loading">
				<center style="color: rgb(177, 170, 170);">
					<img src="<?php echo base_url('dist/ajax-loader.gif')?>"/> loading subkategori
				</center>
			</div>
			<div id="load">
				<div class="form-group">
					<label for="subkategori" class="col-lg-2 control-label">*Sub Kategori</label>
					<div class="col-lg-10">
						<select name="subkategori" class="form-control" id="sub" required>
							<?php foreach ($sub_kat as $sk) { ?>
							<option value="<?php echo $sk['id_sub_kat']?>" ><?php echo $sk['sub_kat']?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>


			<div class="form-group">
				<label for="deadline" class="col-lg-2 control-label">*Deadline</label>
				<div class="col-lg-10">
					<input id="deadline" name="deadline" type="date" class="form-control" id="deadline" value="<?php echo $view['deadline']?>" required>
				</div>
			</div>
			<div class="form-group">
				<label for="pengumuman" class="col-lg-2 control-label">*Pengumuman</label>
				<div class="col-lg-10">
					<input id="pengumuman" name="pengumuman" type="date" class="form-control" id="pengumuman" value="<?php echo $view['pengumuman']?>" required>
				</div>
			</div>
			<div class="form-group">
				<label for="penyelenggara" class="col-lg-2 control-label">*Penyelenggara</label>
				<div class="col-lg-10">
					<input name="penyelenggara" type="text" class="form-control" id="penyelenggara" value="<?php echo $view['penyelenggara']?>" required>
				</div>
			</div>
			<div class="form-group">
				<label for="total" class="col-lg-2 control-label">*Nilai Total Hadiah</label>
				<div class="col-lg-10">
					<h6>Penulisan tanpa tanda (.) titik atau (,) koma</h6>
					<h6>Contoh : 5000000</h6>
					<div class="input-group">
						<span class="input-group-addon">Rp.</span>
						<input name="total" type="number" class="form-control" id="total" value="<?php echo $view['total_hadiah']?>" required>
						<span class="input-group-addon">.00</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="hadiah" class="col-lg-2 control-label">*Detail Hadiah:</label>
				<div class="col-lg-10">
					<h6>Contoh : juara 1 : iPad 32GB | juara 2 : iPhone 5 32GB | Juara 3 : iPhone 5 8GB </h6>
					<h6>atau hadiah akan diberikan kepada 5 juara favorit</h6>
					<textarea name="hadiah" class="form-control" id="hadiah" maxlength="500" required><?php echo $view['hadiah']?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="deskripsilengkap" class="col-lg-2 control-label">* Deskripsi Lengkap</label>
				<div class="col-lg-10">
					<h6>deskripsi meliputi syarat dan ketentuan kompetisi</h6>
					<h6>dan atau contact person / informasi lebih lanjut</h6>
					<?php
						$breaks = array("<br>","</br>","<br/>","<br />");//breaks html
						$content = str_ireplace($breaks, "\r\n", $view['konten']);
					?>
					<textarea name="deskripsi" style="height:200px" class="form-control" id="deskripsilengkap"  required><?php echo $content?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="pengumuman" class="col-lg-2 control-label">Link</label>
				<div class="col-lg-10">
					<input name="link" type="url" class="form-control" id="pengumuman" value="<?php echo $view['sumber']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="poster" class="col-lg-2 control-label">Poster</label>
				<div class="col-lg-10">
					<img width="200px" src="<?php echo base_url('images/poster/'.$view['poster'])?>">
					<h6>file support : png, jpg, jpeg</h6>
					<h6>maks : 1MB</h6>
					<input name="poster" type="file" class="form-control" id="poster">
				</div>
			</div>
			<input type="hidden" name="username" value="$this->session->userdata('username')">
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button name="btn_post" type="submit" class="btn btn-default">Posted</button>
					<button name="btn_draft" type="submit" class="btn btn-default">Draft</button>
				</div>
			</div>
			<input type="hidden" name="poster_lama" value="<?php echo $view['poster']?>">
			<input type="hidden" name="id_kompetisi" value="<?php echo $view['id_kompetisi']?>">
		</form>
	</div>
</div>