<!--ADMIN LOGGED IN-->
<?php 
$logstatus = $this->session->userdata('level');
if($logstatus == 'admin') { ?>
<div class="col-md-2"></div>
<div style="position:fixed;z-index:100" class="col-md-2">
	<a class="list-group-item" id="kompetisi" href="<?php echo site_url('super/super/dashboard?act=posted')?>" >Kompetisi <span class="badge"><?php echo $this->m_super->count_competition();?></span></a>
	<a class="list-group-item" id="kategorix" href="<?php echo site_url('super/super/kategori')?>" >Kategori Kompetisi <span class="badge"><?php echo $this->db->count_all('main_kat');?></span></a>
	<a class="list-group-item" id="request" href="<?php echo site_url('super/super/request?act=menunggu')?>">Request Kompetisi <span class="badge"><?php echo $this->m_super->count_waiting_competition();?></span></a>
	<a class="list-group-item" id="request2" href="<?php echo site_url('super/super/request2?act=menunggu')?>">Request Link Poster <span class="badge"><?php echo $this->m_super->count_waiting_link_poster();?></span></a>
	<a class="list-group-item" id="post" href="<?php echo site_url('super/super/post?act=active')?>">News <span class="badge"><?php echo $this->m_super->count_news();?></span></a>
	<a class="list-group-item" id="moderator" href="<?php echo site_url('super/super/moderator?act=active')?>">Moderator <span class="badge"><?php echo $this->m_super->count_moderator_active();?></span></a>
	<a class="list-group-item" id="user" href="<?php echo site_url('super/super/user?act=active')?>">User <span class="badge"><?php echo $this->m_super->count_user_active();?></span></a>
	<a class="list-group-item" id="adsx" href="<?php echo site_url('super/super/ads')?>" >ads <span class="badge"></span></a>
	<a class="list-group-item" id="komentar" href="<?php echo site_url('super/super/komentar')?>" >Komentar <span class="badge"></span></a>
	<a class="list-group-item" id="error" href="<?php echo site_url('super/super/error')?>" >Error Report <span class="badge"></span></a>
	<a class="list-group-item" id="logout" href="<?php echo site_url('super/super/logout')?>">Logout</a>
</div>
<?php } else if($logstatus == 'moderator'){?>
<div class="col-md-2"></div>
<div style="position:fixed;z-index:100" class="col-md-2">
	<a class="list-group-item" id="kompetisi" href="<?php echo site_url('super/super/dashboard?act=posted')?>" >Kompetisi</a>
	<a class="list-group-item" id="request" href="<?php echo site_url('super/super/request?act=menunggu')?>">Request Kompetisi</a>
	<a class="list-group-item" id="request2" href="<?php echo site_url('super/super/request2?act=menunggu')?>">Request Link Poster</a>
	<a class="list-group-item" id="post" href="<?php echo site_url('super/super/post?act=active')?>">News</a>
	<a class="list-group-item" id="logout" href="<?php echo site_url('super/super/logout')?>">Logout</a>
</div>
<?php } else { echo '<center><h1>GET OUT HACKER</h1></center>';}?>