<script type="text/javascript">
	$(window).scroll(function() {    
		if($(window).scrollTop() > 55) {
			$("#afterscroll").show();
			$("#base-heading").hide();
		} else {
			$("#afterscroll").hide();
			$("#base-heading").show();
		}
	});

	function loading(){
		$("#loading").show();
	}
</script>

<?php if(isset($_GET['kat'])) { //jika set kategori ?>
<script type="text/javascript">
	$(function() {
		var kat = <?php echo $_GET['kat']?>;
		$('#kat1').val(kat);
		$('#kat2').val(kat);
		$(".page").hide();
	});
</script>
<?php } ?>

<?php if(isset($_GET['q'])) { //jika set pencarian ?>
<script type="text/javascript">
	$(function() {
		var q = <?php echo $_GET['q']?>;
		$('#q1').val(q);
		$('#q2').val(q);
		$(".page").hide();
	});
</script>
<?php } ?>

<section id="beforescroll" class="mini-header">
	<div class="container">
		<div class="row">
			<div class="md-col-12">
				<div class="row">
					<form action="<?php echo site_url('start/kompetisi/jelajah')?>" method="GET" id="sort-kompetisi" class="form-inline" role="form">
						<div class="col-lg-5">
							<div class="form-group">						
								<input id="q1" name="q" type="text" class="input-sm form-control" value="<?php if(isset($_GET['q'])) echo $_GET['q'];//jika set pencarian ?>"  placeholder="Cari Kompetisi">					
							</div>
							<div class="form-group">
								<select id="kat1" name="kat" class="input-sm form-control">
									<option value="0">Semua Kategori</option>
									<?php foreach ($kategori as $kat) { ?>
									<option value="<?php echo $kat['id_main_kat']?>"><?php echo $kat['main_kat']?></option>
									<?php } ?>
								</select>
							</div>			
							<div class="form-group">
								<button onclick="loading()" class="input-sm form-control btn btn-default" type="submit">Cari</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section id="afterscroll" class="mini-header" style="width:100%;position:fixed;top:0;z-index:100;display:none;margin-top:0px;">
		
		<div class="container">
			<a href="<?php echo site_url();?>"><img class="small-icon" style="float:left" alt="kompetisi indonesia small icon" src="<?php echo base_url('images/icon/ki-small-icon.png')?>"></a>
			<div class="row">
				<div class="md-col-12">
					<div class="row">
						<form action="<?php echo site_url('start/kompetisi/jelajah')?>" method="GET" id="sort-kompetisi" class="form-inline" role="form">
							<div class="col-lg-5">
								<div class="form-group">						
									<input id="q2" name="q" type="text" class="input-sm form-control" value="<?php if(isset($_GET['q'])) echo $_GET['q'];//jika set pencarian ?>"  placeholder="Cari Kompetisi">					
								</div>
								<div class="form-group">
									<select id="kat2" name="kat" class="input-sm form-control">
										<option value="0">Semua Kategori</option>
										<?php foreach ($kategori as $kat) { ?>
										<option value="<?php echo $kat['id_main_kat']?>"><?php echo $kat['main_kat']?></option>
										<?php } ?>
									</select>
								</div>			
								<div class="form-group">
									<button onclick="loading()" class="input-sm form-control btn btn-default" type="submit">Cari</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

		<div class="container">
			<div class="col-md-12">
				<br/>
				<!-- <div class="ki-breadcrumb">
					<ol>
						<li><a href="<?php echo site_url()?>">HOME</a></li>
						<li>></li>
						<li><a href="<?php echo site_url('start/kompetisi/jelajah')?>">JELAJAH</a></li>
					</ol>
				</div> -->
				<div class="ms-col-12">

					<?php 
					if(isset($list)){
						echo '<ul style="float:right" class="pagination">'.$page.'</ul>';
					}
					?>
					<table style="background-color:#fff" id="list" class="list-kompetisi table table-hover">
						<tr><td colspan="5" id="a-145-155"><center><a href="http://www.lazada.co.id/promo-iphone/#Q5760C423wj0u12" title="lazada.co.id"><img src="http://srv-live.lazada.co.id/cms/imageslap/mobile_tablets/IPHONE5SPROMO/468x60_24012014_IPHONE5S.jpg" height="60" width="468" border="0" alt="lazada" /></a></center></td></tr>
						<tr class="waiting" id="waiting" style="display:none;background-color: rgb(245, 245, 245);padding: 10px;">
							<td colspan="5">

								<center style="color: rgb(177, 170, 170);">
									<img src="<?php echo base_url('dist/ajax-loader.gif')?>"/> loading content
								</center>
							</td>			 		
						</tr>
						<!-- unbind when scroll to bottom -->
						<?php
					if(!$list) { //j]ika tidak ada kompetisi yang ditemukan
						echo '<center><h4>Kompetisi Tidak Ditemukan</h4></center>';
					} 
					if(isset($total) && $total > 0) { //jika ditemukan leboh dari 0 kompetisi
						echo '<center><h4> Ditemukan '.$total.' kompetisi</h4></center>';
					}					
					?>
					<?php foreach ($list as $li) {	
						?>
						<tr>

							<td>
								<?php 
								$sort = substr($li['sort'], 0,130);

								//encode id as url
								$enc = base64_encode(base64_encode($li['id_kompetisi']));
								$id = $id_kompetisi = str_replace('=', '', $enc);
								//judul post
								$judul = str_replace(' ', '-', $li['judul'])
								?>
								<p style="font-size:18px"><a class="title" data-toggle="tooltip" title="Kompetisi indonesia" href="<?php echo site_url('kompetisi/detail/'.$id.'/'.$judul) ?>"><?php echo $li['judul'] ?></a></p>
								<p><?php echo $sort?>...</p>
								<p class="jelajah-detail">Penyelenggara  <?php echo  $li['penyelenggara']?> / <?php echo $li['main_kat']?>  / oleh <a href="<?php echo site_url('publik/profile/'.$li['username'])?>"><?php echo $li['username']?></p>
							</td>
							<td style="width:90px">
								<center style="margin-top:20px">
									<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-calendar"></span></p>
									<p class="value_total jelajah-value">
										<?php if($li['deadline'] > 0) {
											echo $li['deadline'].' Hari lagi';
										} else {
											echo 'Kompetisi telah berakhir';
										} 
										?>
									</p>
								</center>
							</td>
							<td style="width:90px">
								<center style="margin-top:20px">
								<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-star"></span></p>
								<p class="jelajah-value">
									<?php
									//rating
									//cek rating kompetisi di database
									$query_rating = "SELECT SUM(rating) AS 'rating' FROM rating WHERE id_kompetisi = ?";
									$query_rating = $this->db->query($query_rating,$li['id_kompetisi']);
									$query_rating = $query_rating->row_array();
									$total_rate =  $query_rating['rating']; //mendapatkan total rate
									if(empty($total_rate)){
										$total_rate = 0;
									}
									//cek total row
									$query_row_rating = "SELECT * FROM rating WHERE id_kompetisi = ?";
									$total_row = $this->db->query($query_row_rating,$li['id_kompetisi']);
									$total_row = $total_row->num_rows();
									if($total_row==0){
										$total_row = 1;//because  0 division 0 = ~
									}
									//rating sekarang
									$recent_rate = $total_rate / $total_row;
									//konvert ke bilangan bulat
									echo round($recent_rate);
									//end of rating
									?>
								</p></center>
							</td>
							<td style="width:90px">
								<center style="margin-top:20px">
								<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal"><span class="glyphicon glyphicon-eye-open"></span></p>
								<p class="jelajah-value"><?php echo $li['views'];?></p></center>
							</td>
							<td style="width:90px">
								<center style="margin-top:20px">
								<p class="jelajah-detail jelajah-ikon" class="value_hadiahtotal">Rp</p>
									<p class="jelajah-value">
									<?php
									//conversi total hadiah
									if($li['total'] >= 1000000000) {
										$total = number_format($li['total'] / 1000000000,1);
										echo $total.' Milyar';
									}else if($li['total'] >= 1000000 && $li['total'] <=1000000000) {
										$total = number_format($li['total'] / 1000000,1 );
										echo $total.' Juta';
									} else if ($li['total'] >=1000 && $li['total'] <=1000000) {
										$total = number_format($li['total'] / 1000, 1);
										echo $total.' Ribu';
									} else {
										echo $li['total'];
									}

									?>
									</p>
								</center>
							</td>
							<td>
								<a href="<?php echo site_url('kompetisi/detail/'.$id.'/'.$judul) ?>" style="margin-top:30px" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>
							</td>
			 		<!-- <td><strong>Deadline : </strong> 12 Agustus 2014</td>
			 		<td><strong>Total Hadiah Senilai: </strong> Rp.56.000.000,-</td> -->
			 	</tr>

			 	<?php } ?>
			 	<tr><td colspan="5"id="145-14-8">
			 		<!--ADS-->	
			 		<center><a href="http://www.lazada.co.id/promo-iphone/#Q5760C423wj0u12" title="lazada.co.id"><img src="http://srv-live.lazada.co.id/cms/imageslap/mobile_tablets/IPHONE5SPROMO/468x60_24012014_IPHONE5S.jpg" height="60" width="468" border="0" alt="lazada" /></a></center>
			 	</td></tr>
			 	<tr class="loader" id="loading" style="display:none;background-color: rgb(245, 245, 245);padding: 10px;">
			 		<td colspan="5">
			 			<center style="color: rgb(177, 170, 170);">
			 				<img src="<?php echo base_url('dist/ajax-loader.gif')?>"/> loading older content
			 			</center>
			 		</td>			 		
			 	</tr>
			 	<tr style="display:none" class="loader" id="loadingnoresult" style="background-color: rgb(245, 245, 245);padding: 10px;">
			 		<td colspan="5">
			 			<center style="color: rgb(177, 170, 170);">
			 				kompetisi telah habis
			 			</center>
			 		</td>			 		
			 	</tr>
			 </table>
			 <?php 
			 if(isset($list)){
			 	echo '<ul style="float:right" class="pagination">'.$page.'</ul>';
			 }
			 ?>

			</div>

		</div> <!--end of coll md-->
	</div>