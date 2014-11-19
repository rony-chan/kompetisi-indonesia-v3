<!DOCTYPE HTML>
<html lang="id">
<head>
	<title><?php echo $title?> Kompetisi Indonesia</title>
	<link href="<?php echo base_url('dist/css/bootstrap.css')?>" media="screen" rel="stylesheet">
	<link href="<?php echo base_url('dist/css/public.css')?>" media="screen" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url()?>images/favicon.png" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
	<script type="text/javascript" src="<?php echo base_url('dist/js/jquery.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('dist/js/bootstrap.js')?>"></script>
	<script type"text/javascript" src="<?php echo base_url('dist/tinymce/js/tinymce/tinymce.min.js')?>"></script>
	<script type="text/javascript">
		tinymce.init({
			selector:"textarea#deskripsilengkap",
			height:400,
			plugins:["image"]
		});
	</script>

</head>

<body style="background-color:rgb(245, 245, 245)">

<div style="padding-bottom:25px;background-color:#fff">
	<div class="container">		
		<nav>
			<p style="font-size:10px">Pastikan akun anda aman dari serangan</p>
		</nav>
		<header>
			
				<div class="header col-md-2 ">
					<a href="<?php echo site_url()?>"><div class="header-img"></div></a>
				</div>
				<div class="header-link col-md-10">
					<ul class="menu">
						<?php
							if(!empty($this->session->userdata('super_username'))) {
								echo '<li><a href="#" >
									<div class="dropdown pull-right">
									  <a data-toggle="dropdown" href="#">'.$this->session->userdata('super_username').'<span class="caret"></span></a>
									  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
									  	<li style="width:100%;padding:0"><a href="'.site_url('dashboard').'" >Dasbor</a></li>
									  	<li style="width:100%;padding:0"><a href="'.site_url('dashboard/profile').'" >Edit Profil</a></li>
									    <li style="width:100%;padding:0"><a href="'.site_url('publik/logout').'" >Logout</a></li>
									  </ul>
									</div>
								</a></li>';
							} else {
								echo '<li></li>';
							}
						?>																
					</ul>
				</div>
		</header>
	</div>
	<!--base end-->

	<!--modal login-->
	<div class=" modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Kompetisi Indonesia Login</h4>
				</div>
				<div class="modal-body">
					<p style="color:#fff"><?php echo validation_errors();?></p>
					
						<span class="col-md-6">
							<form method="post" action="<?php echo site_url('publik/login')?>" role="form">
							  <div class="form-group">
							    <label for="exampleInputEmail1">Username</label>
							    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username" required>
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">Password</label>
							    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
							  </div>
							  <div class="checkbox">
							    <label>
							      <input type="checkbox"> Check me out
							    </label>
							  </div>
							  <input type="submit" class="btn btn-default" value="Log in"/>
							</form>
						</span>
						<span class="col-md-6 login-via">
							<a href="#">Belum Mempunyai Akun</a><br/><br/>
							<p>atau daftar menggunakan :</p><br/>
							<a class="btn-connect fb"  href="#">Facebook</a>
							<a class="btn-connect twitter"  href="#">Twitter</a>
							<a class="btn-connect g"  href="#">Google</a>
						</span>

					<hr/>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!--modal footer-->
	<div class=" modal fade" id="kategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">...</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>