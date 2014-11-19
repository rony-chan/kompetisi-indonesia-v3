<div class="col-md-2">
	<a style="margin-bottom:5px;width:100%" href="<?php echo site_url('dashboard/pasang?by=').$this->session->userdata('username')?>" class="btn btn-default">+ Pasang Kompetisi</span></a>
	<ul class="list-group">			  
		<li class="list-group-item">
			<a href="<?php echo site_url('dashboard')?>">
				<span class="badge pull-right"><?php echo $ikut?></span>
				Kompetisi diikuti
			</a>
		</li>
		<li class="list-group-item active">
			<a style="color:#fff" href="<?php echo site_url('dashboard/ditandai')?>">
				<span class="badge pull-right"><?php echo $tandai?></span>
				Kompetisi ditandai
			</a>
		</li>
		<li class="list-group-item">
			<a href="<?php echo site_url('dashboard/saya')?>">
				<span class="badge pull-right"><?php echo $kompetisiku?></span>
				Kompetisi saya
			</a>
		</li>
		<li class="list-group-item">
			<a href="<?php echo site_url('dashboard/saya')?>">
				<span class="badge pull-right"><?php echo $kompetisiku?></span>
				Edit Profile
			</a>
		</li>
	</ul>
</div>