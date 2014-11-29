
<body>
	
	<section class="welcome">
		<center>
			<div class="container">
				<div class="row" >
					<div class="col-md-12">					
						<h1>Kompetisi Dengan Cara Berbeda </h1>
						<br/>
						<h4>Kompetisi dari berbagai macam kategori untuk seluruh warga Indonesia</h4>					
					</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<a  href="<?php echo site_url('start/kompetisi/jelajah')?>"><div  class="btn-white col-md-offset-3 col-md-3"><p>jelajah kompetisi</p><span style="float:right" class="glyphicon glyphicon-search"></span></div></a>
					<div style="margin : 0 5px 0 5px"></div>
					<a href="<?php echo site_url('pasangkompetisi')?>"><div class="btn-white col-md-3"><p>pasang kompetisi</p><span style="float:right" class="glyphicon glyphicon-plus"></span></div></a>
				</div>
			</div>
		</center>
	</section>
	<section class="kategori">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-10">
					<ul class="menu home-kategori">
						<li style="border-left: 1px #167000 solid"><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat=1')?>">akademik</a></li>
						<li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat=3')?>">fotografi</a></li>
						<li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat=2')?>">desain</a></li>
						<li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat=4')?>">karyatulis</a></li>
						<li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat=5')?>">bakat</a></li>
						<li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat=10')?>">blog</a></li>
						<li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat=12')?>">olahraga</a></li>
						<li><a class="accordion-toggle" data-toggle="collapse" href="#semuakategori" ><strong>semua <span class="glyphicon glyphicon-chevron-down"></span></strong></a></li>
					</ul>

				</div>

			</div>
			<div class="row">
				<div class="col-md-offset-2 col-md-6">
					<div id="semuakategori" class="collapse panel-collapse">
						<div class="panel-body">
							<ul class="menu semua-kategori">
								<?php foreach ($main_kat as $mk) : ?>
									<li><a href="<?php echo site_url('start/kompetisi/jelajah?q=&kat='.$mk['id_main_kat'])?>"><?php echo $mk['main_kat']?></a></li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="thumbposter">
			<!-- <a id="next" style="right:10px;z-index:100;position:absolute" href="#">next</a>
			<a id="prev" style="left:10px;z-index:100;position:absolute" href="#">prev</a> -->
			<div id="thumb" style="padding:0;margin:0" class="row itemthumb">				
				<ul style="padding:0;margin:0" class="menu">
					<?php foreach($thumb as $th) {
					//encode id as url
						$enc = base64_encode(base64_encode($th['id_kompetisi']));
						$id = str_replace('=', '', $enc);
					//judul post
						$judul = str_replace(' ', '-', $th['judul']);
					//conversi total hadiah
						if($th['total'] >= 1000000000) {
							$totala = number_format($th['total'] / 1000000000,1);
							$hadiah =  'Rp'.$totala.' Milyar';
						}else if($th['total'] >= 1000000 && $th['total'] <=1000000000) {
							$totala = number_format($th['total'] / 1000000,1 );
							$hadiah = 'Rp'.$totala.' Juta';
						} else if ($th['total'] >=1000 && $th['total'] <=1000000) {
							$totala = number_format($th['total'] / 1000, 1);
							$hadiah = 'Rp'.$totala.' Ribu';
						} else {
							$hadiah = 'Rp'.$th['total'];
						}
						?>
						<li class="poster-tile"><a name="<?php echo $th['judul']?>" style="background-size:cover;background-image:url('<?php echo base_url('images/poster')?>/<?php echo $th['poster']?>')" href="<?php echo site_url('kompetisi/detail/'.$id.'/'.$judul) ?>"><center><span class="poster-title"><?php echo $th['judul']?><br/><strong><?php echo $hadiah?></strong></span></center></a></li>
						<?php } ?>
					</ul>
				</div>
			</section>
			<section class="carakerja">
				<center>
					<div class="container">
					<!-- start of kabar baru -->
						<div class="row">
							<div class="col-md-12">	
								<h1 class="title-on-section">Kabar Baru</h1>
								<hr style="border:1px solid #000" />

								<br/>
							</div>
						</div>

						<div class="row">
							<?php foreach($kabar as $k):
							$encode = base64_encode(base64_encode($k['id']));
							$id_kompetisi = str_replace('=', '', $encode);
							$judul = str_replace(' ', '-', $k['title']);
							$content = substr($k['content'],0,100);
							?>
							<div class="kabar-baru col-md-3">
								<div style="height:200px;padding:8px;background-color:#fff;">
									<a href="<?php echo site_url('publik/read/'.$id_kompetisi.'/'.$judul);?>"><h4><?php echo $k['title'];?></h4></a>
									<p><?php echo $content;?></p>
									<p style="color:gray"><small>posted : <?php echo $k['tgl_edit']?></small></p>
								</div>
							</div>
						<?php endforeach;?>
						<br/>
						<a style="float:right" href="<?php echo site_url('start/kompetisi/news')?>">Kabar Lainnya..</a>
					</div>
					<!-- end of kabar baru -->
					<br/><br/>
					<!-- start of cara kerja -->
					<!-- <div class="row">
						<div class="col-md-12">	
							<h1 class="title-on-section">Cara Kerja</h1>
							<hr style="border:1px solid #000" />							
							<br/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">	
							<h4 class="title-on-section">Sebagai Penyelenggara</h4>		
							<br/>
						</div>
						<div class="col-md-6">	
							<h4 class="title-on-section">Sebagai Peserta</h4>		
							<br/>
						</div>
					</div> -->
					<!-- end of cara kerja -->

				</div>
			</center>
		</section>
		<section class="statistik">
			<center>
				<div class="container">
					<div style="background-color:rgba(0, 0, 0, 0.08); padding:10px;" class="row">
						<div class="col-md-3">	
							<h2><?php echo $aktif['aktif']?></h2>
							<p>Kompetisi aktif</p>
						</div>
						<div class="col-md-3">
							<h2><?php echo $kompetisi['total']?></h2>	
							<p>Kompetisi bulan ini</p>
						</div>
						<div class="col-md-3">	
							<h2><?php echo $kat['total']?></h2>
							<p>Kategori</p>
						</div>
						<div class="col-md-3">	
							<h2>Rp <?php

								if($total['total'] >= 1000000000) {
									$total = number_format($total['total'] / 1000000000,2);
									echo $total.' Milyar';
								}else if($total['total'] >= 1000000 && $total['total'] <=1000000000) {
									$total = number_format($total['total'] / 1000000,2 );
									echo $total.' Juta';
								} else if ($total['total'] >=1000 && $total['total'] <=1000000) {
									$total = number_format($total['total'] / 1000);
									echo $total.' Ribu';
								} else {
									echo $total['total'];
								}
								?></h2>
								<p>Hadiah bulan ini</p>
							</div>
						</div>
					</div>
				</center>
			</section>
			<section class="pertanyaan">
				<center>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h2>Ada Pertanyaan ? Dapatkan Jawabannya</h2>
								<p>Melalui emal di cs@kompetisiindonesia.com atau melalui media social kami di Facebook, Twitter dan Google+</p>
							</div>
						</div>
					</div>
				</center>
			</section>

		</body>

