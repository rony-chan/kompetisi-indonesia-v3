<?php $rating = $view['rating'] ?>
<?php
//encode id as url
$enc = base64_encode(base64_encode($view['id_kompetisi']));
$id = $id_kompetisi = str_replace('=', '', $enc);
?>
<script type="text/javascript" src="<?php echo base_url('dist/jquery-raty/jquery.raty.js')?>"></script>
<script>
	$(document).ready(function(){
		var n = <?php echo $recent_rate?>;
		$('#star').raty({score: n});
		$('#starnologin').raty({readOnly:true, score: n});
	});	
//for rating
function giveRate(x){
	var score = x;
	var idkompetisi = '<?php echo $id;?>';
	var iduser = '<?php echo $this->session->userdata("id_user");?>';
	$('#star').click(function(){
		$.ajax({
			url:'<?php echo site_url("kompetisi/tambahrate")?>',
			data:{idkompetisi:idkompetisi,iduser:iduser,rate:score},
			success:function(){
				alert('Rating '+x+' sudah diberikan');
			},
			error:function(){
				alert('Rate Bermasalah, silahkan ulangi lagi');
			}
		});
	});
}
</script>
<div class="container">
	<div class="col-md-offset-1 col-md-10">
		<!--breadcrumb-->
		<br/>
		<div class="ki-breadcrumb container">
			<ol>
				<li><a href="<?php echo site_url()?>">HOME</a></li>
				<li>></li>
				<li><a href="<?php echo site_url('start/kompetisi/jelajah')?>">JELAJAH</a></li>
				<li>></li>
				<li><a href="<?php echo site_url('start/kompetisi/jelajah')?>"><?php echo strtoupper($view['kategori'])?></a></li>
				<li>></li>
				<li><strong><?php echo strtoupper($view['judul_kompetisi'])?> </strong></li>
			</ol>
		</div>
	</div>
	<div style="background-color: #FFF" class="col-md-offset-1 col-md-10">
		<div  class="row content-head" style="background-color:rgb(236, 236, 236);padding: 10px 0 10px 0;">
			<div class="col-md-4">
				<?php 
			if(empty($view['poster'])){ //jika tidak upload poster
				echo '<center style="padding:10px">POSTER TIDAK TERSEDIA</center>';
			} else { //jika ada poster maka tampil?> 
			<center style="background-color:#F5F5F5; padding:10px">
				<a title="klik untuk perbesar" data-toggle="modal" href="#fullposter"><img alt="<?php echo $view['judul_kompetisi']?>" class="poster" src="<?php echo base_url('images/poster/'.$view['poster'].'')?>"/></a>
				<!--poster modal-->
				<div class="modal fade" id="fullposter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<center>
						<div>
							<br/>
							<p style="color:#fff">Tekan ESC untuk menutup <button type="button" class="btn btn-xs btn-default" data-dismiss="modal" aria-hidden="true">&times;</button></p>
							<img alt="<?php echo $view['judul_kompetisi']?>" style="margin-bottom:30px" src="<?php echo base_url('images/poster/'.$view['poster'].'')?>"/>
						</div><!-- /.modal-dialog -->
					</center>
				</div><!-- /.modal -->
				<!--end of poster modal-->
				<h6 style="color:#B3B3B3">klik gambar untuk perbesar</h6>
			</center>
			<?php } ?>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-8">
			<div class="col-md-12">
				<h1 style="font-size: 25px;" class="title"><?php echo $view['judul_kompetisi']?></h1>
				<p class="about-post"><span class="glyphicon glyphicon-user"></span> <a style="color:#fff; text-decoration:none" title="Kompetisi Author" href="<?php echo site_url('publik/profile/'.$view['author']) ?>"><?php echo $view['author']?></a> | <span class="glyphicon glyphicon-calendar"></span> post:<?php echo date('d-m-Y', strtotime($view['tgl_buat']))?> | <span class="glyphicon glyphicon-calendar"></span> update:<?php echo date('d-m-Y', strtotime($view['tgl_edit']))?> | <span class="glyphicon glyphicon-eye-open"></span> <?php echo $view['views']?> </p>
			</div>
			<div class="col-md-6">
				<?php
					//jika user belum login maka tidak bisa memberikan rating
				if($this->session->userdata('username') != "") {
					?>
					<form id="rating"><div id="star"></div></form>
					<?php } else { ?>
					<div id="starnologin"></div>
					<?php } ?>
					<h2 style="font-size:13px"><?php echo $view['sort']?></h2>
					<hr/>
					<strong>Deadline :</strong> <?php echo date('d-m-Y', strtotime($view['deadline']))?><br/>
					<strong>Pengumuman :</strong> <?php echo date('d-m-Y', strtotime($view['pengumuman']))?><br/>
					<strong>Penyelenggara :</strong> <?php echo $view['penyelenggara']?><br/>
					<?php
					//conversi total hadiah
					if($view['total_hadiah'] >= 1000000000) {
						$total = number_format($view['total_hadiah'] / 1000000000,1);
						$total =  $total.' Milyar';
					}else if($view['total_hadiah'] >= 1000000 && $view['total_hadiah'] <=1000000000) {
						$total = number_format($view['total_hadiah'] / 1000000,1 );
						$total =  $total.' Juta';
					} else if ($view['total_hadiah'] >=1000 && $view['total_hadiah'] <=1000000) {
						$total = number_format($view['total_hadiah'] / 1000,1);
						$total =  $total.' Ribu';
					} else {
						$total =  $view['total_hadiah'];
					}
					?>
					<strong>Hadiah Senilai :</strong> <?php echo $total?><br/>
					<strong>Detail Hadiah :</strong> <?php echo $view['hadiah']?>
				</div>
				<?php if(!empty($this->session->userdata('username'))) { //jika sudah login?>
				<div class="col-md-6">
					<?php if($btn['tandai'] == 0 ) { //jika sudah tekan tombol diikuti?>
					<a title="Tandai Kompetisi" href="<?php echo site_url('process/proc_public/kompetisi_btn?act=tandai&kom=').$id?>" type="button" class="btn btn-default btn-xs">tandai</a><span class="label label-default"><?php echo $ditandai['total']?></span>
					<?php } else { ?>
					<a title="Batal Tandai Kompetisi" style="background-color:#cccccc" href="<?php echo site_url('process/proc_public/kompetisi_btn?act=untandai&kom=').$id?>" type="button" class="btn btn-default btn-xs">batal tandai </a><span class="label label-default"><?php echo $ditandai['total']?></span>
					<?php } ?>
					<?php if($btn['gabung'] == 0 ) { //jika sudah tekan tombol gabung?>
					<a title="Ikuti Kompetisi" href="<?php echo site_url('process/proc_public/kompetisi_btn?act=gabung&kom=').$id?>" type="button" class="btn btn-default btn-xs">ikuti</a><span class="label label-default"><?php echo $gabung['total']?></span>
					<?php } else { ?>
					<a title="Batal Ikuti Kompetisi" style="background-color:#cccccc" href="<?php echo site_url('process/proc_public/kompetisi_btn?act=ungabung&kom=').$id?>" type="button" class="btn btn-default btn-xs">batal ikuti </a><span class="label label-default"><?php echo $gabung['total']?></span>
					<?php } ?>
					<a href="<?php echo site_url('save?id='.$id)?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-floppy-disk"></span>save PDF</a>
				</div>
				<?php } else { //jika belum login?> 				
				<div class="col-md-6">
					<a title="Tandai Kompetisi" href="#login" data-toggle="modal" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-ok-sign"></span> tandai </a><span class="label label-default"><?php echo $ditandai['total']?></span>
					<a title="Ikuti Kompetisi" href="#login" data-toggle="modal" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-ok-sign"></span> gabung </a><span class="label label-default"><?php echo $gabung['total']?></span>						
					<a href="<?php echo site_url('save?id='.$id)?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-floppy-disk"></span>save PDF</a>
				</div>
				<?php } ?>
				<div style="margin-top:50px" class="row">
					<div class="col-md-6">
						<!--G+-->
						<!-- Place this tag where you want the +1 button to render. -->
						<div class="g-plusone" data-size="tall"></div>
						<!-- Place this tag after the last +1 button tag. -->
						<script type="text/javascript">
							(function() {
								var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								po.src = 'https://apis.google.com/js/platform.js';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							})();
						</script>
						<!--twitter-->
						<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-via="kompetisiindo" data-count="vertical">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						<!--tfacebook-->
						<div style="top:-5px" class="fb-like" data-href="<?php echo site_url(uri_string()) ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="row content-content">
			<div class="col-md-9">
				<?php 
				if(!empty($pemenang)){
					echo '<h3 class="kompetisi-detail">Pemenang</h3>';
					foreach($pemenang as $p):
						echo '<p><a href="'.site_url('publik/profile/'.$p['username']).'">'.$p['username'].'</a> | '.$p['detail'].' | Hadiah Senilai Rp'.number_format($p['hadiah']).',-</p>';
					endforeach;
				}
				?>
				<h3 class="kompetisi-detail">Syarat dan Ketentuan</h3>
				<br/>
				<?php echo $view['konten']?>
				<br/>
				<?php if(isset($view['sumber'])){?>
				<h3 class="kompetisi-detail">Link </h3>
				<p><a href="<?php echo $view['sumber'];?>" target="_blank" style="border-radius:0" class="accordion-toggle btn btn-danger">Info Selengkapnya</a></p>		
				<div id="showlink" class="collapse panel-collapse">
					<p id="linktext"><?php echo $view['sumber']?> <span><button style="display:none" onclick="copylink()" class="btn btn-default btn-xs">copy link</button></span> <span id="copied" style="display:none"><i>link copied</i></span></p>
				</div>
				<?php } ?>
				<!-- komentar -->
				<ul class="nav nav-tabs" id="komentarki">
					<li class="active"><a href="#komentarnya">Komentar</a></li>
					<li><a href="#facebook">Facebook</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="komentarnya">
						<h4>Total <?php echo $count_komentar;?> Komentar</h4>
						<?php foreach($komentar as $komen):?>
							<div class="komentar">
								<?php
									//manage username
								if($komen['username'] == $view['author']){
										$username = 'Penyelenggara :: '.$komen['username']; //jika yang komentar adalah penyelenggara kompetisi
									} else {
										$username = $komen['username']; //jika yang komen adalah peserta
									}
									//manage profil picture
									if(!empty($komen['provider'])){//login menggunakan provider
										//cek login dengan apa
										switch ($komen['provider']) {
											case 'facebook':
											$pp = 'https://graph.facebook.com/'.$komen['oauth_id'].'/picture?width=9999';
											break;
											case 'telkomid':
												# code...
											break;
											default:
												$pp = base_url('images/avatar3.png');//default profile picture
												break;
											}
										}else{
										$pp = base_url('images/avatar3.png');//default profile picture
									}
									?>
									<div class="row col-md-12">
										<div class="col-md-2">
											<img style="width:100%" src="<?php echo $pp;?>" style="width:100%" />
										</div>
										<div class="col-md-10">
											<!-- letak komentar -->									
											<p><strong><a href="<?php echo site_url('publik/profile/'.$komen['username']);?>"><?php echo $username;?></a></strong> <small><?php echo $komen['waktu'];?></small></p>
											<p><?php echo $komen['komentar']?></p>
										</div>
									</div>
								</div>
							<?php endforeach;?>
							<!-- balas komentar -->
							<?php if(!empty($this->session->userdata('id_user'))) { ?>
							<div id="komentar" class="komentar">
								<div class="row col-md-12">
									<div class="col-md-2">
										<?php
										//profile picture saya
										if(!empty($this->session->userdata('oauth_provider'))){//login menggunakan provider
										//cek login dengan apa
											switch ($this->session->userdata('oauth_provider')) {
												case 'facebook'://facebook
												$ppsaya = 'https://graph.facebook.com/'.$this->session->userdata('oauth_id').'/picture?width=9999';
												break;
												case 'telkomid'://telkom id
												# code...
												break;
												default:
												$ppsaya = base_url('images/avatar3.png');//default profile picture
												break;
											}
										}else{
										$ppsaya = base_url('images/avatar3.png');//default profile picture
									}
									?>
									<img style="width:100%" src="<?php echo $ppsaya;?>" style="width:100%" />
								</div>
								<div class="col-md-10">
									<!-- form balas komentar -->
									<form action="<?php echo site_url('kompetisi/add_komentar');?>" method="POST" class="form">
										<textarea name="input_komentar" style="width:100%" class="form-control" placeholder="ada pertanyaan masukan disini"></textarea>
										<input type="hidden" name="id_kompetisi" value="<?php echo $this->uri->segment(3);?>">
										<button style="margin-top:5px;float-right"  class="btn btn-default" type="submit" >Komentar</button>
									</form>
								</div>
							</div>
						</div>
						<?php } else { ?>
						<div id="komentar" class="komentar" style="color:gray">Silahkan <a href="#login" data-toggle="modal">login</a> untuk berkomentar</div>
						<?php } ?>
					</div>
					<div class="tab-pane" id="facebook">
						<!--FB Comment-->
						<div class="fb-comments" data-href="<?php echo site_url(uri_string())?>" data-numposts="10" data-colorscheme="light"></div>
					</div>
				</div>
				<!-- end of komentar -->
				<!--next/prev competition-->
				<ul class="pager">
					<li class="previous"><a href="#">&larr; Sebelumnya</a></li>
					<li style="font-size:13px" class="next"><a href="#">Berikutnya &rarr;</a></li>
				</ul>
			</div>
			<div id="sidebar">
				<?php $this->load->view('public/sidebar.php'); ?>	
			</div>
		</div>
	</div>
</div>
<br/>