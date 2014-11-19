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
			<div class="panel-heading">Request : Poster / Link</div>
			<div class="panel-body">

				<div class="tabbable" > <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs" id="myTab">
						<li id="tunggu"><a href="<?php echo site_url('super/super/request2?act=menunggu')?>">Menununggu</a></li>
						<li id="terima"><a href="<?php echo site_url('super/super/request2?act=diterima')?>">Diterima</a></li>
						<li id="tolak"><a href="<?php echo site_url('super/super/request2?act=ditolak')?>">Ditolak</a></li>
					</ul>
					<br/>
					<div class="tab-content">

						<!--menunggu-->
						<div class="tab-pane active" id="menunggu">
							<h3>Total : <?php echo $tot ?></h3>
							<table class="table table-hover">
								<thead>
									<tr>
										<td><strong>No</strong></td>
										<td><strong>Tgl</strong></td>
										<td><strong>Dari</strong></td>
										<td><strong>Link</strong></td>
										<td><strong>Poster</strong></td>
										<td><strong>Status</strong></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php 
									$n = 1;
									foreach($view as $v) { ?>
									<tr>
										<td><?php echo $n ?></td>
										<td><?php echo $v['waktu']?></td>
										<td><?php echo $v['email']?></td>
										<td><a href="<?php echo $v['link'];?>" target="_blank"><?php echo $v['link'] ?></a></td>
										<td><a href="<?php echo base_url('images/poster/'.$v['poster'] );?>" target="_blank"><?php echo $v['poster']?></td>
										<td><?php echo $v['status'] ?></td>
										<td>
											<a title="accept" class="btn btn-xs btn-default" href="<?php echo site_url('super/super/btn_proc2?stat=1&id='.$v['id_req'])?>"><span class="glyphicon glyphicon-ok-circle"></span></a>
											<a title="reject" class="btn btn-xs btn-default" href="<?php echo site_url('super/super/btn_proc2?stat=0&id='.$v['id_req'])?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
										</td>
									</tr>
									<?php  $n++; } ?>
								</tbody>
							</table>
							</br>
							<div style="padding:10px; border:2px solid #E6E6E6; font-size:15px"><center><?php echo $page ?> </center></div>
							</br>
						</div>
						<!--end of menunggu-->
					</div>
				</div>
			</div>
		</div>



	</div>