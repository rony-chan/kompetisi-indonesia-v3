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
			<div class="panel-heading">User</div>
			<div class="panel-body">

				<div class="tabbable" > <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs" id="myTab">
						<li id="active"><a href="<?php echo site_url('super/super/user?act=active')?>">Active</a></li>
						<li id="banned"><a href="<?php echo site_url('super/super/user?act=banned')?>">Banned</a></li>
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
										<td><strong>Provider</strong></td>
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
										<td><?php echo $v['oauth_provider']?></td>
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