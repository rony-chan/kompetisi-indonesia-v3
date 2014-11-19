<!DOCTYPE html>
<html>
<head>
	<title><?php echo $kompetisi['judul_kompetisi']?> | Kompetisi Indonesia</title>
</head>
<body>
	<h1><small style="font-size:11px">Disimpan dari www.KompetisiIndonesia.com pada <?php echo date('d/m/Y')?></small></h1>
	<hr/>
	<h3>Detail Kompetisi</h3>
	<p>Judul Kompetisi : <?php echo $kompetisi['judul_kompetisi']?></p>
	<p>Deadline : <?php echo $kompetisi['deadline']?></p>
	<p>Pengumuman : <?php echo $kompetisi['pengumuman']?></p>
	<p>Penyelenggara : <?php echo $kompetisi['penyelenggara']?></p>
	<p>Hadiah Senilai : Rp <?php echo $kompetisi['total_hadiah']?>,-</p>
	<p>Detail Hadiah : <?php echo $kompetisi['hadiah']?></p>
	<hr>
	<h3>Syarat dan Ketentuan</h3>
	<p><?php echo $kompetisi['konten']?></p>
	<p>Info selengkapnya <?php echo $kompetisi['sumber']?></p>

	<br>
	<center>
		<h5>copyright &copy; 2014 Kompetisi Indonesia</h5>
	</center>
</body>
</html>