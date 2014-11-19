<?php
//declarasi variabel
$registerdata = $this->session->userdata;
$sex = $registerdata['gender'];
$namaleng = $registerdata['name'];
$username = $registerdata['username'];
$email = $registerdata['email'];
$id = $registerdata['id'];
$provider = $registerdata['provider'];
?>
<body>
<div class="register container">
	<div style="padding:15px" class="col-md-offset-1 col-md-10">
		<div class="row register-place">
			<div class="col-md-6">
				<div class="col-md-2">
				<img src="https://graph.facebook.com/<?php echo $id?>/picture?return_ssl_resources=true" alt="kompetisiindonesia user" />
				</div>
				<div class="col-md-10">
				<p><strong>Nama : </strong><?php echo $namaleng?></p>
				<p><strong>Gender : </strong><?php echo $sex?></p>
				<p><strong>Register via : </strong><?php echo $provider?></p>
				</div>
			</div>
			<div class="col-md-6">
				<h4>LENGKAPI DATA KAMU</h4>
				<p style="color:red"><?php echo validation_errors();?></p>
				<br/><br/>
				<form method="POST" action="<?php echo site_url('auth/proc_register')?>" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label for="reg-username" class="col-lg-3 control-label">Username</label>
				    <div class="col-lg-9">
				      <h6>Hanya diperbolehkan angka dan abjad</h6>
				      <input type="text" class="form-control" name="reg-username" id="reg-username" value="<?php echo $username?>" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="reg-email" class="col-lg-3 control-label">Email</label>
				    <div class="col-lg-9">
				      <input type="email" class="form-control" name="reg-email" value="<?php echo $email?>" id="reg-email" required>
				    </div>
				  </div>
				  <div class="form-group">
				  	<label for="reg-moto"class="col-lg-3 control-label" >Moto</label>
				  	<div class="col-lg-9">
				  		 <h6>maks 400 karakter</h6>
				  		<textarea class="form-control" name="reg-moto" id="reg-moto" required></textarea>
				  	</div>
				  </div>
				  <div class="form-group">
				    <div class="col-lg-offset-2 col-lg-10">
				      <div class="checkbox">
				        <label>
				          <input type="checkbox" required> Saya menyetujui <a href="http://kompetisiindonesia.com/publik/read/TWpJPQ/Disclaimer" target="_blank">syarat dan ketentuan</a> Kompetisi Indonesia
				        </label>
				      </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-lg-offset-2 col-lg-10">
				      <button style="float:right;border-radius:0" type="submit" class="btn btn-danger">Register</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>