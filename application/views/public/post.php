<?php 
//encode id as url
$enc = base64_encode(base64_encode($view['id']));
$id = $id_kompetisi = str_replace('=', '', $enc);
				//judul post
$judul = str_replace(' ', '_', $view['title'])
?>
<br/>
<div class="container content-content">
	<div class="col-md-offset-1 col-md-7">
		<br/>
		<div class="ki-breadcrumb container">
		<ol>
			<li><a href="<?php echo site_url()?>">HOME</a></li>
			<li>></li>
			<li><a href="<?php echo site_url('start/kompetisi/news')?>">NEWS</a></li>
			<li>></li>
			<li><strong><?php echo strtoupper($view['title'])?></strong></li>
		</ol>
		</div>
		<h1 style="font-size:24px"><a href="<?php echo site_url('publik/read/'.$id.'/'.$judul.'')?>"><?php echo $view['title']?></a></h1>
		<p style="font-size:10px; background-color:rgb(233, 233, 233); padding:6px">Post : <?php echo $view['tgl_edit'] ?> | Oleh : Kindo</p>
		<p><?php echo $view['content']?></p>
		<hr/>		
	</div>
	<?php $this->load->view('public/sidebar.php'); ?>	

</div>
</div>
</br>