<?php
//total peserta yang belum terverifikasi
$count_unverified = $this->m_kompetisi->count_unverified_participans($kompetisi['id_kompetisi']);
//total peserta yang terverifikasi
$count_verified = $this->m_kompetisi->count_verified_participans($kompetisi['id_kompetisi']);
//total pemenang
$count_winner = $this->m_kompetisi->count_winner_participans($kompetisi['id_kompetisi']);

?>
<!-- detail kompetisi -->
<ul class="nav nav-tabs" id="myTab">
	<li id="detail"><a href="<?php echo site_url('dashboard/manage?id='.$_GET['id']);?>">Detail</a></li>
	<li id="komentar"><a href="<?php echo site_url('dashboard/manage?id='.$_GET['id'].'&act=komentar');?>">Komentar <span style="margin-left:4px" class="badge pull-right">200</span></a></li>
	<li id="unverify"><a href="<?php echo site_url('dashboard/manage?id='.$_GET['id'].'&act=unverify');?>"> Peserta Belum Verifikasi <span style="margin-left:4px" class="badge pull-right"><?php echo $count_unverified?></span></a></li>
	<li id="verified"><a href="<?php echo site_url('dashboard/manage?id='.$_GET['id'].'&act=verified');?>">Peserta Terverifikasi <span style="margin-left:4px" class="badge pull-right"><?php echo $count_verified;?></span></a></li>
	<li id="pemenang"><a href="<?php echo site_url('dashboard/manage?id='.$_GET['id'].'&act=winner');?>">Pemenang <span style="margin-left:4px" class="badge pull-right"><?php echo $count_winner;?></span></a></li>
</ul>