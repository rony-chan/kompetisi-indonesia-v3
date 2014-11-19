<?php 
if(isset($script2) && isset($script)) {
 echo $script2; //script untuk atur class active
 echo $script; //script untuk atur class active
}
?>
<br/>
<div class="row-fluid">
	<?php $this->load->view('super/menu/sidebar') //load the sidebar ?>
	<div class="col-md-10">

		<div class="panel panel-default">
			<div class="panel-heading">Moderator</div>
			<div class="panel-body">
				<a href="#tambahmoderator" class="btn btn-default" data-toggle="modal">+ Moderator</a>
				<br/><br/>
				<div class="tabbable" > <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs" id="myTab">
						<li id="active"><a href="<?php echo site_url('super/super/moderator?act=active')?>">Active</a></li>
						<li id="banned"><a href="<?php echo site_url('super/super/moderator?act=banned')?>">Banned</a></li>
					</ul>
					<br/>
					<div class="tab-content">

						<!--active-->
						<div class="tab-pane active" id="active">
							<h3>Total : <?php echo $tot?></h3>
							<table class="table table-hover">
								<thead>
									<tr>
										<td><strong>No</strong></td>
										<td><strong>Id User</strong></td>
										<td><strong>Username</strong></td>
										<td><strong>Fullname</strong></td>
										<td><strong>Email</strong></td>
										<td><strong>Tgl Gabung</strong></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php 
									$n = 1;
									foreach($view as $v) { ?>
									<tr>
										<td><?php echo $n ?></td>
										<td><?php echo $v['id_user'] ?></td>
										<td><?php echo $v['username'] ?></td>
										<td><?php echo $v['fullname'] ?></td>
										<td><?php echo $v['email'] ?></td>
										<td><?php echo $v['tgl_gabung'] ?></td>
										<td>
											<a title="banned" class="btn btn-xs btn-default" href="<?php echo site_url('super/super/btn_user?act=0&id='.$v['id_user'])?>"><span class="glyphicon glyphicon-minus-sign"></span></a>
											<a title="active" class="btn btn-xs btn-default" href="<?php echo site_url('super/super/btn_user?act=1&id='.$v['id_user'])?>"><span class="glyphicon glyphicon-ok-sign"></span></a>
										</td>										
									</tr>
									<?php  $n++; } ?>
								</tbody>
							</table>
						</div>
					</br>
					<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
				</br>
				<!--end of active-->
			</div>
		</div>
	</div>
</div>
</div>

<!-- modal untuk moderator -->
<div class="modal fade" id="tambahmoderator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Moderator</h4>
			</div>
			<div class="modal-body">
				<form method="POST" class="form" role="form" action="<?php echo site_url('super/super/proc_addModerator');?>">
				<input type="text" name="inputFullname" class="form-control" placeholder="Masukan Fullname">
				<br/>
				<input type="text" name="inputUsername" class="form-control" placeholder="Masukan Username">
				<br/>
				<input type="password" name="inputPassword" class="form-control" placeholder="Masukan Password">
				<br/>
				<input type="email" name="inputEmail" class="form-control" placeholder="Masukan Email">
				<br/>
				<textarea class="form-control" name="inputMoto" placeholder="masukan moto"></textarea>
				<br/>
				<select class="form-control" name="inputGender">
				<option value="laki-laki">Laki-Laki</option>
				<option value="perempuan">Perempuan</option>
				</select>
				<br/>
				<button class="btn btn-default" type="submit">+ Moderator</button>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->