<script type="text/javascript">
	$(function() { //SET DEFAULT SUBKATEGORI
		var kat = <?php echo $view['id_sub_kat']?>;
    	$('#sub').val(kat);
	});

	//SET DEFAULT POSTER FILE

	
</script>


<br/>
</h3>
<div class="container">
	<div class="row">
		<center><h3 style="text-transform:uppercase" class="kompetisi-detail"><?php echo $this->session->userdata('username')?> dasbor</h3></center>
		<div class="col-md-2">
			<a style="margin-bottom:5px;width:100%" href="<?php echo site_url('dashboard/pasang?by=').$this->session->userdata('username')?>" class="btn btn-default">+ Pasang Kompetisi</span></a>
			<ul class="list-group">			  
			  <li class="list-group-item ">
			    <a href="<?php echo site_url('dashboard')?>">
			      <span class="badge pull-right">345</span>
			      Kompetisi diikuti
			    </a>
			  </li>
			  <li class="list-group-item">
			    <a href="<?php echo site_url('dashboard/ditandai')?>">
			      <span class="badge pull-right">2678</span>
			      Kompetisi ditandai
			    </a>
			  </li>
			  <li class="list-group-item">
			    <a href="<?php echo site_url('dashboard/saya')?>">
			      <span class="badge pull-right">6</span>
			      Kompetisi saya
			    </a>
			  </li>
			</ul>
		</div>

		<div class="col-md-7">
			<h3>Pasang Kompetisi</h3>
			<p>tanda *, adalah form yang wajib diisi</p>
			<form enctype="multipart/form-data" method="post" action="<?php echo site_url('process/proc_public/edit')?>" class="form-horizontal" role="form">
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
					<label for="subkategori" class="col-lg-2 control-label">*Sub Kategori</label>
					<div class="col-lg-10">
						<select name="subkategori" class="form-control" id="sub" required>
							<?php foreach ($sub_kat as $sk) { ?>
								<option value="<?php echo $sk['id_sub_kat']?>" ><?php echo $sk['sub_kat']?></option>
							<?php } ?>
						</select>
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
						<textarea name="deskripsi" style="height:200px" class="form-control" id="deskripsilengkap" maxlength="500" required><?php echo $view['konten']?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="pengumuman" class="col-lg-2 control-label">Link</label>
					<div class="col-lg-10">
						<input name="link" type="text" class="form-control" id="pengumuman" value="<?php echo $view['sumber']?>" required>
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
						<button name="btn_edit" type="submit" class="btn btn-default">Update</button>
						<button name="btn_draft" type="submit" class="btn btn-default">Draft</button>
					</div>
				</div>
				<input type="hidden" name="poster_lama" value="<?php echo $view['poster']?>">
				<input type="hidden" name="id_kompetisi" value="<?php echo $view['id_kompetisi']?>">
			</form>
		</div>

		<div class="col-md-3">
			<p></p>
			<p><strong>Contoh Pasang Kompetisi yang benar</strong></p>

		</div>
	</div>
</div>
<br/>