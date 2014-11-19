<br/>
</h3>
<div class="container">
	<div class="row">
		<center><h3 style="text-transform:uppercase" class="kompetisi-detail"><?php echo $this->session->userdata('username')?> dasbor</h3></center>
		<div class="col-md-2">
			<a style="margin-bottom:5px;width:100%" href="<?php echo site_url('dashboard/pasang?by=').$this->session->userdata('username')?>" class="btn btn-default">+ Pasang Kompetisi</span></a>
			<ul class="list-group">			  
			  <li class="list-group-item">
			    <a href="<?php echo site_url('dashboard/ditandai')?>">
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
			   <li class="list-group-item active">
			    <a  style="color:#fff" href="<?php echo site_url('dashboard/profile')?>">
			      Edit Profile
			    </a>
			  </li>
			  </li>
			</ul>
		</div>

		<div class="col-md-7">
			<h3>Pasang Kompetisi</h3>
			<p>tanda *, adalah form yang wajib diisi</p>
			<form method="post" action="<?php echo site_url('process/proc_public/edit_profile')?>" class="form-horizontal" role="form">
				<div class="form-group">
				<label for="judulkompetisi" class="col-lg-2 control-label">*Username</label>
					<div class="col-lg-10">
						
						<input name="username" type="text" class="form-control" value="<?php echo $view['username']?>" id="judulkompetisi" required>
					</div>
				</div>
				<div class="form-group">
				<label for="judulkompetisi" class="col-lg-2 control-label">*Nama Lengkap</label>
					<div class="col-lg-10">
						
						<input name="nama" type="text" class="form-control" id="judulkompetisi" value="<?php echo $view['fullname']?>" required>
					</div>
				</div>
				<div class="form-group">
				<label for="judulkompetisi" class="col-lg-2 control-label">*Email</label>
					<div class="col-lg-10">
						
						<input name="email" type="text" class="form-control" value="<?php echo $view['email']?>" id="judulkompetisi" required>
					</div>
				</div>
				<div class="form-group">
					<label for="moto" class="col-lg-2 control-label">*Moto</label>
					<div class="col-md-10">
					<textarea class="form-control" name="moto" id="moto" required><?php echo $view['moto']?></textarea>
					</div>
				</div>
				<input type="hidden" value="<?php echo $view['password']?>" name="old_password"/>
				<input type="hidden" value="<?php echo $view['id_user']?>" name="id_user"/>

				<div class="form-group">
				<label for="judulkompetisi" class="col-lg-2 control-label"></label>
					<div class="col-lg-10">
						<input type="submit" value="Edit Profile" class="btn btn-default">
					</div>
				</div>

				
				
			</form>
		</div>

		
	</div>
</div>
<br/>