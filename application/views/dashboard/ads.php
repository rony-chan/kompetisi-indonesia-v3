<script type="text/javascript">
	//cek ketersediaan
	function cekKetersediaan(){
		$('#loader').show();
		tanggalmulai = $('#inputTanggal').val();
		tipe = $('#inputTipe').val();
		//to string
		String(tanggalmulai);
		String(tipe);
		$.ajax({
			url:'<?php echo site_url("dashboard/cek_ketersediaan")?>',
			data:{tipe:tipe,tgl:tanggalmulai},
			success:function(data){
				$('#alert').html(data);
				$('#btn_mode').html('<button type="submit" class="btn btn-default">Proses</button>');
				$('#loader').hide();
			},
			error:function(data){
				$('#alert').html(data);
				$('#loader').hide();
			}
		});
	}

	function btnMode(){
		$('#loader').show();
		$('#btn_mode').html('<button onclick="cekKetersediaan()" type="button" class="btn btn-default">Cek Ketersediaan</button>');
		$('#alert').html('');
		$('#loader').hide();
	}
</script>
<br/>
<div class="container">
	<div style="padding:5px;background-color:#fff" class="col-md-offset-1 col-md-10">
		<div class="col-md-12">
			<center>
				<div class="page-header">
					<h1>KompetisiIndonesia<sup style="font-size:20px">TM</sup> <small>Ads Management</small></h1>
				</div>
				<p>Halaman ini digunakan untuk membuat ads, monitor dan management ads ada di KompetisiIndonesia<sup>TM</sup>.</p>
			</center>
		</div>
		<div class="ads-item-group col-md-12">
			<a title="Easy manage your ads using this tool" class="btn btn-default" href="#"><span class="glyphicon glyphicon-cog"></span> Manage</a>
			<a title="LUnasi pembayaran untuk mulai mengaktifkan ads" class="btn btn-default" href="#">Pembayaran</a>
		</div>
		<div class="ads-item-group col-md-6">
			<br/>
			<h4>Buat Ads Baru</h4>
			<p>Silahkan memilih paket yang sesuai dengan ketersediaan dan kebutuhan anda</p>
			<br/>
			<form action="<?php echo site_url('dashboard/proc_ads')?>" method="POST" class="form-horizontal" role="form" enctype="multipart/formdata">
				<div class="form-group">
					<label for="inputJudul" class="col-lg-3 control-label">Judul</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" id="inputJudul" name="inputJudul" placeholder="Judul Ads" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPesan" class="col-lg-3 control-label">Pesan Singkat</label>
					<div class="col-lg-9">
						<small>maks 200 karakter</small>
						<input max="200" type="text" class="form-control" id="inputPesan" name="inputPesan" placeholder="Pesan yang ada di Ads" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputTipe" class="col-lg-3 control-label">Tipe Ads</label>
					<div class="col-lg-9">
						<small>silahkan baca <a href="http://ads.kompetisiindonesia.com">ads.kompetisiindonesia.com</a></small>
						<select onchange="btnMode()" name="inputTipe" id="inputTipe" class="form-control" required>
							<?php foreach($type as $t):?>
								<option value="<?php echo $t['id_ads_type']?>"><?php echo $t['name'];?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputTanggal" class="col-lg-3 control-label">Tanggal Mulai</label>
					<div class="col-lg-9">
						<small>Tanggal Mulai Menampilkan Ads</small>
						<input type="date" class="form-control" id="inputTanggal" name="inputTanggal" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDurasi" class="col-lg-3 control-label">Durasi</label>
					<div class="col-lg-9">
						<small>Dalam satuan hari, hari pertama dihitung pada tanggal mulai</small>
						<input type="number" class="form-control" id="inputDurasi" name="inputDurasi" placeholder="masukan angka" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputBanner" class="col-lg-3 control-label">Banner</label>
					<div class="col-lg-9">
						<small>Jika banner yang dikirim tidak sesuai dengan ketentuan tipe yang dipilih, maka permintaan ads akan di banned<br/>
							Support : jpg, jpeg, png</small>
							<input type="file" class="form-control" id="inputBanner" name="inputBanner" placeholder="masukan angka" required>
						</div>
					</div>
					<div class="form-group">
					<label for="inputBank" class="col-lg-3 control-label">Pilihan Bank</label>
					<div class="col-lg-9">
						<select name="inputBank" id="inputBipe" class="form-control" required>
							<?php foreach($bank as $b):?>
								<option value="<?php echo $b['id_rek_bank']?>"><?php echo $b['rek_bank'];?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
					<div class="form-group">
						<div class="col-lg-offset-3 col-lg-9">
						<span id="alert"></span>
						<div id="btn_mode"><button onclick="cekKetersediaan()" type="button" class="btn btn-default">Cek Ketersediaan</button> <span id="loader" style="display:none"> <img alt="loader" src="<?php echo base_url('dist/ajax-loader.gif')?>"/></span></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<br/>