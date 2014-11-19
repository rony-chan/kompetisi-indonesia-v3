<!--ADMIN LOGGED IN-->
<?php 
$logstatus = $this->session->userdata('level');
if($logstatus == 'admin') { ?>
<div class="col-md-2"></div>
<div style="position:fixed;z-index:100" class="col-md-2">
	<a id="kompetisi" href="<?php echo site_url('super/super/dashboard?act=posted')?>" >Kompetisi <span class="badge"><?php echo $this->m_super->count_competition();?></span></a>
	<a id="kategorix" href="<?php echo site_url('super/super/kategori')?>" >Kategori Kompetisi <span class="badge"><?php echo $this->db->count_all('main_kat');?></span></a>
	<a id="request" href="<?php echo site_url('super/super/request?act=menunggu')?>">Request Kompetisi <span class="badge"><?php echo $this->m_super->count_waiting_competition();?></span></a>
	<a id="request2" href="<?php echo site_url('super/super/request2?act=menunggu')?>">Request Link Poster <span class="badge"><?php echo $this->m_super->count_waiting_link_poster();?></span></a>
	<a id="post" href="<?php echo site_url('super/super/post?act=active')?>">News <span class="badge"><?php echo $this->m_super->count_news();?></span></a>
	<a id="moderator" href="<?php echo site_url('super/super/moderator?act=active')?>">Moderator <span class="badge"><?php echo $this->m_super->count_moderator_active();?></span></a>
	<a id="user" href="<?php echo site_url('super/super/user?act=active')?>">User <span class="badge"><?php echo $this->m_super->count_user_active();?></span></a>
	<a id="adsx" href="<?php echo site_url('super/super/ads')?>" >ads <span class="badge"></span></a>
	<a id="komentar" href="<?php echo site_url('super/super/komentar')?>" >Komentar <span class="badge"></span></a>
	<a id="error" href="<?php echo site_url('super/super/error')?>" >Error Report <span class="badge"></span></a>
	<a id="logout" href="<?php echo site_url('super/super/logout')?>">Logout</a>
</div>
<?php } else if($logstatus == 'moderator'){?>
<div class="col-md-2"></div>
<div style="position:fixed;z-index:100" class="col-md-2">
	<a id="kompetisi" href="<?php echo site_url('super/super/dashboard?act=posted')?>" >Kompetisi</a>
	<a id="request" href="<?php echo site_url('super/super/request?act=menunggu')?>">Request Kompetisi</a>
	<a id="request2" href="<?php echo site_url('super/super/request2?act=menunggu')?>">Request Link Poster</a>
	<a id="post" href="<?php echo site_url('super/super/post?act=active')?>">News</a>
	<a id="logout" href="<?php echo site_url('super/super/logout')?>">Logout</a>
</div>
<?php } else { echo '<center><h1>GET OUT HACKER</h1></center>';}?>