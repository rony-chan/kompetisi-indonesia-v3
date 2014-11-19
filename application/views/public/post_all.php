<br/>
<div class="container content-content">

	<div class="col-md-offset-1 col-md-7">
		<br/>
		<div class="ki-breadcrumb container">
		<ol>
			<li><a href="<?php echo site_url()?>">HOME</a></li>
			<li>></li>
			<li><a href="<?php echo site_url('start/kompetisi/news')?>">NEWS</a></li>

			<!-- <li><strong><?php echo $view['judul_kompetisi']?> </strong></li> -->
		</ol>
		</div>
	</br>
	<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
</br>

<?php foreach ($view as $v) { 
	$post = substr($v['content'], 0,300);			

				//encode id as url
	$enc = base64_encode(base64_encode($v['id']));
	$id = $id_kompetisi = str_replace('=', '', $enc);
				//judul post
	$judul = str_replace(' ', '_', $v['title'])
	?>

	<h3><a href="<?php echo site_url('publik/read/'.$id.'/'.$judul.'')?>"><?php echo $v['title']?></a></h3>
	<p style="font-size:10px; background-color:rgb(233, 233, 233); padding:6px">Post : <?php echo $v['tgl_edit'] ?> | Oleh : Kindo</p>
	<p><?php echo $post?>...</p>
	<hr/>
	<?php } ?>
</br>
<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
</br>
</div>

<?php $this->load->view('public/sidebar.php'); ?>	

</div>
</div>
</br>