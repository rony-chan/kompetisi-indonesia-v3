<section
<?php if(!isset($detuser['cover'])) {
	echo 'style="background-image:url(http://kompetisiindonesia.com/images/home/panjat_pinang_head.png)"';
} else {
	echo 'style="background-image:url(kompetisiindonesia.com/images/cover/'.$detuser['cover'].')"';
} ?>
class="profile">
<div class="container">
	<div class="col-md-4">
		<h2><?php echo $detuser['fullname']?></h2>
		<p>"<?php echo $detuser['moto']?>"</p>
	</div>
	<div class="col-md-2">
		<center>
			<h3><?php echo $ikut?></h3>	
			<p>Diikuti</p>
		</center>
	</div>
	<div class="col-md-2">
		<center>
			<h3><?php echo $pasang?></h3>	
			<p>Dipasang</p>
		</center>
	</div>
	<div class="col-md-2">
		<center>
			<h3><?php echo $menang?></h3>	
			<p>Menang</p>
		</center>
	</div>
	<div class="col-md-2">
		<center>
			<h3><?php echo number_format($hadiah['hadiah'])?></h3>	
			<p>Rp</p>
		</center>
	</div>
</div>
</section>
<section class="kategori">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul style="margin:0" class="menu home-kategori">
					<li style="padding:10px;border-left:1px #167000 solid;width:auto"><a href="<?php echo site_url('publik/profile/'.$username) ?>">Profile</a></li>
					<li style="padding:10px;width:auto"><a href="?act=ikut">Kompetisi Diikuti</a></li>
					<li style="padding:10px;width:auto"><a href="?act=pasang">Kompetisi Dipasang</a></li>
					<li style="padding:10px;width:auto"><a href="?act=menang">Kompetisi Menang</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div class="col-md-12">
		<?php if(empty($view)) {
			echo '<center style="padding:20px"><h2>Kompetisi Kosong</h2></center>';
		}?>
		<?php if(isset($_GET['act']) && isset($view)) { //JIKA BUKA HALAMAN KOMPETISI ?>
		<br/>
		<table style="background-color:#fff" id="list" class="list-kompetisi table table-hover">
			<?php foreach($view as $v) { ?>
			<tr>
				<td>
					<?php
					$sort = substr($v['sort'], 0,130);
					//encode id as url
					$enc = base64_encode(base64_encode($v['id']));
					$id = str_replace('=', '', $enc);
					//judul post
					$judul = str_replace(' ', '-', $v['judul']);
					?>
					<p style="font-size:18px"><a class="title" data-toggle="tooltip" title="Kompetisi indonesia" href="<?php echo site_url('kompetisi/detail/'.$id.'/'.$judul) ?>"><?php echo $v['judul'] ?></a></p>
					<p><?php echo $sort?>...</p>
					<p style="color:gray">Penyelenggara  <?php echo  $v['penyelenggara']?> / <?php echo $v['main_kat']?> / oleh <a href="<?php echo site_url('publik/profile/'.$v['authusername'])?>"><?php echo $v['authusername']?></a></p>
				</td>
				<td>
					<center style="margin-top:20px">
						<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-calendar"></span></p>
						<p class="value_total jelajah-value">							
							<?php if($v['deadline'] > 0) {
								echo $v['deadline'].' Hari lagi';
							} else {
								echo 'Kompetisi telah berakhir';
							} 
							?>
						</p>
					</center>
				</td>
				<td style="width:100px">
					<center style="margin-top:20px">
					<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-eye-open"></span></p>
					<p class="jelajah-value"><?php echo $v['views'];?></p></center>
				</td>
				<td>
					<center style="margin-top:20px">
						<center style="margin-top:20px">
							<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal">Rp</p>
							<p class="jelajah-value">
								<?php
					//conversi total hadiah
								if($v['total'] >= 1000000000) {
									$total = number_format($v['total'] / 1000000000,1);
									echo $total.' Milyar';
								}else if($v['total'] >= 1000000 && $v['total'] <=1000000000) {
									$total = number_format($v['total'] / 1000000,1 );
									echo $total.' Juta';
								} else if ($v['total'] >=1000 && $v['total'] <=1000000) {
									$total = number_format($v['total'] / 1000, 1);
									echo $total.' Ribu';
								} else {
									echo $v['total'];
								}

								?>
							</p>
						</center>
					</td>
					<td>
						<a target="_blank" href="<?php echo site_url('kompetisi/detail/'.$id.'/'.$judul) ?>" style="margin-top:30px" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>
					</td>
				</tr>
				<?php } ?>
			</table>
			<?php } else { //JIKA HANYA BUKA HALAMAN INFO ?>
			<div class="row detuser">
				<div class="col-md-1">
					<img src="<?php echo 'https://graph.facebook.com/'.$detuser['oauth_id'].'/picture?return_ssl_resources=true'?>" alt="Kompetisi Indonesia User" />
				</div>
				<div class="col-md-10">
					<p><strong>Nama :</strong><br/>
						<?php echo $detuser['fullname']?>
					</p>
					<p><strong>Username :</strong><br/>
						<?php echo $detuser['username']?>
					</p>
					<p><strong>Bergabung sejak :</strong><br/>
						<?php echo $detuser['tgl_gabung']?>
					</p>
					<p><strong>Login Terakhir :</strong><br/>
						<?php echo $detuser['last_login']?>
					</p>
					<p><strong>Gender :</strong><br/>
						<?php echo $detuser['gender']?>
					</p>
					<p><strong>Status :</strong><br/>
						<?php echo $detuser['status']?>
					</p>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
