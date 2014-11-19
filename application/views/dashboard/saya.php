<script type="javascript">
	$(function() {
		var kat = <?php echo $_GET['bln']?>;
    	$('#bln1').val(kat);
    	$('#bln2').val(kat);
	});
</script>

<br/>
</h3>
<div class="container">
	<div class="row">
		<center><h3 style="text-transform:uppercase" class="kompetisi-detail"><?php echo $this->session->userdata('username')?> dasbor</h3></center>
		<div class="col-md-2">
			<a style="margin-bottom:5px;width:100%" href="<?php echo site_url('dashboard/pasang?by=').$this->session->userdata('username')?>" class="btn btn-default">+ Pasang Kompetisi</span></a>
			<ul class="list-group">			  
			<!--   <li class="list-group-item">
			    <a  href="<?php echo site_url('dashboard')?>">
			      <span class="badge pull-right"><?php echo $ikut?></span>
			      Kompetisi diikuti
			    </a>
			  </li> -->
			  <li class="list-group-item">
			    <a href="<?php echo site_url('dashboard/ditandai')?>">
			      <span class="badge pull-right"><?php echo $tandai?></span>
			      Kompetisi ditandai
			    </a>
			  </li>
			  <li class="list-group-item active">
			    <a style="color:#fff" href="<?php echo site_url('dashboard/saya')?>">
			      <span class="badge pull-right"><?php echo $kompetisiku?></span>
			      Kompetisi saya
			    </a>
			  </li>
			   <li class="list-group-item">
			    <a href="<?php echo site_url('dashboard/profile')?>">
			      Edit Profile
			    </a>
			  </li>
			</ul>
		</div>

		<div class="col-md-10">
			<h3>Total : <?php echo $total;?></h3>
			<table class="table table-hover">
			  <thead>
			  	<tr>
				  	<td><strong>No</strong></td>
				  	<td><strong>Judul Kompetisi</strong></td>
				  	<td><strong>Kategori</strong></td>
				  	<td><strong>Views</strong></td>
				  	<td><strong>Ditandai</strong></td>
				  	<td><strong>Bergabung</strong></td>				  	
				  	<td><strong>Status</strong></td>
				  	<td style="width:65px"></td>
			  	</tr>
			  </thead>
			  <tbody>
			  	<?php $n = 1 ?>
			  	<?php foreach ($view as $k) {
			  		$enc = base64_encode(base64_encode($k['id_kompetisi']));
					$id = $id_kompetisi = str_replace('=', '', $enc);
			  		$judul = str_replace(' ', '-', $k['judul_kompetisi']);
			  		//cek jumlah ditandai
			  		$sqlditandai = "SELECT * FROM kompetisi_btn WHERE id_kompetisi = ? AND tandai = 1";
			  		$queryditandai = $this->db->query($sqlditandai,$k['id_kompetisi']);
			  		$ditandai = $queryditandai->num_rows();
			  		//cek jumlah bergabung
			  		$sqlbergabung = "SELECT * FROM kompetisi_btn WHERE id_kompetisi = ? AND gabung = 1";
			  		$querybergabung = $this->db->query($sqlditandai,$k['id_kompetisi']);
			  		$bergabung = $querybergabung->num_rows();
			  	?>
			  	<tr> 
				  	<td><?php echo $n;?></td>
				  	<td><?php echo $k['judul_kompetisi'];?></td>
				  	<td><?php echo $k['id_sub_kat'];?></td>
				  	<td><?php echo $k['views']?></td>
				  	<td><?php echo $ditandai;?></td>
				  	<td><?php echo $bergabung;?></td>				  	
				  	<td><?php echo $k['status']?></td>
				  	<td><a href="<?php echo site_url().'dashboard/edit'.'?id='.$id; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span>
				  	<a target="_blank" href="<?php echo site_url('kompetisi/detail/'.$id.'/'.$judul); ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-chevron-right"></span></td>
			  	</tr>
			  	<?php $n++;
			  	} ?>
			  </tbody>
			</table>
			</br>
			<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
			</br>
		</div>
	</div>
</div>
<br/>