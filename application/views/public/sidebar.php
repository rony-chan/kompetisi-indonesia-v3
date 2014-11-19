<div id="sticker" class="col-md-3 sidebar" style="border-left : 1px solid #E6E6E6;">
<p class="about-post">Kompetisi Favorit</p>
	<?php
		$good = $this->m_kompetisi->kompetisi_terbaik();
		foreach($good as $g) {
		//encode id as url
		$enc = base64_encode(base64_encode($g['id']));
		$id = str_replace('=', '', $enc);
		//judul post
		$judul = str_replace(' ', '-', $g['judul_kompetisi']);
	?>
	<div style="width:100%;padding:10px;border-bottom:1px solid #E6E6E6;float:left">
		<a href="<?php echo site_url('kompetisi/detail/'.$id.'/'.$judul)?>"><img style="margin-right:10px;float:left;width:100px" src="<?php echo base_url('images/poster/'.$g['poster'])?>">
			<p><?php echo $g['judul_kompetisi']?></p>
		</a>
	</div>
	<?php } ?>

</div>