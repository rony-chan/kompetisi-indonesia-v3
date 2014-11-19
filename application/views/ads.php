<br/>
<div class="container">
<div style="padding:5px;background-color:#fff" class="col-md-10 col-md-offset-1">
	<div class="col-md-12">
		<center>
			<div class="page-header">
			  <h1>KompetisiIndonesia<sup style="font-size:20px">TM</sup> <small>Ads</small></h1>
			</div>
		</center>
		<p>Ingin kompetisimu dilihat setiap hari, KompetisiIndonesia<sup>TM</sup> menyediakan penawaran menarik berupa pemasanagn ads yang tersedia dalam berbagai macam paket, sesuai dengan penempatan, dan harga.</p>
		<br/>
		<h4>FAQ</h4>
		<ol>
		<li><p><strong>Apa untungnya buat kompetisi saya : </strong> kompetisi yang anda pasang akan sering dilihat visitor karena ads akan selalu ditampilkan pada halaman-halaman tertentu. Disamping itu, anda juga bisa memonitor aktifitas dari ads yang telah anda pasang, berupa statistik pembaca ads anda.</p></li>
		<li><p><strong>Paket apa saja yang disediakan : </strong>ada 3 paket yang kami sediakan, masing-masing mempunyai perbedaan yang sangat, yaitu : Jelajah View, Bottom Fixed View, Detail View. Untuk detail silahkan lihat dihalaman <a href="http://ads.kompetisiindonesia.com">http://ads.kompetisiindonesia.com</a></p></li>
		<li><p><strong>Bagaimana menggunakannya : </strong>fitur ini hanya berlaku untuk member KompetisiIndonesia<sup>TM</sup> pastikan anda sudah terdaftar. Baca keterangan di <a href="http://ads.kompetisiindonesia.com">http://ads.kompetisiindonesia.com</a>, cari paket yang sesuai dan input datanya di <a href="http://ads.kompetisiindonesia.com/manage">http://ads.kompetisiindonesia.com/manage</a></p></li>
		</ol>
		<hr/>
	</div>
	<div class="ads-item-group col-md-12">
		<div class="row col-md-12"><center><h4><strong>Ads Type :</strong></h4><br/></center>
		<?php foreach($type as $t): ?>
		<div style="padding:10px" class="col-md-4">
			<div class="ads-item ">
			<h4><span class="glyphicon glyphicon-bookmark"> </span> <?php echo $t['name'];?></h4>
			<hr/>
			<?php echo $t['description'];?>
			<br/>
			<strong><h4>Rp<?php echo $this->cart->format_number($t['rp_per_day']); ?>,-/hari</h4></strong>
			</div>
		</div>
		<?php endforeach;?>
		</div>
		<div class="row col-md-12">
		<br/>
		<center>
		<?php if(!empty($this->session->userdata('id_user'))){?>
		<a href="<?php echo site_url('dashboard/ads')?>" class="btn btn-default btn-lg">Pasang Ads</a>
		<?php } else {?>
		<a class="btn btn-default btn-lg" href="#login" data-toggle="modal">Login</a>
		<?php } ?>
		</center>
		</div>
	</div>
</div>
</div>
<br/>