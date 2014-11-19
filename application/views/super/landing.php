<br/>
<div class="container" style="background-color:rgb(247, 247, 247)">
	<div class="page-header">
	  <h1>Super Page <small>Administrator and Management</small></h1>
	</div>

	<div class="row">

		<div class="col-md-offset-1 col-md-4">
			<h2>Login</h2>
			<p><?php echo validation_errors();?></p>
			<form action="<?php echo site_url('super/login/login_proc'); ?>" method="POST" role="form">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Super User</label>
			    <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Super Password</label>
			    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  </div>
			  <button name="btn_login" type="submit" class="btn btn-default">Login</button>
			</form>
			<br/>
		</div>
	</div>
</div>
<br/>
<center>Yussan Dev Team for Kompetisi Indonesia</center>